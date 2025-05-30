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
	public function up(): void
	{
	    Schema::create('users', function (Blueprint $table) {
	        $table->uuid('id')->primary();
	        $table->string('email')->unique();
	        $table->string('password')->nullable();
	        //$table->string('discord_id')->nullable()->unique();
	        $table->boolean('is_admin')->default(false);
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
};
