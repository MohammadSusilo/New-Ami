<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
   
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super admin',
                'email' => 'superadmin@gravel.test',
                'email_verified_at' =>now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'role_id'=>'1',
                'status'=>'1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Auditor',
                'email' => 'auditor@gravel.test',
                'email_verified_at' =>now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'role_id'=>'2',
                'status'=>'1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'Auditee',
                'email' => 'auditee@gravel.test',
                'email_verified_at' =>now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'role_id'=>'3',
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