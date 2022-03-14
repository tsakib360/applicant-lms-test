<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::insert([
            ["name"=>"Laravel", "code"=>1001, "price"=>3000, "created_at" => now(), "updated_at" => now()],
            ["name"=>"Python", "code"=>1002, "price"=>2500, "created_at" => now(), "updated_at" => now()],
        ]);
    }
}
