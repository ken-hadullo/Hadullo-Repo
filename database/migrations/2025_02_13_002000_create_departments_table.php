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
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            
            $table->string('name')->index(); // Indexing for quick lookups      
			$table->string('slug')->unique()->index(); // Unique slug with indexing			
            $table->text('description')->nullable(); // File path storage           
            $table->foreignId('school_id')->nullable()->constrained('schools')->cascadeOnDelete();            
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
        Schema::dropIfExists('departments');
    }
};
