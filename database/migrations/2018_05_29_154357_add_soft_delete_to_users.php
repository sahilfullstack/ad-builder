<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_at_millis')->default(0);
            $table->unique(['email', 'deleted_at_millis'], 'unique_email');
            $table->unique(['username', 'deleted_at_millis'], 'unique_username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
            $table->dropColumn('deleted_at_millis');
            $table->dropIndex('unique_email');
            $table->dropIndex('unique_username');
        });
    }
}
