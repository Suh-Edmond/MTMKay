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
        Schema::create('blog_tag', function (Blueprint $table){
            $table->uuid('blog_id');
            $table->uuid('tag_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('blog_id')->references('id')->on('blogs');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_tag');
    }
};
