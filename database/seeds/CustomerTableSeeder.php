<?php

/**
 * Description of newPHPClass
 *
 * @author mac
 */


use App\Customer;

class CustomerTableSeeder extends Illuminate\Database\Seeder {

    public function run() 
    {
        Illuminate\Support\Facades\DB::table('customers')->delete();
        
        for ($i = 0; $i < 50; $i++)
        {
            Customer::create([
                'name' => '测试客户' . ($i+1), 
                'phoneNum' => (string)(15253212675 + $i), 
                'wx' => 'jm_god_father_' . $i, 
                'address' => '青岛市香港中路132号3号楼1505', 
                'customer_category_id' => ($i % 2 == 0 ? 1 : 2)
            ]);
        }
    }
}
