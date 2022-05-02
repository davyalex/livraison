<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->string('durée')->nullable();
            $table->float('tva')->nullable();
            $table->double('montant_ttc')->nullable();
            $table->date('date_debut')->nullable();
            $table->string('date_fin')->nullable();

            $table->unsignedBigInteger('livreur_id')->nullable();
            $table->unsignedBigInteger('pack_id')->nullable();

            $table->foreign('livreur_id')->unique()
            ->nullable()
            ->references('id')
            ->on('livreurs')
            ->onDelete('set null')
            ->onUpdate('cascade');
          

             $table->foreign('pack_id')
            ->references('id')
            ->on('packs')
            ->onDelete('set null')
            ->onUpdate('cascade')
             ->nullable();  
            $table->softDeletes();
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
        Schema::dropIfExists('abonnements');
    }
}
