<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Entities\WebhookEvent;

class WebhookEventsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $data = [
            ['event_name'=>'Cart' ,'slug'=>'Cart' ,'is_active'=>1],
            ['event_name'=>'Checkout','slug'=>'Checkout','is_active'=>1],
            ['event_name'=>'Collection','slug'=>'Collection','is_active'=>1],
            ['event_name'=>'CollectionPublication','slug'=>'CollectionPublication','is_active'=>0],
            ['event_name'=>'Customer' ,'slug'=>'Customer' ,'is_active'=>1],
            ['event_name'=>'CustomerSavedSearch','slug'=>'CustomerSavedSearch','is_active'=>1],
            ['event_name'=>'DraftOrder','slug'=>'DraftOrder','is_active'=>1],
            ['event_name'=>'Fulfillment','slug'=>'Fulfillment','is_active'=>1],
            ['event_name'=>'FulfillmentEvent','slug'=>'FulfillmentEvent','is_active'=>1],
            ['event_name'=>'InventoryItem','slug'=>'InventoryItem','is_active'=>1],
            ['event_name'=>'InventoryLevel','slug'=>'InventoryLevel','is_active'=>1],
            ['event_name'=>'Location','slug'=>'Location','is_active'=>1],
            ['event_name'=>'Order','slug'=>'Order','is_active'=>1],
            ['event_name'=>'OrderTransaction','slug'=>'OrderTransaction','is_active'=>1],
            ['event_name'=>'Product','slug'=>'Product','is_active'=>1],
            ['event_name'=>'ProductListing','slug'=>'ProductListing','is_active'=>0],
            ['event_name'=>'Refund','slug'=>'Refund','is_active'=>1],
            ['event_name'=>'Shop','slug'=>'Shop','is_active'=>1],
            ['event_name'=>'TenderTransaction','slug'=>'TenderTransaction','is_active'=>1],
            ['event_name'=>'Theme','slug'=>'Theme','is_active'=>1],
            ['event_name'=>'OrderEdit','slug'=>'OrderEdit','is_active'=>1],
            ['event_name'=>'ShopAlternateLocale','slug'=>'ShopAlternateLocale','is_active'=>1],
            ['event_name'=>'Dispute','slug'=>'Dispute','is_active'=>1],
            ['event_name'=>'SubscriptionContract','slug'=>'SubscriptionContract','is_active'=>0],


        ];
        WebhookEvent::insert($data);
    }
}
