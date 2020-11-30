<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Shipto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipto', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->char('idcust',12)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('namelocn',60)->nullable($value = true);
            $table->char('textstre1',60)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('namecity',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->integer('ref_stateid')->nullable($value = true);
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
        Schema::dropIfExists('shipto');
    }
}
