<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id')->comment('产品编号');
                        $table->string('model_id')->nullable()->comment('产品号');
                        $table->string('name')->comment('产品名称');
                        $table->float('origin_price')->comment('产品原产地价格');
                        $table->float('demestic_price')->comment('产品国内售价');
                        $table->integer('count')->unsigned()->default(0)->comment('产品库存数量');
                        $table->string('thumbnail')->nullable()->comment('产品缩略图地址');
                        $table->string('detail_image')->nullable()->comment('产品展示图片（如果有多个用都好分隔）');
                        $table->integer('category_id')->unsigned()->comment('产品类型编号，关联类型表');
                        $table->integer('brand_id')->unsigned()->comment('产品品牌编号，关联品牌表');
			$table->timestamps();
                        $table->softDeletes();
                        // 添加外键
                        $table->foreign('category_id')->references('id')->on('product_categories');
                        $table->foreign('brand_id')->references('id')->on('product_brands');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
