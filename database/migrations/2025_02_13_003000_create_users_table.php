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
        Schema::create('users', function (Blueprint $table) {
            // Primary Key
            $table->id(); // Auto-increment primary key
            
            // User Information
            $table->string('title', 50)->nullable(); // User title as VARCHAR (nullable)

            $table->string('name'); // Full name (required)
            $table->string('slug')->unique(); // Unique slug for profile URLs (unique)
            $table->string('staff_std_id')->nullable()->unique();
            $table->string('email', 255)->unique()->index(); // Unique email with indexing (required)
            $table->string('password', 255); // Password storage (required)
            $table->string('phone', 20)->nullable()->unique()->index(); // Phone number (optional, unique and indexed)
            $table->text('specialization')->nullable(); // Specialization(nullable)
            $table->boolean('profile_updated')->default(false);
            $table->string('avatar', 2048)->nullable(); // User profile picture URL (nullable)
            $table->foreignId('school_id')->nullable()->constrained('schools')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null')->onUpdate('cascade');
           
            $table->foreignId('role_id')->nullable()
                ->constrained('roles')
                ->onDelete('set null') // Set to null if the related role is deleted
                ->onUpdate('cascade'); // Cascade update if the referenced role's ID is updated
            
            // Profile Information
        
            $table->text('research_interests')->nullable(); // Research interests (nullable)         
            $table->text('education')->nullable(); // Education details (nullable)         

            $table->text('research_title')->nullable(); // RT (nullable)
            $table->text('principal_investigator_name')->nullable(); // PI name (nullable)
            $table->text('institution_name')->nullable(); // Name of institution (nullable)
            $table->text('source_of_funding')->nullable(); // Funding (nullable)
            $table->text('county_of_study')->nullable(); // County (nullable)
            $table->string('amount_of_funds_needed')->nullable(); // Amount needed (nullable)
            $table->text('field_of_study')->nullable(); // Field of study (nullable)
           
            // Verification Fields
            $table->string('verification_code', 64)->nullable();
            //$table->string('verification_code', 6)->nullable(); // 6-digit OTP for email verification (nullable)
            $table->boolean('verified')->default(false); // Boolean for email verification status (default: false)
            $table->timestamp('email_verified_at')->nullable(); // Timestamp for email verification (nullable)

            // Remember Token for "Remember Me" functionality
            $table->rememberToken();

            // Timestamps for creation and updates
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
