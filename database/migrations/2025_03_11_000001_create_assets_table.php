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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('asset_code')->unique();
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('status')->default('available'); // available, in-use, maintenance, retired
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('warranty_expiry_date')->nullable();
            $table->string('location')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('assigned_to')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};