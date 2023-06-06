<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
   
class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'desc' => 'Super Admin AMI',
                'status'=>'1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'auditor',
                'desc' => 'Auditor AMI',
                'status'=>'1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'auditee',
                'desc' => 'Auditee AMI',
                'status'=>'1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);

        // $user = [
        //     [
        //        'name'=>'Admin',
        //        'email'=>'admin@itsolutionstuff.com',
        //         'is_admin'=>'1',
        //        'password'=> bcrypt('123456'),
        //     ],
        //     [
        //        'name'=>'User',
        //        'email'=>'user@itsolutionstuff.com',
        //         'is_admin'=>'0',
        //        'password'=> bcrypt('123456'),
        //     ],
        // ];
  
        // foreach ($user as $key => $value) {
        //     User::create($value);
        // }
    }
}