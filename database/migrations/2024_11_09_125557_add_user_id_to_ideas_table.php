<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('ideas', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Adds a foreign key constraint
    });
}

public function down()
{
    Schema::table('ideas', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
