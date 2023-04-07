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
            ['event_name'=>'Cart' ,'is_active'=>1],
            ['event_name'=>'Checkout','is_active'=>1],
            ['event_name'=>'Collection','is_active'=>1],
            ['event_name'=>'CollectionPublication','is_active'=>0],
            ['event_name'=>'Customer' ,'is_active'=>1],
            ['event_name'=>'CustomerSavedSearch','is_active'=>1],
            ['event_name'=>'DraftOrder','is_active'=>1],
            ['event_name'=>'Fulfillment','is_active'=>1],
            ['event_name'=>'FulfillmentEvent','is_active'=>1],
            ['event_name'=>'InventoryItem','is_active'=>1],
            ['event_name'=>'InventoryLevel','is_active'=>1],
            ['event_name'=>'Location','is_active'=>1],
            ['event_name'=>'Order','is_active'=>1],
            ['event_name'=>'OrderTransaction','is_active'=>1],
            ['event_name'=>'Product','is_active'=>1],
            ['event_name'=>'ProductListing','is_active'=>0],
            ['event_name'=>'Refund','is_active'=>1],
            ['event_name'=>'Shop','is_active'=>1],
            ['event_name'=>'TenderTransaction','is_active'=>1],
            ['event_name'=>'Theme','is_active'=>1],
            ['event_name'=>'OrderEdit','is_active'=>1],
            ['event_name'=>'ShopAlternateLocale','is_active'=>1],
            ['event_name'=>'Dispute','is_active'=>1],
            ['event_name'=>'SubscriptionContract','is_active'=>0],


        ];
        WebhookEvent::insert($data);
    }
}
