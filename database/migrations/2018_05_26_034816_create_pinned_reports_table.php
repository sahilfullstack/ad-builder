<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinnedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinned_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report');
            $table->integer('user_id');
            $table->json('filter');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_at_millis')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinned_reports');
    }
}
