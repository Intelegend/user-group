<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            'name' => 'Группа1',
            'expire_hours' => 1,
        ]);
        DB::table('groups')->insert([
            'name' => 'Группа2',
            'expire_hours' => 2,
        ]);
    }
}
