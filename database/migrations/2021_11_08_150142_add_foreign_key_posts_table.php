<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // creo la mia colonna che chiamo category_id, definisco le sue caratteristiche e la posizione in tabella
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // definisco la chiave foreign 'category_id' e avrà come referenza l'id nella tabella categories
            // utilizzando onDelete('cascade'); quando cancello la categoria di riferimento tutti i posts collegati vengono cancellati
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // il 'posts_category_id_foreign' to trovo in mySql nella tabella posts; posso visualizzare le chiavi attive e a quale colonna si riferiscono
            $table->dropForeign('posts_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
