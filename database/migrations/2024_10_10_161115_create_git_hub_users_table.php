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
        Schema::create('git_hub_users', function (Blueprint $table) {
            $table->id();
            $table->string('github_id')->unique();
            $table->string('username');
            $table->string('avatar');
            $table->text('bio')->nullable();
            $table->integer('public_repos_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_hub_users');
    }
};
