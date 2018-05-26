<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHolderValueToUnitTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `units` MODIFY COLUMN `type` ENUM('ad', 'page', 'holder') NOT NULL DEFAULT 'ad'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `units` MODIFY COLUMN `type` ENUM('ad', 'page') NOT NULL DEFAULT 'ad'");
    }
}
