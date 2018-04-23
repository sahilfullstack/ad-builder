<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApprovedAndRejectedAtToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('approved_at')->nullable()->default(NULL)->after('password');
            $table->timestamp('rejected_at')->nullable()->default(NULL)->after('approved_at');
            $table->boolean('active')->default(0)->after('rejected_at');
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
            $table->dropColumn('rejected_at'); 
            $table->dropColumn('approved_at'); 
            $table->dropColumn('active'); 
        });
    }
}
