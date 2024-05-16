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
        Schema::create('salary_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_salary_year')->index();
            $table->date('date')->nullable();
            $table->float('hour_call', 8, 2)->nullable();
            $table->integer('total_overtime')->nullable();
            $table->integer('thr')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('incentive')->nullable();
            $table->integer('union')->nullable();
            $table->integer('absent')->nullable();
            $table->integer('electricity')->nullable();
            $table->integer('cooperative')->nullable();
            $table->integer('gross_salary')->nullable();
            $table->integer('total_deduction')->nullable();
            $table->integer('net_salary')->nullable();
            $table->string('allocation')->nullable();
            $table->boolean('is_checked')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_salary_year')->references('id')->on('salary_years')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_months');
    }
};
