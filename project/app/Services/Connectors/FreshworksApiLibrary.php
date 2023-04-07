<?php namespace App\Services\Connectors;

use App\Entities\CustomApp;

class FreshworksApiLibrary
{
    private $shopify_service;
    private $freshworks_client;
    //value of this variable is set in getAccountWithUpdatedToken function
    private $endpoint_url;
    private $retry_after = 60;

    function __construct()
    {
        $this->shopify_service = new  \App\Services\ShopifyService();
    }

    private
    function getAccountWithUpdatedToken($account)

    {
        //first  set endpoint url from account type to make API calls
        $this->setEndpointUrl($account);
        return $account;
    }

    /*
        *Set endpoint url either production or sandbox depending upon the account type
        */
    private
    function setEndpointUrl($account)
    {
        $this->endpoint_url = trim($account->login_credentials['instance_url'],"/");
    }

    public
    function create_deposit($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {

            $final_object_array = [];
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Deposit created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $line_items = [];
                $main_intex_items = [];
                foreach ($post_data_array as $key => $value):
                    if (in_array($key, ['LineNum', 'Description', 'TaxCodeRef', 'ClassRef', 'Entity', 'PaymentMethodRef', 'AccountRef', 'Amount', 'DetailType', 'DepositLineDetail'])) {
                        $line_items[$key] = $value;
                    } else {
                        $main_intex_items[$key] = $value;
                    }
                endforeach;
                $final_object_array = $main_intex_items;
                $final_object_array['Line'][] = $line_items;
                $realmId= $freshworks_account->login_credentials['realmId'];

//making api call
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/deposit?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Deposit'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create Deposit."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_or_update_class($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            if ($channel_event->slug == "update_class" && !$freshworks_event_settings->object_id)
                return ['status' => false, 'message' => "No class details found to update.Make sure you've chosen correct class in event setup page."];
            if ($channel_event->slug == "update_class") {
                // object id key here represents ID of customer to update in freshworks_online
                $post_data_array['Id'] = $freshworks_event_settings->object_id;
                $class = $this->get_company_class($freshworks_account, $freshworks_event_settings->object_id);
                if (empty($class))
                    return ['status' => false, 'message' => "No Class details found to update.Make sure Class exists in freshworks_online or not modified by another user or appication.."];
                else
                    $post_data_array['SyncToken'] = $class['SyncToken'];
                $response_message = "Class updated successfully.";
            } else {
                $response_message = "Class created successfully.";
            }
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $realmId= $freshworks_account->login_credentials['realmId'];

                //making api call
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/class?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($post_data_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Class'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to add or update Class."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_time_activity($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "TimeActivity added successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $realmId= $freshworks_account->login_credentials['realmId'];

                //making api call
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/timeactivity?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($post_data_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['TimeActivity'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to add TimeActivity."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_employee($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Employee added successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $realmId= $freshworks_account->login_credentials['realmId'];

                //making api call
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/employee?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($post_data_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Employee'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to add Employee."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_department($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Department created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/department?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($post_data_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Department'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create department."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }public
function create_term($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
{
    try {
        $post_data_array = [];
        $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
        if (!$freshworks_account)
            return ['status' => false, 'message' => "Unable to authorize the user account."];
        $response_message = "Term created successfully.";
        $api_fields = $freshworks_event_settings->api_fields;
        foreach ($api_fields as $api_field_key => $api_field_value):
            if (is_array($api_field_value)) {
                $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                if (!empty($get_values))
                    $post_data_array[$api_field_key] = $get_values;
            } elseif (!is_null($api_field_value)) {
                $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
            }

        endforeach;
        //making array strucutured as per freshworks_online API
        if (sizeof($post_data_array) > 0) {
            //making api call
            $realmId= $freshworks_account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/term";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("POST", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'body' => \GuzzleHttp\json_encode($post_data_array),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            if (isset($getBody['Term'])) {
                return ['status' => true, 'message' => $response_message];
            }
        }
        return ['status' => false, 'message' => "Unable to create term."];


    } catch (\GuzzleHttp\Exception\ClientException $e) {
        if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
        $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
        if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
            $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
        } else {
            $error_message = "Misconfiguration found in event setup.Please check all settings.";
        }
        return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

    } catch
    (\Exception $e) {
        return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
    }

}

    public
    function create_credit_card_payment($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "credit card payment created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/creditcardpayment?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($post_data_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['CreditCardPaymentTxn'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create credit card payment."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_bill_payment($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $final_object_array = [];
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Bill payment created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;

            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $line_items = [];
                $main_intex_items = [];
                foreach ($post_data_array as $key => $value):
                    if (in_array($key, ['Amount', 'LinkedTxn'])) {
                        $line_items[$key] = $value;
                    } else {
                        $main_intex_items[$key] = $value;
                    }
                endforeach;

                $final_object_array = $main_intex_items;
                $final_object_array['Line'][] = $line_items;
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/billpayment?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['BillPayment'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create bill payment."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_journal_entry($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Journal entry added successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }
            endforeach;
            if (sizeof($post_data_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/journalentry?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($post_data_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['JournalEntry'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to add journal entry."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_bill($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Bill created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (in_array($api_field_key, ['LineNum', 'Description', 'TaxCodeRef', 'ClassRef', 'CustomerRef', 'ItemRef', 'TaxInclusiveAmt', 'Amount', 'DetailType', 'ItemBasedExpenseLineDetail', 'Qty', 'UnitPrice', 'AccountBasedExpenseLineDetail'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }
            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/bill?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Bill'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create bill."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    private function line_items_array_format($shopify_webhook_data, $line_items)
    {
        $line_items_array = [];
        $line_items_counter = 1;
        if (isset($shopify_webhook_data['line_items'])) {
            $line_items_counter = count($shopify_webhook_data['line_items']);
        } elseif (isset($shopify_webhook_data['refund_line_items'])) {
            $line_items_counter = count($shopify_webhook_data['refund_line_items']);
        }
        // line items array format for freshworks_online api
        for ($i = 0; $i < $line_items_counter; $i++):
            foreach ($line_items as $line_item_key => $line_item_value):
                if (is_array($line_item_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($line_item_value, $shopify_webhook_data, $i);
                    if (!empty($get_values))
                        $line_items_array['Line'][$i][$line_item_key] = $get_values;
                } elseif (!is_null($line_item_value)) {
                    $line_items_array['Line'][$i][$line_item_key] = $this->shopify_service->replace_textarea_shopify_variable_values($line_item_value, $shopify_webhook_data, true, $i);
                }
            endforeach;
        endfor;
        return $line_items_array;
    }

    public
    function create_or_update_invoice($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            if ($channel_event->slug == "update_invoice" && !$freshworks_event_settings->object_id)
                return ['status' => false, 'message' => "No invoice details found to update.Make sure you've chosen correct invoice in event setup page."];
            if ($channel_event->slug == "update_invoice") {
                // object id key here represents ID of customer to update in freshworks_online
                $post_data_array['Id'] = $freshworks_event_settings->object_id;
                $invoice = $this->get_company_invoices($freshworks_account, $freshworks_event_settings->object_id);
                if (empty($invoice))
                    return ['status' => false, 'message' => "No invoice details found to update.Make sure invoice exists in freshworks_online or not modified by another user or appication.."];
                else
                    $post_data_array['SyncToken'] = $invoice['SyncToken'];
                $response_message = "Invoice updated successfully.";
            } else {
                $response_message = "Invoice created successfully.";
            }
            $api_fields = $freshworks_event_settings->api_fields;
            //  excluding field which were kept for reference or display on select dropdowns on edit page
            unset($api_fields["object_text"]);
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (in_array($api_field_key, ['Description', 'Amount', 'DetailType', 'SalesItemLineDetail', 'Qty', 'UnitPrice'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }
            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/invoice?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Invoice'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create or update invoice."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_purchase($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {

            $final_object_array = [];
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Purchase created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            // excluding field which were kept for reference or display on select dropdowns on edit page
            unset($api_fields["object_text"]);
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }


            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $line_items = [];
                $main_intex_items = [];
                foreach ($post_data_array as $key => $value):
                    if (in_array($key, ['CurrencyRef', 'AccountRef', 'PaymentType'])) {
                        $main_intex_items[$key] = $value;
                    } else {
                        $line_items[$key] = $value;
                    }
                endforeach;
                $final_object_array = $main_intex_items;
                $final_object_array['Line'][] = $line_items;
//making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/purchase?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Purchase'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create purchase record."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];
        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function send_invoice($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Invoice sent successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            $invoice_id = 0;
            $email_address = '';
            foreach ($api_fields as $api_field_key => $api_field_value):
                if ($api_field_key == 'invoice') {
                    $invoice_id = $api_field_value['Id'] ?? null;
                } elseif ($api_field_key == 'email_address') {
                    $email_address = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if ($invoice_id) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/invoice/$invoice_id/send";
                if (!empty($email_address))
                    $endpoint = $endpoint . "?sendTo=" . $email_address;
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
//                        'form_params' =>[],
//                            \GuzzleHttp\json_encode([]),
                        'headers' => [
                            'Accept' => 'application/json',
//                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Invoice'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to send invoice.Please provide all field values"];

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function send_payment($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "payment sent successfully.";
            $api_fields = $freshworks_event_settings->api_fields;

            $payment_id = 0;
            $email_address = '';
            foreach ($api_fields as $api_field_key => $api_field_value):
                if ($api_field_key == 'payment_id') {
                    $payment_id = $api_field_value;
                } elseif ($api_field_key == 'email_address') {
                    $email_address = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }

            endforeach;
            //making array strucutured as per freshworks_online API
            if ($payment_id) {
                $realmId= $freshworks_account->login_credentials['realmId'];

                //making api call
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/payment/$payment_id/send";
                if (!empty($email_address))
                    $endpoint = $endpoint . "?sendTo=" . $email_address;
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'headers' => [
                            'Accept' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Payment'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to send payment.Please provide all field values"];

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_credit_memo($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Credit Memo created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (!in_array($api_field_key, ['TxnDate', 'BillEmail', 'BillAddr', 'DocNumber', 'TxnTaxDetail', 'CustomerRef', 'CurrencyRef', 'PrintStatus', 'CustomerMemo', 'ApplyTaxAfterDiscount'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
//making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/creditmemo?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['CreditMemo'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create credit memo."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_refund_receipt($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Refund receipt created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (!in_array($api_field_key, ['PaymentRefNum', 'DepositToAccountRef', 'TxnDate', 'BillEmail', 'BillAddr', 'DocNumber', 'TxnTaxDetail', 'CustomerRef', 'CurrencyRef', 'PrintStatus', 'CustomerMemo', 'ApplyTaxAfterDiscount'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/refundreceipt?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['RefundReceipt'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create Refund Receipt."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_estimate($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Estimate created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (!in_array($api_field_key, ['CustomerRef', 'CurrencyRef', 'DocNumber', 'ExpirationDate', 'ShipAddr', 'CustomerMemo'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
//making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/estimate?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Estimate'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create Estimate."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_purchase_order($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Purchase order created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            //  excluding field which were kept for reference or display on select dropdowns on edit page
            unset($api_fields["object_text"]);
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (in_array($api_field_key, ['Description', 'Amount', 'DetailType', 'ItemBasedExpenseLineDetail', 'Qty', 'UnitPrice'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/purchaseorder?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['PurchaseOrder'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create purchase order."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_tax_agency($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {

            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Invoice created successfully.";
            $api_fields = $freshworks_event_settings->api_fields;

            foreach ($api_fields as $api_field_key => $api_field_value):
                $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $realmId= $freshworks_account->login_credentials['realmId'];

                //making api call
                $endpoint = $this->endpoint_url . "/v3/company/$realmId/taxagency?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($post_data_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['TaxAgency'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create agency."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function create_vendor_credit($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Vendor credited successfully.";
            $api_fields = $freshworks_event_settings->api_fields;
            //  excluding field which were kept for reference or display on select dropdowns on edit page
            unset($api_fields["object_text"]);
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (in_array($api_field_key, ['LineNum', 'Description', 'TaxCodeRef', 'ClassRef', 'CustomerRef', 'ItemRef', 'TaxInclusiveAmt', 'Amount', 'DetailType', 'ItemBasedExpenseLineDetail', 'Qty', 'UnitPrice', 'AccountBasedExpenseLineDetail'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
//making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/vendorcredit?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['VendorCredit'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create vendor credit."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    private
    function extract_field_values_from_richtextarea($value_array, $shopify_webhook_data, $return_line_item_index = null)
    {
        $response_array = [];
        foreach ($value_array as $api_field_key => $value):
            if (!is_null($value)) {
                if (is_array($value)) {
                    $response_array_obj = $this->extract_field_values_from_richtextarea($value, $shopify_webhook_data, $return_line_item_index);
                    if (!empty($response_array_obj))
                        $response_array[$api_field_key] = $response_array_obj;
                } else {
                    $response_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($value, $shopify_webhook_data, true, $return_line_item_index);

                }
            }
        endforeach;
        return $response_array;
    }


    public
    function create_sales_receipt($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Sales Receipt created successfully.";

            $api_fields = $freshworks_event_settings->api_fields;
            //  excluding field which were kept for reference or display on select dropdowns on edit page
            unset($api_fields["object_text"]);
            $line_items = [];
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (in_array($api_field_key, ['Description', 'Amount', 'DetailType', 'SalesItemLineDetail', 'Qty', 'UnitPrice'])) {
                    $line_items[$api_field_key] = $api_field_value;
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;
            //insert same number of line items in QB as available in shopify webhook
            $line_items_array = $this->line_items_array_format($shopify_webhook_data, $line_items);
            $final_object_array = array_merge($post_data_array, $line_items_array);
            //making array strucutured as per freshworks_online API
            if (sizeof($final_object_array) > 0) {
                //making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/salesreceipt?minorversion=55";
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['SalesReceipt'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to create sales receipt."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public function create_or_void_payment($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {

            $final_object_array = [];
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            if ($channel_event->slug == "void_payment" && !$freshworks_event_settings->object_id)
                return ['status' => false, 'message' => "No payment details found to update.Make sure you've chosen correct payment ID in event setup page."];
            if ($channel_event->slug == "void_payment") {
                // object id key here represents ID of customer to update in freshworks_online
                $post_data_array['Id'] = $freshworks_event_settings->object_id;
                $payment = $this->get_company_payments($freshworks_account, $freshworks_event_settings->object_id);
                if (empty($payment))
                    return ['status' => false, 'message' => "No payment details against payment ID $freshworks_event_settings->object_id found to void.Make sure payment exists in freshworks_online or not modified by another user or appication.."];
                else
                    $post_data_array['SyncToken'] = $payment['SyncToken'];
                $response_message = "Payment voided successfully.";
            } else {
                $response_message = "Payment made successfully.";
            }
            $api_fields = $freshworks_event_settings->api_fields;
            foreach ($api_fields as $api_field_key => $api_field_value):
                if (is_array($api_field_value)) {
                    $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                    if (!empty($get_values))
                        $post_data_array[$api_field_key] = $get_values;
                } elseif (!is_null($api_field_value)) {
                    $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                }


            endforeach;
            //making array strucutured as per freshworks_online API
            if (sizeof($post_data_array) > 0) {
                $line_items = [];
                $main_intex_items = [];
                foreach ($post_data_array as $key => $value):
                    if (in_array($key, ['Amount', 'LinkedTxn'])) {
                        $line_items[$key] = $value;
                    } else {
                        $main_intex_items[$key] = $value;

                    }
                endforeach;
                $final_object_array = $main_intex_items;
                if (!empty($line_items))
                    $final_object_array['Line'][] = $line_items;
//making api call
                $realmId= $freshworks_account->login_credentials['realmId'];

                $endpoint = $this->endpoint_url . "/v3/company/$realmId/payment?minorversion=55";
                if ($channel_event->slug == "void_payment") {
                    $endpoint = $endpoint . "&operation=update&include=void";
                }

                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $endpoint,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($final_object_array),
                        'headers' => [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json',
                            'X-PrettyPrint' => 1,
                            'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                        ]
                    ]
                );
                $getBody = json_decode($request->getBody(), true);
                if (isset($getBody['Payment'])) {
                    return ['status' => true, 'message' => $response_message];
                }
            }
            return ['status' => false, 'message' => "Unable to made payment."];


        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public function  create_or_update_customer($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            if ($channel_event->slug == "update_customer" && !$freshworks_event_settings->object_id)
                return ['status' => false, 'message' => "No customer details found to update.Make sure you've chosen correct customer in event setup page."];
            if ($channel_event->slug == "update_customer") {
                // object id key here represents ID of customer to update in freshworks_online
                $post_data_array['Id'] = $freshworks_event_settings->object_id;
                $customer = $this->get_company_customers($freshworks_account, $freshworks_event_settings->object_id);
                if (empty($customer))
                    return ['status' => false, 'message' => "No customer details found to update.Make sure customer exists in freshworks_online or not modified by another user or appication.."];
                else
                    $post_data_array['SyncToken'] = $customer['SyncToken'];
                $response_message = "Customer updated successfully.";
            } else {
                $response_message = "Customer added successfully.";
            }

            $api_fields = $freshworks_event_settings->api_fields;

            foreach ($api_fields as $api_field_key => $api_field_value):
                //              excluding field which were kept for reference or display on select dropdowns on edit page
                if (in_array($api_field_key, ["object_text"])) {
                    unset($api_fields[$api_field_key]);
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;

            $realmId= $freshworks_account->login_credentials['realmId'];
            $endpoint = $this->endpoint_url . "/v3/company/$realmId/customer";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("POST", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'body' => \GuzzleHttp\json_encode($post_data_array),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            if (isset($getBody['Customer'])) {
                return ['status' => true, 'message' => $response_message];
            } else {
                return ['status' => false, 'message' => "Unable to create case"];
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {

            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }




    public function get_contacts($account, $customer_id = 0, $request = null)
    {
        $data_array = [];
        try {
            
            if ( strpos( $this->endpoint_url, 'freshsales.io' ) !== false ) {
                $url = $this->endpoint_url.'/api/search?q='.$request['email'].'&include=contact';
            } else {
                $url = $this->endpoint_url.'/crm/sales/api/search?q='.$request['email'].'&include=contact';
            }
            
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $url,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Token token=' . $account->login_credentials['api_key']
                    ]
                ]
            );
            $response = json_decode($request->getBody(), true);
            
            
            return $response;
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public function  create_or_update_contacts($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            $post_data_array = [];

            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            if ($channel_event->slug == "update_contacts" && !$freshworks_event_settings->object_id)
                return ['status' => false, 'message' => "No customer details found to update.Make sure you've chosen correct customer in event setup page."];

            if ($channel_event->slug == "update_contacts") {
                // object id key here represents ID of customer to update in freshworks_online
                $post_data_array['Id'] = $freshworks_event_settings->object_id;
                $customer = $this->get_contacts($freshworks_account, $freshworks_event_settings->object_id,$shopify_webhook_data);
               /* if (empty($customer))
                    return ['status' => false, 'message' => "No customer details found to update.Make sure customer exists in freshworks_online or not modified by another user or appication.."];
                else
                    $post_data_array['SyncToken'] = $customer['SyncToken'];*/
                $response_message = "Customer updated successfully.";
            } else {
                $response_message = "Customer added successfully.";
            }

            $api_fields = $freshworks_event_settings->api_fields;

            foreach ($api_fields as $api_field_key => $api_field_value):
                //              excluding field which were kept for reference or display on select dropdowns on edit page
                if (in_array($api_field_key, ["object_text"])) {
                    unset($api_fields[$api_field_key]);
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }
            endforeach;

            if ($channel_event->slug == "update_contacts" && !empty($customer) ) {

                $dataa = array(
                    'contact'   => $post_data_array,
                );
                
                $data = json_encode( $dataa );
                $header = array(
                    'Authorization: Token token='.$freshworks_account->login_credentials['api_key'],
                    'Content-Type: application/json',
                );
                
                if(strpos( $this->endpoint_url, 'freshsales.io' ) !== false ){
                    $url = $this->endpoint_url.'/api/contacts/'.$record_id;
                } else {
                    $url = $this->endpoint_url.'/crm/sales/api/contacts/'.$record_id;
                }

               /* $ch = curl_init( $url );
                curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
                $json_response = curl_exec( $ch );
                $status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
                curl_close( $ch );

                $response = json_decode( $json_response , 1);*/

                
                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $url,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($dataa),
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Token token=' . $freshworks_account->login_credentials['api_key']
                        ]
                    ]
                );
                $response = json_decode($request->getBody(), true);
                
            }else{

                $dataa = array(
                    'contact'   => $post_data_array,
                );


                $data = json_encode( $dataa );
                $header = array(
                    'Authorization: Token token='.$freshworks_account->login_credentials['api_key'],
                    'Content-Type: application/json',
                );
               
                if ( strpos( $this->endpoint_url, 'freshsales.io' ) !== false ) {
                    $url = $this->endpoint_url.'/api/contacts';
                } else {
                    $url = $this->endpoint_url.'/crm/sales/api/contacts';
                }

                /*$ch = curl_init( $url );
                curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
                $json_response = curl_exec( $ch );
                $status = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
                $err = curl_error($ch);
                curl_close( $ch );

                $response = json_decode( $json_response , 1);
                echo "<pre>"; print_r($freshworks_account->login_credentials['api_key']); echo "</pre>";*/


                $client = new \GuzzleHttp\Client();
                $request = $client->request("POST", $url,
                    [
                        'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                        'body' => \GuzzleHttp\json_encode($dataa),
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'Token token=' . $freshworks_account->login_credentials['api_key']
                        ]
                    ]
                );
                $response = json_decode($request->getBody(), true);
                
            }

            if (isset($response['contact']['id'])) {
                return ['status' => true, 'message' => $response_message];
            } else {
                return ['status' => false, 'message' => "Unable to create case"];
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
             
            if (isset($errors['errors']) && isset($errors['errors']['message']) && isset($errors['errors']['message'][0])) {
                $error_message = $errors['errors']['message'][0];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {

            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function get_company_accounts($account, $account_id = 0, $account_type = null, $account_sub_type = null, $classification = null, $request = null)
    {
        $data_array = [];
        try {

            $params_array = ['Classification' => $classification, 'AccountType' => $account_type, 'AccountSubType' => $account_sub_type, 'Id' => $account_id];
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Account";
            $query_array = [];
            foreach ($params_array as $key => $param_value):
                if ($param_value) {
                    $query_array[] = $key . '=' . "'$param_value'";
                }
            endforeach;
            if (sizeof($query_array) > 0) {
                $query .= " Where ";
                $query .= implode(' AND ', $query_array);
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $accounts = $results['Account'] ?? [];
            //if retrieve single customer
            if ($account_id) {
                return $accounts[0] ?? [];
            }
            if (!empty($accounts)) {
                foreach ($accounts as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }


    public
    function get_company_customers($account, $customer_id = 0, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            if ($customer_id)
                $query = "select * from Customer Where Id='$customer_id'";
            else
                $query = "select * from Customer";
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];
            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );

            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $customers = $results['Customer'] ?? [];
            //if retrieve single customer
            if ($customer_id) {
                return $customers[0] ?? [];
            }
            if (!empty($customers)) {
                foreach ($customers as $key => $object) {
                    $data_array[$key]['text'] = $object['DisplayName'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function get_payment_methods($account, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from PaymentMethod";
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );

            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $paymentMethods = $results['PaymentMethod'] ?? [];
            if (!empty($paymentMethods)) {
                foreach ($paymentMethods as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                    return $results = [
                        "results" => $data_array,
                        "offset" => $offset + $max_results,
                        "pagination" => ["more" => true]
                    ];
                }
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function get_company_currencies($account, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from companycurrency";
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];
            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );

            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $companyCurrency = $results['CompanyCurrency'] ?? [];
            if (!empty($companyCurrency)) {
                foreach ($companyCurrency as $key => $object) {
                    $data_array[$key]['text'] = $object['Code'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function refresh_token($account)
    {
        try {
            $login_credentials = $account->login_credentials;

            if($account->custom_app){
                if ($account->login_credentials['account_type'] == "sandbox") {
                    $freshworks_client_id = $account->custom_app->login_credentials['sandbox_client_id'];
                    $freshworks_client_secret =  $account->custom_app->login_credentials['sandbox_client_secret'];
                    $this->freshworks_client = new  \App\Services\Connectors\FreshworksClient(
                        $freshworks_client_id,
                        $freshworks_client_secret);
                } else {
                    $freshworks_client_id =  $account->custom_app->login_credentials['production_client_id'];
                    $freshworks_client_secret = $account->custom_app->login_credentials['production_client_secret'];
                    $this->freshworks_client = new  \App\Services\Connectors\FreshworksClient(
                        $freshworks_client_id,
                        $freshworks_client_secret
                    );
                }
            }else {
                if ($account->login_credentials['account_type'] == "sandbox") {
                    $this->freshworks_client = new  \App\Services\Connectors\FreshworksClient(
                        config('channel.freshworks_sandbox_client_id'),
                        config('channel.freshworks_sandbox_client_secret')
                    );
                } else {
                    $this->freshworks_client = new  \App\Services\Connectors\FreshworksClient(
                        config('channel.freshworks_production_client_id'),
                        config('channel.freshworks_production_client_secret')
                    );
                }
            }
            $token_details = $this->freshworks_client->refreshAccessToken(
                config('channel.freshworks_tokenEndPointUrl'),
                "refresh_token",
                $login_credentials['refresh_token']
            );

            if (!isset($token_details['access_token']))
                return false;
            //check access token expiry time
            $login_credentials['access_token'] = $token_details['access_token'];
            $login_credentials['x_refresh_token_expires_in'] = $token_details['x_refresh_token_expires_in'];
            $login_credentials['refresh_token'] = $token_details['refresh_token'];
            $login_credentials['token_type'] = $token_details['token_type'];
            // add 3600 seconds to current time as access token expires in an hour
            $login_credentials['expires_in'] = (time() + $token_details['expires_in']);
            $account->login_credentials = $login_credentials;
            $account->save();
            return $account;
        } catch (\Exception $e) {
            return false;
        }

    }

    public
    function isAccessTokenExpired($account)
    {
        if (!$account->login_credentials['access_token'] || !$account->login_credentials['expires_in']) {
            return true;
        }
        // If the token is set to expire in the next 30 seconds.
        return ($account->login_credentials['expires_in'] - 30) < time();
    }


    public
    function get_company_items($account, $item_id = 0, $request = null)
    {
        $data_array = [];
        try {

            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Item";
            if ($item_id) {
                $query .= "Where Id=" . $item_id;
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Item'] ?? [];
            //if retrieve single customer
            if ($item_id) {
                return $items[0] ?? [];
            }
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function get_company_departments($account, $department_id = 0, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Department";
            if ($department_id) {
                $query .= "Where Id=" . $department_id;
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Department'] ?? [];
            //if retrieve single customer
            if ($department_id) {
                return $items[0] ?? [];
            }
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    function get_company_tax_codes($account, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from TaxCode";
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['TaxCode'] ?? [];
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function create_product_or_service($freshworks_account, $freshworks_event_settings, $shopify_webhook_data, $channel_event)
    {
        try {
            $post_data_array = [];
            $freshworks_account = $this->getAccountWithUpdatedToken($freshworks_account);
            if (!$freshworks_account)
                return ['status' => false, 'message' => "Unable to authorize the user account."];
            $response_message = "Product or service created successfully.";

            $api_fields = $freshworks_event_settings->api_fields;

            foreach ($api_fields as $api_field_key => $api_field_value):
//              excluding field which were kept for reference or display on select dropdowns on edit page
                if (in_array($api_field_key, ["object_text"])) {
                    unset($api_fields[$api_field_key]);
                } else {
                    if (is_array($api_field_value)) {
                        $get_values = $this->extract_field_values_from_richtextarea($api_field_value, $shopify_webhook_data);
                        if (!empty($get_values))
                            $post_data_array[$api_field_key] = $get_values;
                    } elseif (!is_null($api_field_value)) {
                        $post_data_array[$api_field_key] = $this->shopify_service->replace_textarea_shopify_variable_values($api_field_value, $shopify_webhook_data, true);
                    }
                }

            endforeach;

            $realmId= $freshworks_account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/item";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("POST", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'body' => \GuzzleHttp\json_encode($post_data_array),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $freshworks_account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            if (isset($getBody['Item'])) {
                return ['status' => true, 'message' => $response_message];
            } else {
                return ['status' => false, 'message' => "Unable to create product or service."];
            }

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() == 429) return ['status' => false, 'message' => "Rate Limit Issue", 'retry_after' => $this->retry_after];
            $errors = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents(), true);
            if (isset($errors['Fault']) && isset($errors['Fault']['Error']) && isset($errors['Fault']['Error'][0])) {
                $error_message = $errors['Fault']['Error'][0]['Message'] . ".\n" . 'Details:' . $errors['Fault']['Error'][0]['Detail'];
            } else {
                $error_message = "Misconfiguration found in event setup.Please check all settings.";
            }
            return ['status' => false, 'message' => "Freshworks API Exception: " . $error_message];

        } catch
        (\Exception $e) {
            return ['status' => false, 'message' => "Unable to perform operation.Please contact administrator" . "Error Details:" . $e->getMessage()];
        }

    }

    public
    function get_company_terms($account, $term_id = 0, $request)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Term";
            if ($term_id) {
                $query .= "Where Id=" . $term_id;
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Term'] ?? [];
            //if retrieve single customer
            if ($term_id) {
                return $items[0] ?? [];
            }
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function get_company_vendors($account, $vendor_id = 0, $request)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Vendor";
            if ($vendor_id) {
                $query .= "Where Id=" . $vendor_id;
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Vendor'] ?? [];
            //if retrieve single customer
            if ($vendor_id) {
                return $items[0] ?? [];
            }
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['DisplayName'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }


    public
    function get_company_invoices($account, $invoice_id = 0, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Invoice";
            if ($invoice_id) {
                $query .= " where id='$invoice_id'";
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Invoice'] ?? [];
            //if retrieve single customer
            if ($invoice_id) {
                return $items[0] ?? [];
            }
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['DocNumber'] . " ( " . $object['Id'] . " )";
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function get_company_payments($account, $payment_id = 0, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Payment";
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];
            $endpoint = $this->endpoint_url . "/v3/company/$realmId/";
            if ($payment_id)
                $endpoint = $endpoint . "payment/$payment_id";
            else
                $endpoint = $endpoint . "query?query=$query";

            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            //if retrieve single customer
            if ($payment_id) {
                return $getBody["Payment"] ?? [];
            }
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Payment'] ?? [];
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Id'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    function get_company_class($account, $class_id = 0, $request = null)
    {
        $data_array = [];
        try {

            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Class";
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/";
            if ($class_id)
                $endpoint = $endpoint . "class/$class_id";
            else
                $endpoint = $endpoint . "query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Class'] ?? [];
            //if retrieve single customer
            if ($class_id) {
                return $getBody["Class"] ?? [];
            }
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }


    function get_company_tax_rates($account, $request = null)
    {
        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "Select * From TaxRate";
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";

            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['TaxRate'] ?? [];
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }
        return ['results' => $data_array];
    }

    public
    function get_company_journal_codes($account, $journal_code_id = 0, $request = null)
    {

        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from journalcode";
            if ($journal_code_id) {
                $query .= " where id='$journal_code_id'";
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];
            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['JournalCode'] ?? [];
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['Name'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }

        return ['results' => $data_array];
    }

    public
    function get_company_employees($account, $employee_id = 0, $request = null)
    {

        $data_array = [];
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $query = "select * from Employee";
            if ($employee_id) {
                $query .= " where id='$employee_id'";
            }
            $offset = 1;
            $max_results = 20;
            if (!empty($request->offset)) {
                $offset = $request->offset;
                $query .= " STARTPOSITION " . $offset;
            }
            $query .= " MAXRESULTS " . $max_results;
            $realmId= $account->login_credentials['realmId'];

            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";
            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $account->login_credentials['access_token']
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            $results = $getBody['QueryResponse'] ?? [];
            $items = $results['Employee'] ?? [];
            if (!empty($items)) {
                foreach ($items as $key => $object) {
                    $data_array[$key]['text'] = $object['DisplayName'];
                    $data_array[$key]['id'] = $object['Id'];
                }
                return $results = [
                    "results" => $data_array,
                    "offset" => $offset + $max_results,
                    "pagination" => ["more" => true]
                ];
            }
        } catch (\Exception $e) {
        }

        return ['results' => $data_array];
    }

    function test_connection($account): array
    {
        try {
            $account = $this->getAccountWithUpdatedToken($account);
            $max_results = 1;
            $query = "select * from Class";
            $query .= " MAXRESULTS " . $max_results;
            $access_token = $account->login_credentials['access_token'];
            $realmId= $account->login_credentials['realmId'];
            $endpoint = $this->endpoint_url . "/v3/company/$realmId/query?query=$query";

            $client = new \GuzzleHttp\Client();
            $request = $client->request("GET", $endpoint,
                [
                    'verify' => realpath(__DIR__ . '/../../../../certificates/cacert.pem'),
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                        'X-PrettyPrint' => 1,
                        'Authorization' => 'Bearer ' . $access_token
                    ]
                ]
            );
            $getBody = json_decode($request->getBody(), true);
            return [ 'status' => true ,'message' => ""];
        }catch (\GuzzleHttp\Exception\ClientException $exception){

            if($exception->getResponse()->getStatusCode() == 429)
                return [ 'status' => true ,'message' => ""];

            return [ 'status' => false ,'message' => config('channel.check_token_expiration')];
        }catch(\Exception $exception){
            return [ 'status' => false ,'message' =>  config('channel.check_token_expiration')];
        }

    }

}
