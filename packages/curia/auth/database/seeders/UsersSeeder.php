<?php

namespace Curia\Auth\Database\Seeders;

use Curia\Auth\Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        (new UserFactory)->admin()->create([
            'full_name' => 'Super Admin',
            'email' => 'super@admin.com'
        ]);
    }
}