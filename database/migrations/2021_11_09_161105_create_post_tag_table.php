<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {

            //definisco le chiave esterna per il collegamento della tabella ponte
            $table->unsignedBigInteger('post_id');
            // se cancello un post, la funzione ondelete(cascade) cancella automaticamente anche le informazioni relative a quel tag di quello specifico post in modo tale che non si generino degli errori in caso di mancanza di un collegamento di informazioni post - tag
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            //definisco le chiave esterna per il collegamento della tabella ponte
            $table->unsignedBigInteger('tag_id');
            // applico lo stesso concetto ondelete(cascade) anche nei tags in modo da cancellare un collegamento che non porta a nulla 
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // mi definisco la chiave primaria
            $table->primary(['post_id', 'tag_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
