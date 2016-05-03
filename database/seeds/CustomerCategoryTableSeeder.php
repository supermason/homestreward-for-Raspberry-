<?php

use App\CustomerCategory;

use Illuminate\Database\Seeder;

class CustomerCategoryTableSeeder extends Seeder{
    
    public function run() {
        
        DB::table('customer_categories')->delete();
        
        // 客户类型数据（暂时只有 散户和代理）        
//        DB::table('customer_categories')->insert([
//           ['name' => '散户'],
//           ['name' => '代理']
//       ]);
        
//        CustomerCategory::create(['name' => '散户']);
//        CustomerCategory::create(['name' => '代理']);
        
        SeederHelper::doSeed(CustomerCategory::class, ['散户', '代理']);
        
       // 使用这种方式可以批量插入数据
       // 所有字段必须手动填充，通过timestamps()方法自动生成的created_at和updated_at会默认变成：0000-00-00 00:00:00
    }
}
