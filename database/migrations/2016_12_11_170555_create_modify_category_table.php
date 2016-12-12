<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModifyCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function ($table) {
            $table->integer('sort')->change();
            $table->dropForeign('categories_parent_id_foreign');
            $table->integer('parent_id')->unsigned()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function ($table) {
            $table->boolean('sort')->default(false)->change();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('parent_id')->unsigned()->change();
        });
    }
}
