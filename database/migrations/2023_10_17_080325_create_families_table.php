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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id');
            $table->foreignId('user_id');
            $table->string('title', 128);
            $table->string('father_name', 60)->nullable();
            $table->string('mother_name', 60)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('postcode', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('phone_h', 50)->nullable();
            $table->string('phone_o', 50)->nullable();
            $table->string('mobile_m', 50)->nullable();
            $table->string('mobile_f', 50)->nullable();
            $table->string('email_m', 50)->nullable();
            $table->string('email_f', 50)->nullable();
            $table->string('lr_kin_name', 50)->nullable();
            $table->string('lr_relationship', 50)->nullable();
            $table->string('lr_address', 255)->nullable();
            $table->string('lr_phone_h', 50)->nullable();
            $table->string('lr_phone_w', 50)->nullable();
            $table->string('lr_email', 50)->nullable();
            $table->string('fp_kin_name', 50)->nullable();
            $table->string('fp_relationship', 50)->nullable();
            $table->string('fp_address', 255)->nullable();
            $table->string('fp_phone_h', 50)->nullable();
            $table->string('fp_phone_w', 50)->nullable();
            $table->string('fp_email', 50)->nullable();
            $table->string('sp_kin_name', 50)->nullable();
            $table->string('sp_relationship', 50)->nullable();
            $table->string('sp_address', 255)->nullable();
            $table->string('sp_phone_h', 50)->nullable();
            $table->string('sp_phone_w', 50)->nullable();
            $table->string('sp_email', 50)->nullable();
            $table->timestamps();
            $table->string('deleted_at', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families', 50);
    }
};
