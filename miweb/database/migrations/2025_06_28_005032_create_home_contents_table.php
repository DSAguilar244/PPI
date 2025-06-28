<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeContentsTable extends Migration
{
    public function up()
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section')->unique();
            $table->text('content')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_contents');
    }
}