<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['ad', 'page']);
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_at_millis')->default(0);
            $table->unique(['slug', 'type', 'deleted_at_millis'], 'unique_template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
}
