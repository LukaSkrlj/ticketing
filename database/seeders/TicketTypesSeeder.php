<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticket_types = [
            ['name' => 'Complaint'],
            ['name' => 'Proposal'],
            ['name' => 'Upgrade']
        ];

        foreach ($ticket_types as $ticket_type) {
            TicketType::query()->create($ticket_type);
        }
    }
}
