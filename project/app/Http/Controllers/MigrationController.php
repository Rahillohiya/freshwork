<?php

namespace App\Http\Controllers;

use App\Entities\Admin\Doc;
use App\Entities\Admin\DocMedia;
use App\Entities\ChannelAccount;
use App\Entities\ChannelConfig;
use App\Entities\ChannelEvent;
use App\Entities\ChannelEventSetting;
use App\Entities\CustomerDataRequest;
use App\Entities\MicrosoftAccount;
use App\Entities\MsExcelSetting;
use App\Entities\PlansHistory;
use App\Entities\Shop;
use App\Entities\WebhookLog;
use App\Traits\EncryptableDbAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MigrationController extends Controller
{
    use EncryptableDbAttribute;

    protected $db;
    function __construct(){
        Config::set('database.connections.mysql_channel_connection', [
            'driver' => 'mysql',
            'host' => '178.128.25.63',
            'port' =>  3306,
            'database' => 'connectify-testing',
            'username' => 'admin',
            'password' => 'Appsdb@1!',
            'unix_socket' => '',
            'charset' =>  'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]);
        $this->db = DB::connection('mysql_channel_connection');
    }
    function do()
    {
//        $this->migrate_channel_events();

//          $this->migrate_docs();
//        $this->migrate_doc_media();
//        $this->migrate_customers_data_request();
//        $this->migrate_shops();
//        $this->migrate_plan_history();
//        $this->migrate_channel_config();
//        $this->migrate_webhook_logs();
//        $this->freshworks_connector();


    }
    function migrate_docs(){
        $docs = $this->db->table("docs")->get();
        $stdClass = json_decode(json_encode($docs),true);
        Doc::insert($stdClass);
        echo 'docs migrated successfully';
    }
    function migrate_plan_history(){
        $plan_histories = $this->db->table("plans_history")->get();
        $stdClass = json_decode(json_encode($plan_histories),true);
        PlansHistory::insert($stdClass);
        echo 'Plan history migrated successfully';
    }

    function migrate_channel_events(){
        $events = $this->db->table("channel_events")->get();
        $stdClass = json_decode(json_encode($events),true);

        ChannelEvent::insert($stdClass);
        echo 'events migrated successfully';
    }
    function migrate_channel_config(){
        $channel_configs = $this->db->table("channel_configs")->get();
        $stdClass = json_decode(json_encode($channel_configs),true);
        ChannelConfig::insert($stdClass);
        echo 'channel config migrated successfully';
    }

    function migrate_doc_media(){
        $doc_media = $this->db->table("doc_media")->get();
        $stdClass = json_decode(json_encode($doc_media),true);
        DocMedia::insert($stdClass);
        echo 'Doc media migrated successfully';
    }
    function migrate_customers_data_request(){
        $customers_data_request = $this->db->table("customers_data_request")->get();
        $stdClass = json_decode(json_encode($customers_data_request),true);
        CustomerDataRequest::insert($stdClass);
        echo 'Customer data request migrated successfully';
    }

    function migrate_shops(){
        $shops = $this->db->table("shops")->get();
        $stdClass = json_decode(json_encode($shops),true);
        Shop::insert($stdClass);
        echo 'Shops migrated successfully';
    }

    function migrate_webhook_logs(){
        $webhook_logs = $this->db->table("webhook_logs")->get();

        $stdClass = json_decode(json_encode($webhook_logs),true);
        WebhookLog::insert($stdClass);
        echo 'webhook logs migrated successfully';
    }
    function freshworks_connector(){
        $freshworks_accounts =  $this->db->table('freshworks_accounts')->get();
        foreach ($freshworks_accounts as $freshworks_account){

            $login_credentials = [
                'name' => $freshworks_account->name ?? null,
                'account_type' => $freshworks_account->account_type ?? null,
                'access_token' => $freshworks_account->access_token ?? null,
                'x_refresh_token_expires_in' => $freshworks_account->x_refresh_token_expires_in ?? null,
                'refresh_token' => $freshworks_account->refresh_token ?? null,
                'expires_in' =>$freshworks_account->expires_in ?? null,
                'realmId'=> $freshworks_account->realmId ?? null
            ];


            $status =   $this->channel_account($freshworks_account,'freshworks_online',$login_credentials);

            if($status)
            {
                echo "freshworks account created..";
                echo "<br>";
                $freshworks_event_settings = $this->db->table('freshworks_event_settings')->where('freshworks_account_id',$freshworks_account->id)->get();

                if(count($freshworks_event_settings)>0)
                {

                    foreach($freshworks_event_settings as $channel_event_setting)
                    {
                        $event_settings = new ChannelEventSetting();
                        $event_settings->channel_config_id = $channel_event_setting->channel_config_id;
                        $event_settings->channel_account_id = $status->id;
                        $event_settings->channel_event_id = $channel_event_setting->channel_event_id;
                        $event_settings->api_fields = json_encode( $channel_event_setting->api_fields,true )?? 'empty';
                        $event_settings->object_id = $channel_event_setting->object_id ?? null;
                        $event_settings->object_text = $channel_event_setting->object_text ?? null;
                        $event_settings->where_clause_fields = $channel_event_setting->where_clause_fields ?? null;
                        $event_settings->save();

                        echo "freshworks event created..";
                        echo "<br>";
                    }
                }
            }

        }
    }
    function constant_contact_connector(){
        $constant_accounts =   ConstantContactAccount::all();

        foreach ($constant_accounts as $constant_account){


            $login_credentials = [
                'contact_email' => $constant_account->contact_email,
                'first_name' => $constant_account->first_name,
                'last_name' => $constant_account->last_name,
                'contact_phone' => $constant_account->contact_phone,
                'organization_name' => $constant_account->organization_name,
                'refresh_token' => $constant_account->refresh_token,
                'access_token' => $constant_account->access_token,
                'expires_in' =>$constant_account->expires_in,
                'encoded_account_id' => $constant_account->encoded_account_id
            ];

            $status =   $this->channel_account($constant_account,'constant_contact',$login_credentials);

            if($status)
            {
                echo "constant_contact account created..";
                echo "<br>";

                if($constant_account->constant_contact_event_settings)
                {

                    foreach($constant_account->constant_contact_event_settings as $channel_event_setting)
                    {
                        $event_settings = new ChannelEventSetting();
                        $event_settings->channel_config_id = $channel_event_setting->channel_config_id;
                        $event_settings->channel_account_id = $status->id;
                        $event_settings->channel_event_id = $channel_event_setting->channel_event_id;
                        $event_settings->api_fields = $channel_event_setting->api_fields;
                        $event_settings->object_id = $channel_event_setting->object_id;
                        $event_settings->object_text = $channel_event_setting->object_text;
                        $event_settings->where_clause_fields = $channel_event_setting->where_clause_fields ?? null;
                        $event_settings->save();

                        echo "constant_contact event created..";
                        echo "<br>";
                    }
                }
            }

        }
    }
    function channel_account($account,$name,$login_credentials)
    {
        $channel_account = ChannelAccount::firstOrNew([
            'shop_id' => $account->shop_id,
            'id' => $account_id ?? 0]);

        $channel_account->login_credentials = $login_credentials;
//        $channel_account->channel_id = channelIdByName($name);
        $channel_account->user_id = $account->user_id ?? null;
        $channel_account->created_at = $account->created_at ?? null;
        $channel_account->updated_at = $account->updated_at ?? null;
        $channel_account->save();
        return $channel_account;
    }


}
