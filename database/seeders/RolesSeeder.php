<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('roles')) {
            DB::table('roles')->insert([
                [
                    'name' => 'admin', 
                ],
                [
                    'name' => 'user',
                ],
            ]);
        }
    }
}
