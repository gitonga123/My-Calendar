<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('otherNames');
            $table->string('gender');
            $table->string('dateOfBirth');
            $table->string('county');
            $table->string('occupation');
            $table->binary('profilePhoto')->nullable();
            $table->boolean('membership_approved')->nullable();;
            $table->string('dateOfApproval')->nullable();;
            $table->string('idNumber');
            $table->string('membershipFee')->nullable();;
            $table->string('accountApprovedBy')->nullable();;
            $table->string('userUniqueKey')->unique();
            $table->string('prefered_investment_option')->nullable();
            $table->string('email')->unique()->nullable();;
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
}
