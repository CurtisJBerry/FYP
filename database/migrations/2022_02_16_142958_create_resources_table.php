<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('resource_name',20);
            $table->string('resource_path', 2048)->nullable();
            $table->text('description');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('module_id')->nullable()->constrained('modules');
            $table->foreignId('question_id')->nullable()->constrained('questions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
