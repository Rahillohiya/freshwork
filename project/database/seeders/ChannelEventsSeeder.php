<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChannelEventsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Create Customer',
                'slug' => 'create_customer',
                'status' => 1,
            ],
            [
                'name' => 'Update Customer',
                'slug' => 'update_customer',
                'status' => 1,
            ],
            [
                'name' => 'Create Product or Service',
                'slug' => 'create_product_or_service',
                'status' => 1,
            ],
            [
                'name' => 'Create Invoice',
                'slug' => 'create_invoice',
                'status' => 1,
            ],
            [
                'name' => 'Send Invoice',
                'slug' => 'send_invoice',
                'status' => 1,
            ],

            [
                'name' => 'Create Sales Receipt',
                'slug' => 'create_sales_receipt',
                'status' => 1,
            ],[
                'name' => 'Create Purchase Order',
                'slug' => 'create_purchase_order',
                'status' => 1,
            ],



            [
                'name' => 'Create Credit Memo',
                'slug' => 'create_credit_memo',
                'status' => 1,
            ],
            [
                'name' => 'Create Refund Receipt',
                'slug' => 'create_refund_receipt',
                'status' => 1,
            ],
            [
                'name' => 'Create Estimate',
                'slug' => 'create_estimate',
                'status' => 1,
            ],
            [
                'name' => 'Create Payment',
                'slug' => 'create_payment',
                'status' => 1,
            ],
            [
                'name' => 'Send Payment',
                'slug' => 'send_payment',
                'status' => 1,
            ],
            [
                'name' => 'Void Payment',
                'slug' => 'void_payment',
                'status' => 1,
            ],
            [
                'name' => 'Create Bill (Account Based)',
                'slug' => 'create_bill_account_based',
                'status' => 1,
            ],
            [
                'name' => 'Create Bill Payment',
                'slug' => 'create_bill_payment',
                'status' => 1,
            ],
            [
                'name' => 'Create Credit Card Payment',
                'slug' => 'create_credit_card_payment',
                'status' => 1,
            ],
            [
                'name' => 'Create an Employee',
                'slug' => 'create_employee',
                'status' => 1,
            ],
            [
                'name' => 'Create Time Activity',
                'slug' => 'create_time_activity',
                'status' => 1,
            ],
            [
                'name' => 'Create Journal Entry',
                'slug' => 'create_journal_entry',
                'status' => 1,
            ],
            [
                'name' => 'Update Invoice',
                'slug' => 'update_invoice',
                'status' => 1,
            ],
            [
                'name' => 'Create Department',
                'slug' => 'create_department',
                'status' => 1,
            ],
            [
                'name' => 'Create a Purchase',
                'slug' => 'create_purchase',
                'status' => 1,
            ],
            [
                'name' => 'Create Tax Agency',
                'slug' => 'create_tax_agency',
                'status' => 1,
            ],
            [
                'name' => 'Create Vendor Credit (with line items support i-e Item Based Expense Line)',
                'slug' => 'create_vendor_credit_item_based',
                'status' => 1,
            ],

            [
                'name' => 'Create Vendor Credit (without line items support i-e Account Based Expense Line)',
                'slug' => 'create_vendor_credit_account_based',
                'status' => 1,
            ],

            [
                'name' => 'Create Class',
                'slug' => 'create_class',
                'status' => 1,
            ],
            [
                'name' => 'Update Class',
                'slug' => 'update_class',
                'status' => 1,
            ],
            [
                'name' => 'Create Deposit',
                'slug' => 'create_deposit',
                'status' => 1,
            ],
            [
                'name' => 'Create a Term',
                'slug' => 'create_term',
                'status' => 1,
            ],

        ];
        \App\Entities\ChannelEvent::insert($data);
    }
}
