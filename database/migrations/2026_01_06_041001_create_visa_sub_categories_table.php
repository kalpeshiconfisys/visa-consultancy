<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_sub_categories', function (Blueprint $table) {
            $table->id();

            // Relation with visa_categories
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('visa_categories')
                ->onDelete('cascade');

            $table->string('title');

            // Normal Description
            $table->longText('description')->nullable();

            // Bullets list (JSON)`
            // Example store: ["Point 1","Point 2","Point 3"]
            $table->json('bullets')->nullable();
                   $table->string('content_type');

            // 0 = default, 1 = draft, 2 = publish
            $table->tinyInteger('publish_is')
                ->default(0)
                ->comment('0 = default, 1 = draft, 2 = publish');
            $table->dateTime('date_modified')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visa_sub_categories');
    }
};
