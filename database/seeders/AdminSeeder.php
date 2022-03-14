<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            ["first_name"=>"Super", "last_name"=>"Admin", "email"=>"admin@admin.com","password"=>Hash::make('123456')]
        ]);
    }
}
