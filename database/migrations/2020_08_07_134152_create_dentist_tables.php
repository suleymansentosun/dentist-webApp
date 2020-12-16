<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDentistTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('bookingReasons', function (Blueprint $table) {
            Schema::dropIfExists('bookingReasons');
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('doctors', function (Blueprint $table) {
            Schema::dropIfExists('doctors');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('user_id')->nullable();
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->mediumText('profile_picture')->nullable();
            $table->date('graduation_date');
            $table->date('starting_date_employement');
            $table->integer('salary');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('bookings', function (Blueprint $table) {
            Schema::dropIfExists('bookings');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('bookingReason_id');
            $table->unsignedBigInteger('doctor_id');
            $table->dateTime('booking_date');
            $table->boolean('is_finalized')->nullable();
            $table->boolean('is_notificated')->nullable();
            $table->boolean('is_materialized')->nullable();
            $table->boolean('hasMaterializedBookingBefore');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bookingReason_id')->references('id')->on('bookingReasons');
        });

        Schema::create('roles', function (Blueprint $table) {
            Schema::dropIfExists('roles');
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('description', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role_user', function (Blueprint $table) {
            Schema::dropIfExists('role_user');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id')->index('role_id')->nullable();
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('specialties', function (Blueprint $table) {
            Schema::dropIfExists('specialties');
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('doctor_specialty', function (Blueprint $table) {
            Schema::dropIfExists('doctor_specialty');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('specialty_id')->index('doctor_specialty_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->index('doctor_id')->nullable();
            $table->timestamps();

            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });

        Schema::create('patients', function (Blueprint $table) {
            Schema::dropIfExists('patients');
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('citizenship_number', 255);
            $table->string('phone_number', 255);
            $table->timestamps();
        });

        Schema::create('user_patient', function (Blueprint $table) {
            Schema::dropIfExists('user_patient');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('patient_id');
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('doctor_patient', function (Blueprint $table) {
            Schema::dropIfExists('doctor_patient');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('patient_id');
            $table->boolean('is_active')->nullable();
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        Schema::create('doctorReviews', function (Blueprint $table) {
            Schema::dropIfExists('doctorReviews');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('doctor_id')->index('doctor_id');
            $table->unsignedBigInteger('patient_id')->index('patient_id');
            $table->string('headline', 255)->nullable();
            $table->text('comment', 255)->nullable();
            $table->double('rating')->nullable();
            $table->boolean('approve')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('bookingReasons');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('booking_reasons');
        Schema::dropIfExists('specialties');
        Schema::dropIfExists('doctor_specialty');
        Schema::dropIfExists('doctor_specialty_doctors');
        Schema::dropIfExists('doctor_specialties');
        Schema::dropIfExists('doctor_specialties_doctors');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('doctor_roles');
        Schema::dropIfExists('doctor_roles_doctors');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('booking_user');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('doctors_patients');
        Schema::dropIfExists('doctorReviews');
        Schema::dropIfExists('doctor_reviews');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('doctor_patient');
        Schema::dropIfExists('user_patient');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}