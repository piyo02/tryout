<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Variation;
use App\Models\Collection;
use App\Models\StudentProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'role admin'
        ]);
        Role::create([                      //uadmin
            'name' => 'User Admin',
            'slug' => 'uadmin',
            'description' => 'role uadmin'
        ]);
        Role::create([                      //mentor
            'name' => 'Mentor',
            'slug' => 'mentor',
            'description' => 'role mentor'
        ]);
        Role::create([                      //student
            'name' => 'Siswa',
            'slug' => 'student',
            'description' => 'role student'
        ]);

        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => \bcrypt('admin'),
            'role_id'   => 1,
        ]);
        User::create([
            'name'      => 'Administrator',
            'email'     => 'uadmin@gmail.com',
            'password'  => \bcrypt('uadmin'),
            'role_id'   => 2,
        ]);
        User::create([
            'name'      => 'Mentor',
            'email'     => 'mentor@gmail.com',
            'password'  => \bcrypt('mentor'),
            'role_id'   => 3,
        ]);
        User::create([
            'name'      => 'Siswa',
            'email'     => 'student@gmail.com',
            'password'  => \bcrypt('student'),
            'role_id'   => 4,
        ]);

        StudentProfile::create([
            'address' => 'BTN GRAHA MANDIRI PERMAI BLOK K/7',
            'phone' => '081232578168',
            'birthday' => 'Kendari, 03-01-2000',
            'user_id' => 4,
        ]);

        Variation::create([
            'about' => 'collection',
            'value' => 'Soal Biasa',
        ]);
        Variation::create([
            'about' => 'collection',
            'value' => 'Soal Kolom',
        ]);
        Variation::create([
            'about' => 'collection',
            'value' => 'Soal Kolom Group',
        ]);
        Collection::create([
            'name' => 'Tes Pengetahuan Umum',
            'variation_id' => 1,
        ]);
        Variation::create([
            'about' => 'question',
            'value' => 'Kecepatan',
        ]);
        Variation::create([
            'about' => 'question',
            'value' => 'Ketelitian',
        ]);
        Variation::create([
            'about' => 'question',
            'value' => 'Ketahanan',
        ]);
    }
}
