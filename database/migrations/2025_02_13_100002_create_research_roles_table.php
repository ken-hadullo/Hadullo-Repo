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
        Schema::create('research_roles', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key   
            $table->string('title')->nullable(); // Longer text for review feedback
			$table->string('slug')->unique(); // Unique slug for referencing the review			

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // Assuming reviewers are in 'users' table
            
            $table->text('description')->nullable(); // Longer text for review feedback
           
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
        Schema::dropIfExists('research_roles'); // Consistent table name
    }
};
