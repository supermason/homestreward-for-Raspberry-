<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
                
                $this->call('AuthGroupTableSeeder');
                $this->command->info('AuthGroup table seeded!');
                $this->call('CustomerCategoryTableSeeder');
                $this->command->info('CustomerCategory table seeded!');
                $this->call('ProductBrandTableSeeder');
                $this->command->info('ProductBrand table seeded!');
                $this->call('ProductCategoryTableSeeder');
                $this->command->info('ProductCategory table seeded!');
                $this->call('UserTableSeeder');
                $this->command->info('User table seeded!');
                $this->call('ProductsTableSeeder');
                $this->command->info('Products table seeded!');
                $this->call('CustomerTableSeeder');
                $this->command->info('Customer table seeded!');
                $this->call('SuppliersTableSeeder');
                $this->command->info('Suppliers table seeded!');
                $this->call('ConsumptionCategoriesTableSeeder');
                $this->command->info('ConsumptionCategories table seeded!');
	}

}
