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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('content');  // حقل لنص المراجعة
            $table->morphs('reviewable');  // هذا سيضيف `reviewable_id` و `reviewable_type`
            $table->unsignedBigInteger('customer_id')->nullable();  // معرف العميل الذي كتب المراجعة
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();  // إضافة الحذف الناعم
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
