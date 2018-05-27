<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdAndContentsInLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->after('id')->nullable();
            $table->string('contents')->after('height');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('layouts', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('contents');
        });
    }
}
