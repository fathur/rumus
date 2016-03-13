<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id')
                ->nullable();;
            $table->unsignedInteger('cover_image_id')
                ->nullable();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->enum('type', ['post','page']);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('cover_image_id')
                ->references('id')
                ->on('media')
                ->onDelete('set null');

            $table->index(['title','slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
