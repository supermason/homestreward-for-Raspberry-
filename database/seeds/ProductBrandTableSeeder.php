<?php

use App\ProductBrand;

use Illuminate\Database\Seeder;

class ProductBrandTableSeeder extends Seeder {
    
    public function run() {
        
        DB::table('product_brands')->delete();
        
        // 产品品牌
        
//        DB::table('product_brands')->insert([
//            [
//                'name' => '兰芝',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => '雪花秀',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//            [
//                'name' => '水印',
//                'created_at' => time(),
//                'updated_at' => time()
//            ],
//        ]);
        
//        ProductBrand::create(['name' => '兰芝']);
//        ProductBrand::create(['name' => '雪花秀']);
//        ProductBrand::create(['name' => '水印']);
        
        SeederHelper::doSeed(ProductBrand::class, ['兰芝', '雪花秀', '水印']);
    }
}
