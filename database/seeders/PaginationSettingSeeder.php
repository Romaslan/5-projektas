<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaginationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('pagination_settings')->insert([
            'title' => '15',
            'value' => 15,
            'visible' => 1
        ]);
        Db::table('pagination_settings')->insert([
            'title' => '30',
            'value' => 30,
            'visible' => 0
        ]);
        //s raideles truko
        
        Db::table('pagination_settings')->insert([
            'title' => 'All',
            'value' => 1,
            'visible' => 1
        ]);
    }
}
