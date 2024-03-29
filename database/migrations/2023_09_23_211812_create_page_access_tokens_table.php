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
        Schema::create('page_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("account_id");
            $table->string("page_name");
            $table->bigInteger("page_id");
            $table->string("page_access_token");
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_access_tokens');
    }
};
