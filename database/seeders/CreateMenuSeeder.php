<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreateMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            [
                'name' => 'Home',
                'level' => 'main_menu',
                'master'=>'0',
                'url' => '/',
                'icon' => null,
                'role_id'=>'1,2,3,4',
                'status'=>'1',
                'sorting'=>'1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Dashboard',
                'level' => 'main_menu',
                'master'=>'0',
                'url' => 'admin/home',
                'icon' => null,
                'role_id'=>'1',
                'status'=>'1',
                'sorting'=>'2',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Dashboard',
                'level' => 'main_menu',
                'master'=>'0',
                'url' => 'auditor/home',
                'icon' => null,
                'role_id'=>'2',
                'status'=>'1',
                'sorting'=>'2',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Dashboard',
                'level' => 'main_menu',
                'master'=>'0',
                'url' => 'auditee/home',
                'icon' => null,
                'role_id'=>'3',
                'status'=>'1',
                'sorting'=>'2',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Dashboard',
                'level' => 'main_menu',
                'master'=>'0',
                'url' => 'pimpinan/home',
                'icon' => null,
                'role_id'=>'4',
                'status'=>'1',
                'sorting'=>'2',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Master Data',
                'level' => 'main_menu',
                'master'=>'0',
                'url' => '',
                'icon' => null,
                'role_id'=>'1,2,3',
                'status'=>'1',
                'sorting'=>'3',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Renstra',
                'level' => 'sub_menu',
                'master'=>'1',
                'url' => '',
                'icon' => null,
                'role_id'=>'1',
                'status'=>'1',
                'sorting'=>'4',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'The Work Unit',
                'level' => 'sub_menu',
                'master'=>'1',
                'url' => '',
                'icon' => null,
                'role_id'=>'1',
                'status'=>'1',
                'sorting'=>'5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
