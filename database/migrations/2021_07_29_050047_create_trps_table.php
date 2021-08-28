<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trps', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur')->nullable();
            $table->string('no_draf_retur')->nullable();
            $table->string('branch')->nullable();
            $table->string('dir')->nullable();
            $table->string('driver')->nullable();
            $table->timestamp('tgl_tarik')->nullable();
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
        Schema::dropIfExists('trps');
    }
}
