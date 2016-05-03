<?php

use App\User;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    
    public function run() 
    {
        DB::table('users')->delete();
        
        // 默认添加一个管理员帐户
        User::create([
            'name' => 'admin',
            'email' => 'jijiiscoming@hotmail.com',
            'password' => bcrypt('admin123456'),
            'ag_id' => 2,
        ]);
    }
}
