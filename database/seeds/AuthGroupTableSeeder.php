<?php

use App\AuthGroup;
use Illuminate\Database\Seeder;

class AuthGroupTableSeeder extends Seeder {
    
    public function run() {
        DB::table('auth_groups')->delete();
        // 权限组数据
//        AuthGroup::create([
//           'name' => '普通用户'
//        ]);
//        
//        AuthGroup::create([
//            'name' => '管理员'
//        ]);
        
        SeederHelper::doSeed(AuthGroup::class, ['普通用户', '管理员']);
        
        // 这种使用model::create([])的方法一次只能插入一条数据
        // 但是会对laravel自动通过timestamps()方法自动生成的created_at和updated_ta列填充当前时间
    }
}

