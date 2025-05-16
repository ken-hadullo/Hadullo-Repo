<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID for the notification
            $table->string('type'); // Type of notification

            // Polymorphic relationship fields (notifiable_id & notifiable_type)
            $table->morphs('notifiable');

            $table->text('data'); // Stores JSON or serialized data
            $table->text('message')->nullable();
            $table->enum('status', ['unread', 'read'])->default('unread');
            $table->timestamp('read_at')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};



