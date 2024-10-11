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
        Schema::create('git_hub_repos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('github_user_id')->nullable()->references('id')->on('git_hub_users');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('stars');
            $table->integer('forks');
            $table->string('language')->nullable();
            $table->string('html_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_hub_repos');
    }
};
