<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Modoverrides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modoverrides', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->foreignId('modid')->references('id')->on('modifications');
            $table->char('pcode',4)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('uiname',255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('uitype',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->string('uikey',255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->string('uivalue',255)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('uivisible',1)->nullable($value = true);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modoverrides');
    }
}
