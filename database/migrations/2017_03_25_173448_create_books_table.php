<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('book_name')->default(null)->nullable();
            $table->string('book_url')->default(null)->nullable();
            $table->string('book_author')->default(null)->nullable();
            $table->string('book_date')->default(null)->nullable();
            $table->string('book_desc')->default(null)->nullable();
            $table->string('category')->default(null)->nullable();
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
        Schema::dropIfExists('books');
    }
}
