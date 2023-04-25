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
        Schema::create('githubs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('github_id');
            $table->string('name');
            $table->string('full_name');
            $table->string('html_url');
            $table->string('language');
            $table->unsignedInteger('stargazers_count');
            $table->timestamp('pushed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('githubs');
    }
};
