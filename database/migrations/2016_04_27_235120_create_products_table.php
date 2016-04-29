<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('description', '500');
            $table->double('price', 5, 2);
            $table->string('image', 25);
            $table->timestamps();
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

//App\Product::create(['name' => 'Bed Springs', 'description' => 'The bounciest bed springs in the world, guaranteed. Set of 4.', 'price' => 57.75, 'image' => '4.jpg']);