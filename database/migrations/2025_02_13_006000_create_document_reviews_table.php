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
        Schema::create('document_reviews', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
          //  $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('cascade');

            
            $table->timestamp('assigned_at')->nullable(); // or ->useCurrent()
            
            
            $table->enum('status', ['pending','rejected', 'approved', 'assigned', 'in_review', 'discussion', 'verdict_passed'])->nullable();

                        
            $table->text('comments')->nullable();
            $table->text('rejection_message')->nullable();
            
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            
            // Responses
            $table->text('sdcs_response')->nullable();
            $table->text('psmt_response')->nullable();
            $table->text('usmd_response')->nullable();
            $table->text('mpin_response')->nullable();
            $table->text('rrpr_response')->nullable();
            $table->text('icps_response')->nullable();
            $table->text('cprp_response')->nullable();
            $table->text('ccid_response')->nullable();
            $table->text('aoic_response')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_reviews'); // Consistent table name
    }
};
