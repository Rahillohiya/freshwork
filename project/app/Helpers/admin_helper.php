<?php

use App\Entities\ChannelAccount;
use App\Entities\CustomApp;
use Carbon\Carbon;
use Illuminate\Support\Str;

function marketo_field_description($dataType)
{
    switch ($dataType):
        case "datetime":
            $desc = "Follows <a href='https://www.w3.org/TR/NOTE-datetime' target='_blank' >W3C format</a> (ISO 8601).Complete date plus hours and minutes:<br/>YYYY-MM-DDThh:mm:ssTZD";
            break;
        case "email":
            $desc = "A string type field which accepts email addresses";
            break;
        case "float":
            $desc = "A number field which contains of Real Numbers and can use a decimal place e-g 10.4";
            break;
        case "integer":
            $desc = "Whole numbers e-g 10";
            break;
        case "formula":
            $desc = "Fields whose values are generated by manipulating data from other fields present on a lead record. They are not exported and can not be used in a Smart Campaigns.";
            break;
        case "percent":
            $desc = "A percentage expressed as an integer e-g 30";
            break;
        case "phone":
            $desc = "Phone number e-g 111-111-1111";
            break;
        case "textarea":
            $desc = "Longer text.Supports up to 30,000 bytes.Standard ASCII characters use 1 byte per character (allowing up to 30,000 characters).";
            $desc .= "Unicode characters may use up to 4 bytes per character (reducing the  number of characters allowed to less than 30,000 characters).";
            break;
        case "boolean":
            $desc = "Select a True (checked) or False (unchecked) value.";
            break;
        case "string":
            $desc = "Shorter text (up to 255 characters)";
            break;
        case "score":
            $desc = "An integer type field which can be manipulated with the Change Score flow step e-g 30";
            break;
        case "currency":
            $desc = "A float type field which represents the default currency type selected for the Marketo Subscription e-g 10.40";
            break;
        case "date":
            $desc = "Used for date. Follows W3C format. e-g 2010-05-07";
            break;
        case "reference":
            $desc = "UA string type field containing a key to another record (a foreign key)";
            break;
        default:
            $desc = "";
            break;

    endswitch;
    return $desc;
}

function getInitialWordCharacters($string = null)
{
    return array_reduce(
        explode(' ', $string),
        function ($initials, $word) {
            return sprintf('%s%s', $initials, substr($word, 0, 1));
        },
        ''
    );
}

if (!function_exists('getCreatedAtAttribute')) {

    function getCreatedAtAttribute($date_time, $shop)
    {
        $date_time = Carbon::createFromTimestamp(strtotime($date_time));
        if ($shop && $shop->iana_timezone)
            $date_time = $date_time->timezone($shop->iana_timezone);
        $date_time = $date_time->toDateTimeString(); //remove this one if u want to return Carbon object
        return $date_time;
    }
}
if (!function_exists('getDateWithTimeZone')) {

    function getDateWithTimeZone($date_time, $timezone = null)
    {
        $date_time = Carbon::createFromTimestamp(strtotime($date_time));
        if ($timezone)
            $date_time = $date_time->timezone($timezone);
        $date_time = $date_time->toDateTimeString(); //remove this one if u want to return Carbon object
        return $date_time;
    }
}

if (!function_exists('allowed_webhooks_tasks')) {

    function allowed_webhooks_tasks($user_plan)
    {
        $tasks = 0;
        if ($user_plan == 'basic') {
            $tasks = 200;
        } elseif ($user_plan == 'professional') {
            $tasks = 10000;
        } elseif ($user_plan == 'elite') {
            $tasks = 20000;
        }
        return $tasks;
    }
}

if (!function_exists('make_domain_url')) {

    function make_domain_url($domain)
    {
        return parse_url($domain, PHP_URL_SCHEME) ? $domain : "https://$domain";

    }
}
if (!function_exists('store_admin_panel_url')) {

    function store_admin_panel_url($shop)
    {
        $domain = parse_url($shop->myshopify_domain, PHP_URL_SCHEME) ? $shop->myshopify_domain : "https://$shop->myshopify_domain";
        return $domain . "/admin";

    }
}
if (!function_exists('store_webhook_status')) {

    function store_webhook_status($shop_id, $webhook_topic_id)
    {
        return \App\Entities\StoreWebhook::where('shop_id', $shop_id)
            ->where('webhook_topic_id', $webhook_topic_id)
            ->first();

    }
}
if (!function_exists('livid_storage')) {

    function livid_storage($dir)
    {
        return storage_path('app/public/' . $dir);

    }
}

if (!function_exists('livid_storage_path')) {
    function livid_storage_path($store_id, $folderame)
    {
        $basepath = livid_storage('stores/') . $store_id . "/" . $folderame . "/";
        if (!file_exists($basepath)) {
            File::makeDirectory($basepath, 0777, true);
        }
        return $basepath;
    }
}
if (!function_exists('get_asset_components')) {

    function get_asset_components($key, $type)
    {
        $components = config("asset.components.{$key}");
        return $components[$type];
    }
}
function humanDateFormat($date)
{
    if (!empty($date)) {
        return \Carbon\Carbon::parse($date)->diffForHumans();
    } else {
        return "";
    }
}

if (!function_exists('webhookEventNameByTopicName')) {

    function webhookEventNameByTopicName($topic_name)
    {
        $event_name = \App\Entities\WebhookTopic::where('topic_name', $topic_name)
            ->join('webhook_events', 'webhook_events.id', '=', 'webhook_topics.webhook_event_id')
            ->groupBy('webhook_events.event_name')
            ->pluck('webhook_events.event_name');

        return $event_name[0] ?? '';
    }
}

if (!function_exists('topicNameById')) {

    function topicNameById($id)
    {
        $topic_name = \App\Entities\WebhookTopic::where('id', $id)
            ->pluck('topic_name');

        return $topic_name[0] ?? '';
    }
}

if (!function_exists('webhookEventIdByTopicId')) {

    function webhookEventIdByTopicId($id)
    {
        $webhook_event_id = \App\Entities\WebhookTopic::where('id', $id)
            ->pluck('webhook_event_id');
        return $webhook_event_id[0] ?? 0;
    }
}

if (!function_exists('topicTypeByTopicName')) {
    function topicTypeByTopicName($topic_name)
    {
        if (Str::contains($topic_name, ['/create', '/edited', '/connect'])) {
            $topic_type = "create";
        } elseif (Str::contains($topic_name, '/delete')) {
            $topic_type = "delete";
        } else {
            $topic_type = "update";
        }
        return $topic_type;
    }
}

if (!function_exists('get_app_key')) {

    function get_app_key($config)
    {
        $channel_settings = $config->channel_event_settings;
        if($channel_settings) {
            $channel_account = $channel_settings->channel_account;
            $custom_app = $channel_account->custom_app;

            if ($channel_account->login_credentials['account_type'] == 'sandbox')
                return $custom_app->login_credentials['sandbox_client_id'] ?? config('channel.freshworks_sandbox_client_id');
            else
                return $custom_app->login_credentials['production_client_id'] ?? config('channel.freshworks_production_client_id');

            return $channel_settings->id;
        }

        return $config->id;
    }
}

if (!function_exists('getCustomAppByChannel')) {

    function getCustomAppByChannel($channelId,$shop)
    {
        return CustomApp::where('channel_id', $channelId)->where('shop_id', $shop)->first();
    }
}
if (!function_exists('getCustomAppById')) {

    function getCustomAppById($id, $shop)
    {
        return CustomApp::where('id', $id)->where('shop_id', $shop)->first();
    }
}

if (!function_exists('headersToArray')) {

    function headersToArray( $str )
    {
        $headers = array();
        $headersTmpArray = explode( "\r\n" , $str );
        for ( $i = 0 ; $i < count( $headersTmpArray ) ; ++$i )
        {
            // we dont care about the two \r\n lines at the end of the headers
            if ( strlen( $headersTmpArray[$i] ) > 0 )
            {
                // the headers start with HTTP status codes, which do not contain a colon so we can filter them out too
                if ( strpos( $headersTmpArray[$i] , ":" ) )
                {
                    $headerName = substr( $headersTmpArray[$i] , 0 , strpos( $headersTmpArray[$i] , ":" ) );
                    $headerValue = substr( $headersTmpArray[$i] , strpos( $headersTmpArray[$i] , ":" )+1 );
                    $headers[$headerName] = $headerValue;
                }
            }
        }
        return $headers;
    }
}

if (!function_exists('unixTimeDifferenceInSeconds')) {

    function unixTimeDifferenceInSeconds($time)
    {
        if($time != 0){
            $time = date("H:i:s",$time);
            return Carbon::parse($time)->diffInSeconds(Carbon::now());
        }
        return false;
    }
}

if (!function_exists('concurrent_requests')) {

    function concurrent_requests($client,$method,$url,$post_array,$total)
    {
        if ($method != 'GET') {
            for ($i = 0; $i < $total; $i++) {
                try {

                    $make_api_call = $client->request($method, $url, $post_array);
                } catch (\GuzzleHttp\Exception\ClientException $e) {

                    if ($e->getResponse()->getStatusCode() == 429) {
                        //return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $e->getResponse()->getHeader('X-Rate-Limit-Reset')[0] ?? 50];
                        return true;
                    }

                    $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);

                    //   return ['status' => false, 'message' => "Lob API Exception- Error Code: " . ($errors['error']['status_code'] ?? 0) . " Details: " . ($errors['error']['message'] ?? "")];
                } catch
                (\Exception $e) {

                    //   return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
                }
            }
        }
    }
}
if (!function_exists('checkAccountIsExpired')) {
    function checkAccountIsExpired($channelAccountId): bool
    {
        $response = null;
        $channelAccount = ChannelAccount::find($channelAccountId);
        if($channelAccount){
            $channelName    = $channelAccount->channel->name;
             if($channelName == 'freshworks_online'){
                $freshworksApiLibrary        = new \App\Services\Connectors\FreshworksApiLibrary();
                $response                    = $freshworksApiLibrary->test_connection($channelAccount);
            }
            if(isset($response)){
                $status                      = $response['status'];
                $channelAccount->expired     = ($status == false) ? 1 : 0;
                $channelAccount->exception_message = $response['message'] ?? null;
                $channelAccount->save();
                return $status;
            }
        }
        return true;
    }
}
