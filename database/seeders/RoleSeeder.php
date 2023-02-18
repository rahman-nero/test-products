<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consumer = Role::create(['name' => 'consumer']);
        $seller = Role::create(['name' => 'seller']);


        $user = User::query()->create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);
        $user->assignRole('consumer');


        $user2 = User::query()->create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);
        $user2->assignRole('consumer');


        $seller1 = User::query()->create([
            'name' => 'Seller 1',
            'email' => 'seller1@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);
        $seller1->assignRole('seller');


        $seller2 = User::query()->create([
            'name' => 'Seller 2',
            'email' => 'seller2@gmail.com',
            'password' => bcrypt('1234567890'),
        ]);
        $seller2->assignRole('seller');
    }
}
