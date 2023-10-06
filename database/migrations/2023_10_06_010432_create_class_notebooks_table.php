<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassNotebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_notebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('topic_id')->nullable();
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('subject_id');
            $table->date('date')->default(now());
            $table->string('title');
            $table->text('description');
            $table->timestamp('creationDate')->default(now());
            $table->enum('entryType', ['course', 'assignment', 'quizz']);
            $table->timestamps();

            // Define foreign keys if necessary
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('set null');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            
            // Add other indexes or constraints as needed
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_notebooks');
    }
}
