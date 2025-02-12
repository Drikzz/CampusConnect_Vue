<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default categories with slugs
        DB::table('categories')->insert([
            ['name' => 'Electronics', 'slug' => Str::slug('Electronics'), 'description' => null],
            ['name' => 'Books', 'slug' => Str::slug('Books'), 'description' => null],
            ['name' => 'Clothing', 'slug' => Str::slug('Clothing'), 'description' => null],
            ['name' => 'Others', 'slug' => Str::slug('Others'), 'description' => null],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
