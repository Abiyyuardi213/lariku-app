<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('road'); // road, trail
            $table->string('distance_category'); // 5k, 10k, 21k, 42k, ultra
            $table->string('location');
            $table->dateTime('event_date');
            $table->decimal('registration_price', 12, 2)->nullable();
            $table->date('early_bird_deadline')->nullable();
            $table->string('status')->default('wishlist'); // wishlist, registered, done
            $table->text('description')->nullable();
            $table->string('website_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
