<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisaCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visa_categories', function (Blueprint $table) {
                $table->id();

                $table->string('title');


                $table->text('short_description')->nullable();
                $table->longText('description')->nullable();
                $table->string('image')->nullable();
                $table->string('category_logo')->nullable();

                // 0 = default, 1 = draft, 2 = publish
                $table->tinyInteger('publish_is')
                    ->default(0)
                    ->comment('0 = default, 1 = draft, 2 = publish');
                    
                    $table->dateTime('date_modified')->nullable();
                // SEO Fields
                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down()
    {
        Schema::dropIfExists('visa_categories');
    }
}
