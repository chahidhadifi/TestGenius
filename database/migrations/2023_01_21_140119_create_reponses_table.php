<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            // $table->foreignId('etudiant_id')->constrained('etudiants');
            // $table->foreignId('question_id')->constrained('questions');
            // $table->foreignId('proposition_id')->constrained('propositions');
            $table->unsignedBigInteger('etudiant_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('proposition_id');
            $table->foreign('etudiant_id')
                  ->references('id')
                  ->on('etudiants')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('proposition_id')
                  ->references('id')
                  ->on('propositions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
        Schema::dropIfExists('reponses');
    }
};