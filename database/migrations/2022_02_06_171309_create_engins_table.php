<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engins', function (Blueprint $table) {
            $table->id();
            $table->string('type_engin')->nullable();
            $table->string('immatriculation')->unique()->nullable();

                //clé entrangere du livreur
            $table->foreignId('livreur_id')->unique()
                    ->nullable()
                    ->references('id')
                    ->on('livreurs')
                    ->onDelete('set null')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('engins');
    }
}
