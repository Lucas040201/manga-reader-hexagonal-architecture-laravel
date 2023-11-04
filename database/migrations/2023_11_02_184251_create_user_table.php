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
        Schema::create('tb_user', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name', 50);
            $table->string('surname', 70);
            $table->string('username', 16)->unique('user_username');
            $table->string('email', 150)->unique('user_email');
            $table->string('password');
            $table->string('phone_number', 11)->nullable();
            $table->boolean('email_confirmation')->default(false);
            $table->string('profile_picture')->nullable();
            $table->timestamps();
            $table->index([
                'uuid',
                'name',
                'surname',
                'username',
                'email'
            ], 'tb_user_search_user_by_uuid_name_surname_username_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_user');
    }
};
