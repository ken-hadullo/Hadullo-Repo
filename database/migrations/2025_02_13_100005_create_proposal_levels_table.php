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
        Schema::create('proposal_levels', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key   
            $table->string('name')->nullable(); // Longer text for review feedback		
			$table->string('cost')->nullable(); // Cost for review feedback
			$table->string('renewal_cost')->nullable(); // Cost for review feedback
			$table->string('amendment_cost')->nullable(); // Cost for review feedback
			$table->string('mta_cost')->nullable(); // Cost for review feedback                     
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
        Schema::dropIfExists('proposal_levels'); // Consistent table name
    }
};
