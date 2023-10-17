<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->string('photo', 100)->nullable();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('dob');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('phone_h', 20)->nullable();
            $table->string('phone_m', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('qualification')->nullable();
            $table->string('ssn', 30)->nullable();
            $table->string('contribuinte_no', 30)->nullable();
            $table->string('passport_no', 30)->nullable();
            $table->string('nationality', 50)->nullable();
            $table->date('date_start')->nullable();
            $table->string('emergency_name', 50);
            $table->string('emergency_phone', 20);
            $table->string('job_title', 100);
            $table->integer('basic_salary')->default(0);
            $table->integer('tax')->default(0);
            $table->string('socail_security', 20);
            $table->integer('loan')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('advance')->default(0);
            $table->integer('gross_salary')->default(0);
            $table->integer('net_salary')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
