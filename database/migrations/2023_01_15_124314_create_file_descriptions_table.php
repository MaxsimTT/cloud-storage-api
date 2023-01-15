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
        if (! Schema::hasTable('file_descriptions')) {
            Schema::create('file_descriptions', function (Blueprint $table) {
                $table->bigInteger('file_id')->unsigned();
                $table->foreign('file_id')->references('id')->on('files');

                $table->string('file_name', 255);
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
        if (Schema::hasTable('file_descriptions')) {
            Schema::dropIfExists('file_descriptions');
        }
    }
};
