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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("user_id")
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignId("social_network_id")
                ->nullable()
                ->constrained("social_networks")
                ->nullOnDelete();

            $table->text("original_url");
            $table->text("s3_url")->nullable();
            $table->enum("status", ["pending", "success", "failed"])->default("pending");
            $table->string("format");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
