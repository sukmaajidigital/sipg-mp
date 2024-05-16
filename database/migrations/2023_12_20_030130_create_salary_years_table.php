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
        Schema::create('salary_years', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->index();
            $table->unsignedBigInteger('id_salary_grade')->index();
            $table->year('year')->nullable();
            $table->integer('ability')->nullable();
            $table->integer('fungtional_alw')->nullable();
            $table->integer('family_alw')->nullable();
            $table->integer('transport_alw')->nullable();
            $table->integer('adjustment')->nullable();
            $table->integer('bpjs')->nullable();
            $table->integer('jamsostek')->nullable();
            $table->integer('total_ben')->nullable();
            $table->integer('total_ben_ded')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_salary_grade')->references('id')->on('salary_grades')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_years');
    }
};
