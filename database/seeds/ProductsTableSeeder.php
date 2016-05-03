<?php

/**
 * Description of newPHPClass
 *
 * @author mac
 */

use App\Product;

class ProductsTableSeeder  extends Illuminate\Database\Seeder {
    
    public function run() 
    {
        Illuminate\Support\Facades\DB::table('products')->delete();
        
        // 插入100条测试数据
        for ($i = 0; $i < 100; ++$i)
        {
            Product::create([
                'model_id' => 'EFG4' . (string)($i*100),
                'name' => '测试产品' . (string)$i,
                'origin_price' => 332.34 * $i,
                'demestic_price' => 123 * $i,
                'count' => $i,
                'thumbnail' => 'test.jpg',
                'detail_image' => '',
                'category_id' => ($i % 2 == 0 ? 1 : 2),
                'brand_id' => ($i % 2 == 0 ? 2 : 1)
            ]);
        }
    }
}
