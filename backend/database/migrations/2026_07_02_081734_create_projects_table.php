<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->longText('description');
            $table->json('features')->nullable();
            $table->text('challenges')->nullable();
            $table->text('solutions')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->string('demo_video_url')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('is_purchasable')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
