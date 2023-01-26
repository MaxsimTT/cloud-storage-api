<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('file_descriptions')) {
            Schema::table('file_descriptions', function (Blueprint $table) {
                $table->string('file_origin_name', 255);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('file_descriptions')) {
            Schema::table('file_descriptions', function (Blueprint $table) {
                $table->dropColumn('file_origin_name');
            });
        }
    }
};
