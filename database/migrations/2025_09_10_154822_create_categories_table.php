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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('project_key');
            $table->string('category_key')->unique();
            $table->string('category_main');
            $table->string('category_sub');
            $table->text('category_sub_description')->nullable();
            $table->boolean('category_is_active')->default(true);
            $table->timestamp('category_status_updated_at')->nullable();
            $table->text('category_deactivation_note')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
