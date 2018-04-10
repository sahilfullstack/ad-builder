<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('template_id');
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_at_millis')->default(0);
            $table->unique(['template_id', 'slug', 'deleted_at_millis'], 'unique_component');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
