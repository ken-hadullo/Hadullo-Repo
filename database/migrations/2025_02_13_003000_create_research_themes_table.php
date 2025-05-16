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
        Schema::create('research_themes', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key   
            $table->string('name')->nullable(); // Name of the research theme
            $table->string('slug')->unique(); // Unique slug for referencing
            $table->string('description')->nullable(); // Description of the theme

            // Correcting foreign key reference
            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments') // Correct table reference
                ->onDelete('set null') // Ensures if department is deleted, theme is not lost
                ->onUpdate('cascade');

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
        Schema::dropIfExists('research_themes'); // Consistent table name
    }
};
