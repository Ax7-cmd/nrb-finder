<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accs', function (Blueprint $table) {
            $table->id();
            $table->string('no_rma_oracle')->nullable();
            $table->string('no_cn')->nullable();
            $table->timestamp('tgl_cn')->nullable();
            $table->string('no_rr')->nullable();
            $table->decimal('amount', $precision = 18, $scale = 2)->default(0.00);
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
        Schema::dropIfExists('accs');
    }
}
