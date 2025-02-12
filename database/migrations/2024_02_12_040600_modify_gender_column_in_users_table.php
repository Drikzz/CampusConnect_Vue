<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      // First drop the existing enum column
      $table->dropColumn('gender');

      // Then recreate it with the new values
      $table->enum('gender', ['male', 'female', 'non-binary', 'prefer-not-to-say'])->after('last_name');
    });
  }

  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('gender');
      $table->enum('gender', ['male', 'female', 'non-binary', 'prefer-not-to-say'])->after('last_name');
    });
  }
};
