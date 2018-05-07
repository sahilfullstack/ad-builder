<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateExpiringAtToDefaultNullableInSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('ALTER TABLE subscriptions MODIFY expiring_at timestamp NULL default NULL;');
        
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropUnique('unique_layout');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
