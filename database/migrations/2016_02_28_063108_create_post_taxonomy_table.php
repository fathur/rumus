<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_taxonomy', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('taxonomy_id');
            $table->timestamps();

            $table->unique(['post_id','taxonomy_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_taxonomy');
    }
}
