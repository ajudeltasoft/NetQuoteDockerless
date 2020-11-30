<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Doorstyles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doorstyles', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->foreignId('catid')->references('id')->on('catalogues');
            $table->foreignId('secid')->references('id')->on('sections');
            $table->char('name',60)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('profiles',32)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('drawerstyles',32)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('alias',60)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->binary('horizgrain')->nullable($value = true);
            $table->binary('grainmatched')->nullable($value = true);
            $table->date('validfrom')->nullable($value = true);   
            $table->date('validto')->nullable($value = true);
            $table->char('uivisibility',1)->nullable($value = true);
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
        Schema::dropIfExists('doorstyles');
    }
}
