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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->string('rekam_medis');
            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->text('diagnosis')->nullable();
            $table->integer('age')->nullable(); // usia pasien
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->text('working_assessment')->nullable(); // penilaian kerja
            $table->text('context_summary')->nullable();   // ringkasan konteks/riwayat medis
            // Tambahan audit trail
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('last_modified_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->unique(['site_id', 'rekam_medis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
