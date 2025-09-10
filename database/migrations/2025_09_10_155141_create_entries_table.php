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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('project_key');
            $table->string('encounter_key');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('entry_key')->unique();

            // Surgical
            $table->date('surgical_date_id')->nullable();
            $table->string('surgical_site_key')->nullable();
            $table->time('surgery_start_time')->nullable();
            $table->time('surgery_end_time')->nullable();

            // Operators
            $table->foreignId('operator_1')->nullable()->constrained('doctors')->nullOnDelete();
            $table->foreignId('operator_2')->nullable()->constrained('doctors')->nullOnDelete();
            $table->foreignId('operator_3')->nullable()->constrained('doctors')->nullOnDelete();
            $table->foreignId('operator_4')->nullable()->constrained('doctors')->nullOnDelete();

            // Diagnosis
            $table->text('preoperative_diagnosis')->nullable();
            $table->text('intraoperative_diagnosis')->nullable();
            $table->text('surgical_procedure')->nullable();
            $table->integer('estimated_blood_loss')->nullable();
            $table->longText('surgical_notes')->nullable();

            // Waitlist
            $table->string('waitlist_status')->nullable();
            $table->text('waitlist_communication_log')->nullable();
            $table->date('waitlist_entry_date')->nullable();
            $table->string('waitlist_group')->nullable();
            $table->string('waitlist_type')->nullable();
            $table->integer('waitlist_duration')->nullable();
            $table->string('waitlist_planned_procedure')->nullable();
            $table->foreignId('waitlist_operator_key')->nullable()->constrained('doctors')->nullOnDelete();
            $table->string('waitlist_scheduling_status')->nullable();
            $table->date('waitlist_scheduled_date')->nullable();
            $table->string('waitlist_operating_room')->nullable();
            $table->string('waitlist_surgery_round')->nullable();
            $table->date('waitlist_completed_date')->nullable();
            $table->string('waitlist_completion_reason')->nullable();
            $table->text('waitlist_completion_notes')->nullable();
            $table->integer('waitlist_duration_completed')->nullable();
            $table->date('waitlist_suspended_date')->nullable();
            $table->string('waitlist_suspended_reason')->nullable();
            $table->text('waitlist_suspended_notes')->nullable();

            // General
            $table->longText('entry_description')->nullable();
            $table->string('entry_label')->nullable();
            $table->date('entry_date')->nullable();
            $table->time('entry_time')->nullable();
            $table->json('log_image_files')->nullable();
            $table->json('log_document_files')->nullable();

            // Supervisor & competence
            $table->foreignId('entry_supervisor')->nullable()->constrained('doctors')->nullOnDelete();
            $table->string('competence_level')->nullable();

            // Insurance
            $table->string('insurance_status')->nullable();
            $table->text('insurance_notes')->nullable();

            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('last_modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
