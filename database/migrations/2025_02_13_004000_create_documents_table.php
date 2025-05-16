<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('proposal_title')->index(); // Indexing for quick lookups 
            $table->text('abstract')->nullable();

            $table->foreignId('school_id')->nullable()->constrained('schools')->onDelete('set null')->onUpdate('cascade');


                  $table->foreignId('department_id')
                  ->nullable()
                  ->constrained('departments') // Correct table reference
                  ->onDelete('set null') // Ensures if department is deleted, theme is not lost
                  ->onUpdate('cascade');
                  $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('cascade');

            $table->string('slug')->unique()->index(); // Unique slug with indexing
                                     
            $table->text('comments')->nullable(); // comments
			$table->string('proposal_level_id')->nullable();          
            $table->string('research_role_id')->nullable();// reviewer, admin or applicant?
            $table->string('proposal_doc_path', 255)->nullable(); // File path storage
            $table->string('payment_receipt_path', 255)->nullable(); // File path storage
            $table->string('applicants_cv_path', 255)->nullable(); // File path storage
            $table->string('ethical_approval_path', 255)->nullable(); // File path storage
            $table->string('plagiarism_report_path', 255)->nullable(); // File path storage
           
                          
            $table->timestamps(); // Created_at and updated_at timestamps

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
