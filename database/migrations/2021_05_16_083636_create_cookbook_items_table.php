<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookbookItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cookbook_items', function (Blueprint $table) {
            $table->id();
            $table->integer('cookbooknavbar_id');
            $table->integer('cookbookcategory_id');
            $table->integer('cookbooksubcategory_id');
            $table->string('itemname');
            $table->string('slug');
            $table->string('itemimage');
            $table->string('recipeby');
            $table->string('recipebyimage');
            $table->string('serving');
            $table->string('timetoprepare');
            $table->string('timetocook');
            $table->longText('description');
            $table->string('course');
            $table->string('cuisine');
            $table->string('timeofday');
            $table->integer('levelofcooking_id');
            $table->string('recipetype_id');
            $table->longText('steps');
            $table->integer('status');
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
        Schema::dropIfExists('cookbook_items');
    }
}
