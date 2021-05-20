<?php

namespace Database\Seeders;

use App\Models\{
    User,
    Ticket,
    Contact
};
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
        $user = User::query()->create([
            'name' => 'Admin',
            'password' => '12345678',
            'email' => 'a@a.com'
        ]);
        $user->assignRole('admin');

        User::query()->create([
            'name' => 'User',
            'password' => '12345678',
            'email' => 'u@u.com'
        ]);

        $this->call(TicketTypesSeeder::class);

        User::factory(10)->create();
        Contact::factory(20)->create();
        Ticket::factory(40)->create();
    }
}
