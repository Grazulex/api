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
        Schema::create('workspaces', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('description')->nullable();

            $table->string('identifier')->unique();
            $table->string('resource_key')->unique();

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignUlid('workspace_id')->index()->constrained('workspaces')->cascadeOnDelete();
            $table->dropUnique('users_email_unique');
            $table->unique(['workspace_id', 'email']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspaces');
    }
};
