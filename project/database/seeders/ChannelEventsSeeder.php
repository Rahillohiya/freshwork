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
                'name' => 'Create Contact',
                'slug' => 'create_contacts',
                'status' => 1,
            ],
            [
                'name' => 'Update Contact',
                'slug' => 'update_contacts',
                'status' => 1,
            ],
        ];
        \App\Entities\ChannelEvent::insert($data);
    }
}
