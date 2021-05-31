<?php

namespace Database\Seeders;

use App\Models\{
    Contact,
    Ticket
};
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::factory(50)->create();
        Ticket::factory(300)->create();
    }
}
