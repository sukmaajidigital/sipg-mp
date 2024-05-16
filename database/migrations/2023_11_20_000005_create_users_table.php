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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique()->nullable();
            $table->string('name');
            $table->unsignedBigInteger('id_status')->nullable();
            $table->unsignedBigInteger('id_grade')->nullable();
            $table->unsignedBigInteger('id_dept')->nullable();
            $table->unsignedBigInteger('id_job')->nullable();
            $table->string('sex')->nullable();
            $table->date('ttl')->nullable();
            $table->date('start')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('agama')->nullable();
            $table->string('domisili')->nullable();
            $table->string('email')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_telpon')->nullable();
            $table->string('kis')->nullable();
            $table->string('kpj')->nullable();
            $table->string('suku')->nullable();
            $table->string('no_sepatu_safety')->nullable();
            $table->dateTime('start_work_user')->nullable();
            $table->dateTime('end_work_user')->nullable();
            $table->string('loc_kerja')->nullable();
            $table->string('loc')->nullable();
            $table->string('sistem_absensi')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->bigInteger('aktual_cuti')->nullable();
            $table->string('status_pernikahan')->nullable();
            $table->string('istri_suami')->nullable();
            $table->string('anak_1')->nullable();
            $table->string('anak_2')->nullable();
            $table->string('anak_3')->nullable();
            $table->string('access_by')->nullable();
            $table->string('image_url')->nullable();
            $table->enum('role_app', ['Admin', 'User', 'Inputer', ''])->nullable();
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('id_status')->references('id')->on('statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_grade', 'fk_users_grades')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_dept', 'fk_users_depts')->references('id')->on('depts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_job', 'fk_users_jobs')->references('id')->on('jobs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
