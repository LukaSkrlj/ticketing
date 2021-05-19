<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        $this->call(TicketTypesSeeder::class);
        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'name' => 'Luka',
            'password' => '12345678',
            'email' => 'a@a.com'
        ]);
        \App\Models\Contact::factory(10)->create();
        \App\Models\Ticket::factory(10)->create();
    }
}
