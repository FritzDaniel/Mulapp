<?php

use App\User;
use \Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Admin",
            'username' => "admin",
            'email' => "admin@mulapp.com",
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('secret'),
            'roles' => 'admin',
            'phone' => '085892262574',
            'gender' => 'Male',
            'dob' => '1996-10-15',
            'avatar' => 'default.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::create([
            'name' => "Teacher",
            'username' => "teacher",
            'email' => "teacher@mulapp.com",
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('secret'),
            'roles' => 'teacher',
            'phone' => '085892262574',
            'gender' => 'Male',
            'dob' => '1996-10-15',
            'avatar' => 'default.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        User::create([
            'name' => "Student",
            'username' => "student",
            'email' => "student@mulapp.com",
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('secret'),
            'roles' => 'student',
            'phone' => '085892262574',
            'gender' => 'Male',
            'dob' => '1996-10-15',
            'avatar' => 'default.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
