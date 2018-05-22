<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUnitsApplyingWizardMode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('ALTER TABLE units MODIFY name varchar(255) default NULL');
        \DB::statement('ALTER TABLE units MODIFY template_id bigint(20) unsigned default NULL');
        
        Schema::table('units', function (Blueprint $table) {
            $table->integer('user_id');
            $table->timestamp('published_at')->nullable()->default(NULL);
            $table->timestamp('approved_at')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // \DB::statement('ALTER TABLE units MODIFY name varchar(255) NOT NULL');
        // \DB::statement('ALTER TABLE units MODIFY template_id bigint(20) unsigned  NOT NULL');

        Schema::table('units', function (Blueprint $table) { 
            $table->dropColumn('user_id');
            $table->dropColumn('published_at');
            $table->dropColumn('approved_at');
        });
    }
}
