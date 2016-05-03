<?php

use App\ProductCategory;

use Illuminate\Database\Seeder;

class ProductCategoryTableSeeder extends Seeder {
    
    public function run() {
        
        DB::table('product_categories')->delete();
        
        // 产品类型
//        $productCategoryList = ['护手霜', 'BB霜', '润肤露', '卸妆水', '洗面奶', '牙膏', '洗衣粉'];
//        $count = count($productCategoryList);
//        
//        for ($i = 0; $i < $count; ++$i)
//        {
//            ProductCategory::create([
//                'name' => $productCategoryList[$i]
//            ]);
//        }
        
        SeederHelper::doSeed(ProductCategory::class, ['护手霜', 'BB霜', '润肤露', '卸妆水', '洗面奶', '牙膏', '洗衣粉']);
        
//        DB::table('product_categories')->insert([
//            [
//                'name' => '护手霜',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => 'BB霜',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => '润肤露',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => '卸妆水',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => '洗面奶',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => '牙膏',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => '洗衣粉',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//        ]);
    }
}

