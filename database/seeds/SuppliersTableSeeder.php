<?php

/**
 * Description of newPHPClass
 *
 * @author mac
 */

use App\Suppliers;

class SuppliersTableSeeder extends Illuminate\Database\Seeder {

    public function run() 
    {
        Illuminate\Support\Facades\DB::table('suppliers')->delete();
        
        for ($i = 0; $i < 45; ++$i)
        {
            Suppliers::create([
                'name' => '测试供应商1' . $i, 
                'address' => '首尔' . $i .'路' . $i . '号', 
                'wx_num' => 'aasdd_dd', 
                'phone_num' => '18653292593', 
                'qq' => '22345642'
            ]);
        }
    }
}
