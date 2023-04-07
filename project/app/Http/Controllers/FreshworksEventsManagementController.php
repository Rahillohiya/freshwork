<?php

namespace App\Http\Controllers;

use App\Entities\ChannelAccount;
use App\Entities\ChannelEvent;
use App\Entities\ChannelEventSetting;
use App\Entities\CustomApp;
use App\Services\Connectors\FreshworksApiLibrary;
use App\Services\Connectors\FreshworksClient;
use App\Services\ShopifyService;
use Illuminate\Http\Request;
use App\Entities\ChannelConfig;
use App\Entities\WebhookTopic;
use Session;

class FreshworksEventsManagementController extends Controller
{
    private $freshworks_api_library;
    private $clientId;
    private $clientSecret;
    private $custom_app_id;
    private $channel_account_id;

    public function __construct(FreshworksApiLibrary $freshworks_api_library)
    {
        $this->freshworks_api_library   = $freshworks_api_library;
        $this->clientId                 = config('channel_credential_variables.freshworks_sandbox_client_id');
        $this->clientSecret             = config('channel_credential_variables.freshworks_sandbox_client_secret');
        $this->custom_app_id            = 0;
        $this->channel_account_id       = 0;
    }

    function freshworks_online_app_account(Request $request)
    {

        $shop = session('shop');
        $account = null;
        $channel_id = $request->id;

        if (!empty($channel_id)) {
            $account = CustomApp::where('id', $channel_id)->where('shop_id', $shop['shop_id'])->first();
        }
        $login_credentials = $account ? $account->login_credentials : [];
        return view('freshworks_online.app_credentials_window', compact('account', 'login_credentials','channel_id','request'));
    }

    function store_freshworks_online_app_account(Request $request)
    {
        try {

            $shop = session('shop');
            $freshworks_online = CustomApp::firstOrNew([
                'shop_id' => $shop['shop_id'],
                'id' => $request->account_id ?? 0]);

            $login_credentials = [
                'instance_url' => $request->instance_url,
                'api_key' => $request->api_key,
            ];

            $freshworks_online->login_credentials = $login_credentials;
            $freshworks_online->shop_id = $shop['shop_id'];
            $freshworks_online->save();

            session()->put('custom_app_id', $freshworks_online->id);


            $freshworks_account = ChannelAccount::firstOrNew([
                'shop_id' => $shop['shop_id'],
                'custom_app_id' => $freshworks_online->id ?? 0]);

            
            $login_credentials = [
                'instance_url' => $request->instance_url,
                'api_key' => $request->api_key,
            ];

            $freshworks_account->login_credentials = $login_credentials;
            //                $freshworks_account->channel_id = channelIdByName('freshworks_online');
            $freshworks_account->shop_id = $shop['shop_id'];
            $freshworks_account->custom_app_id  =  $freshworks_online->id;
            $freshworks_account->expired  =  false;
            $freshworks_account->save();

            return response()->json([
                'code'      =>  200,
                'status'    =>  'success',
                'appId'     =>  $freshworks_online->id,
                'message'   =>  "freshworks_online app saved successfully"
            ], 200);

        } catch (\Exception $e) {

            $error_msg = $e->getMessage();
            return response()->json(['code' => 422, 'status' => 'error',
                'message' => $error_msg, 'errors' => [['message' => $error_msg]],
                'data' => new \stdClass()
            ], 422);
        }
    }

    public function freshworks_account_login(Request $request)
    {
        try {
            $shop = session('shop');

            if ($request->id != 0)
               $this->channel_account_id = $request->id;


            if ($request->account_type_splash_window == 1) {
                return view('freshworks_online.callback_window')->with([
                    'account_type_splash_window' => 1,
                    'channel_id' => $request->channel_id,
                    'id' => $request->id ?? 0,
                    'custom_app_id' => $request->custom_app_id ?? 0
                ]);
            } else {

                $freshworks_oauth_callback = config('channel_credential_variables.freshworks_oauth_callback');
                $authorizationRequestUrl = config('channel_credential_variables.freshworks_authorizationRequestUrl');
                $scope = config('channel_credential_variables.freshworks_oauth_scope');
                $response_type = "code";
                $certFilePath = '././././certificates/cacert.pem';

                if($request->account_type == 'production')
                    $this->setProductKeys();

                if($request->custom_app_id && $request->custom_app_id !=0)
                {
                    $this->custom_app_id = $request->custom_app_id;
                    $this->customApp($request->custom_app_id,$shop,$request->account_type);
                }

                $client = new FreshworksClient($this->clientId, $this->clientSecret, $certFilePath);

                $channel_id = $request->channel_id ?? 0;
                $state = $this->custom_app_id.'-'.$this->channel_account_id.'-'.$request->account_type.'-'. $channel_id;
                // set account type sandbox,production or test account

                $authUrl = $client->getAuthorizationURL($authorizationRequestUrl, $scope, $freshworks_oauth_callback, $response_type, $state);

                return redirect()->to($authUrl);
            }

        } catch (\Exception $e) {
            return $this->badLogin('Unable to login at the moment.');
        }
    }

    public function freshworks_callback(Request $request)
    {

        try {
            $shop = session('shop');

            if (empty($request->state)) {
                return $this->badLogin('invalid state');
            }

            if (empty($request->code) || empty($request->realmId)) {
                return $this->badLogin('invalid code or realmId');
            }

            $state = explode('-',$request->state);
//            $expected_state = session()->remove('freshworks_auth_state');
            //this account type belongs to environment here i-e sandbox or production
            $custom_app_id  = $state[0] ?? 0;
            $account_id     = $state[1] ?? 0;
            $account_type   = $state[2] ?? 'sandbox';
            $channel_id     = $state[3] ?? 0;

            $grant_type = 'authorization_code';
            $tokenEndPointUrl = config('channel_credential_variables.freshworks_tokenEndPointUrl');
            $authorizationRequestUrl = config('channel_credential_variables.freshworks_oauth_callback');
            $certFilePath = '././././certificates/cacert.pem';

            if($request->account_type == 'production')
                $this->setProductKeys();

            if($custom_app_id && $custom_app_id != 0)
                $this->customApp($custom_app_id,$shop,$account_type);


            $client = new FreshworksClient($this->clientId, $this->clientSecret, $certFilePath);
            $result = $client->getAccessToken($tokenEndPointUrl, $request->code, $authorizationRequestUrl, $grant_type);
            if (empty($result) || !isset($result['access_token'])){
                return $this->badLogin('Unable to get access token.Please login again to continue.');
            }
            try {

                if($account_id == 0)
                $t_accounts = ChannelAccount::where('shop_id', $shop['shop_id'])->count();

                $freshworks_account = ChannelAccount::firstOrNew([
                    'shop_id' => $shop['shop_id'],
                    'id' => $account_id ?? 0]);

                if($account_id ==0) {
                    $account_name = "Freshworks Online #" . ($t_accounts > 0 ? $t_accounts + 1 : 1);
                }

                $login_credentials = [
                    'name' => $freshworks_account->login_credentials['name'] ?? $account_name,
                    'account_type' => $account_type,
                    'token_type' => $result['token_type'],
                    'access_token' => $result['access_token'],
                    'x_refresh_token_expires_in' => $result['x_refresh_token_expires_in'],
                    'refresh_token' => $result['refresh_token'],
                    'expires_in' =>(time() + $result['expires_in']),
                    'realmId'=>  $request->realmId
                ];

                $freshworks_account->login_credentials = $login_credentials;
//                $freshworks_account->channel_id = channelIdByName('freshworks_online');
                $freshworks_account->shop_id = $shop['shop_id'];
                $freshworks_account->custom_app_id  =  ($custom_app_id!= 0 ) ? $custom_app_id : null;
                $freshworks_account->expired  =  false;
                $freshworks_account->save();

                return view('channel_credential_variables.callback_window');
            } catch (\Exception $e) {
                return $this->badLogin('Unable to login at the moment.Please try in few minutes.');
            }
        } catch (\Exception $e) {
            return $this->badLogin('Unable to login at the moment.Please try in few minutes.');
        }
    }

    public function setProductKeys(){
        $this->clientId     =   config('channel_credential_variables.freshworks_production_client_id');
        $this->clientSecret =   config('channel_credential_variables.freshworks_production_client_secret');
    }
    public function customApp($custom_app_id,$shop,$account_type){
        $account = CustomApp::where('id',$custom_app_id)->where('shop_id', $shop['shop_id'])->first();
        if($account) {
            if ($account_type == "sandbox") {
                $this->clientId = $account->login_credentials['sandbox_client_id'];
                $this->clientSecret = $account->login_credentials['sandbox_client_secret'];
            } else {
                $this->clientId = $account->login_credentials['production_client_id'];
                $this->clientSecret = $account->login_credentials['production_client_secret'];
            }
        }
    }

    public function get_freshworks_resources(Request $request)
    {
        $final_array = [];
        $shop = session('shop');
        if (!$request->freshworks_object)
            return ['results' => $final_array];
        $freshworks_account = ChannelAccount::where('id', $request->channel_account_id)
            ->where('shop_id', $shop['shop_id'])->first();

        if ($request->freshworks_object == "contacts") {
            return $this->freshworks_api_library->get_contacts($freshworks_account, $request);
        }
        
        return ['results' => $final_array];
    }

    public function load_freshworks_fields_section(Request $request)
    {
        $shop = session('shop');
        $freshworks_account = ChannelAccount::where('id', $request->channel_account_id)
            ->where('shop_id', $shop['shop_id'])->first();
        if (!$freshworks_account)
            return response()->json(['status' => 'error', 'message' => 'No account details found.']);
        if (!$request->channel_event_id || !$channel_event = ChannelEvent::where('id', $request->channel_event_id)->first())
            return response()->json(['status' => 'error', 'message' => 'No channel event found.']);
        $channel_event_settings = null;
        //        if request from edit mysql webhook event (prefilled already users table and request data in views)
        if (isset($request->channel_event_setting_id) && !empty($request->channel_event_setting_id)) {
            $channel_event_settings = ChannelEventSetting::where('id', $request->channel_event_setting_id)->first();
        }
        $api_fields = $channel_event_settings && $channel_event_settings->api_fields ? $channel_event_settings->api_fields : [];

        $fields = array();
        if($freshworks_account->login_credentials['instance_url'] && $freshworks_account->login_credentials['api_key'] && ($channel_event->slug == "create_contacts" || $channel_event->slug == "update_contacts")){
            $header = array(
                'Authorization: Token token='.$freshworks_account->login_credentials['api_key'],
                'Content-Type: application/json',
            );
            
            if ( strpos( $freshworks_account->login_credentials['instance_url'], 'freshsales.io' ) !== false ) {
                $url = $freshworks_account->login_credentials['instance_url'].'/api/settings/contacts/fields';
            } else {
                $url = $freshworks_account->login_credentials['instance_url'].'/crm/sales/api/settings/contacts/fields';
            }

            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );            
            $json_response = curl_exec( $ch ); 
            $status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
            curl_close( $ch );
            $response = json_decode( $json_response );
            
            if ( isset( $response->fields ) && $response->fields != null ) {
                foreach( $response->fields as $field ) {
                    if ( $field->base_model == 'LeadCompany' ) {
                        $field->name = 'company###'.$field->name;
                    } else if ( $field->base_model == 'LeadDeal' ) {
                        $field->name = 'deal###'.$field->name;
                    }
                    
                    $fields[$field->name] = array(
                        'label'     => $field->label,
                        'type'      => $field->type,  
                        'required'  => 0,
                        'choices'   => $field->choices,
                    );
                    
                    if ( $field->required ) {
                        $fields[$field->name]['required'] = 1;
                    }
                }
                
                $fields['attachment_field'] = array(
                    'label'     => 'Files',
                    'type'      => 'relate',
                    'required'  => 0,
                    'choices'   => array(),
                );
            }
        }
         
        return view("freshworks_online.load_api_fields_section",
            compact('channel_event_settings', 'api_fields', 'channel_event', 'fields'));

    }

    public function badLogin($message)
    {
        $login_section_not_required = true;
        return view('errors.un_verrified_shopify_request', compact('message', 'login_section_not_required'));
    }
}
