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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete(); // ✅ relasi ke project
            $table->string('name');
            $table->string('location')->nullable();
            // Tambahan field
            $table->text('description')->nullable();
            $table->string('institution')->nullable(); // nama institusi/rumah sakit induk
            $table->enum('site_type', ['Hospital', 'Clinic', 'Private Practice', 'Diagnostic Center', 'Medical School', 'Other'])->default('hospital');
            $table->string('coordinates')->nullable(); // koordinat lat,lon

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('status_updated_at')->nullable();
            $table->text('deactivation_note')->nullable();

            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('last_modified_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
