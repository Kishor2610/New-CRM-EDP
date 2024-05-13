<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id');
            $table->string('po_number')->nullable();
            $table->string('company_name');
            $table->text('item_code');
            $table->string('image');
            $table->text('qty');
            $table->text('process');
            $table->boolean('status')->default(false); 
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('design');
    }
}
