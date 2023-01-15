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
        if (! Schema::hasTable('file_folder_descriptions')) {
            Schema::create('file_folder_descriptions', function (Blueprint $table) {
                $table->bigInteger('folder_id')->unsigned();
                $table->foreign('folder_id')->references('id')->on('file_folders');

                $table->string('folder_name', 255);
                $table->timestamps();
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
        if (Schema::hasTable('file_folder_descriptions')) {
            Schema::dropIfExists('file_folder_descriptions');
        }
    }
};
