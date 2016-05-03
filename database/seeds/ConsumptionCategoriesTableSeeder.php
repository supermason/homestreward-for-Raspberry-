<?php

/**
 * Created by PhpStorm.
 * User: mac
 * Date: 15/7/26
 * Time: 下午2:01
 */

use App\ConsumptionCategory;

class ConsumptionCategoriesTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('consumption_categories')->delete();

        SeederHelper::doSeed(ConsumptionCategory::class, ['吃饭', '买水果', '买饮料', '充值公交卡', '加油', '买衣服', '打车', '停车']);
    }
}