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
        Schema::create('doc_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_id');
            $table->string("field_name", 155);
            $table->string("field_description", 155);
            $table->timestamps();
        });

        //FK
        Schema::table('doc_fields', function (Blueprint $table) {
            $table->foreign('doc_id')->references('id')->on('docs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_fields');
    }
};
