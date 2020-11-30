<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->foreignId('catid')->references('id')->on('catalogues');
            $table->foreignId('secid')->references('id')->on('sections');
            $table->char('code',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->char('name',60)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->float('height', 8, 5)->nullable($value = true);
            $table->float('mxheight', 8, 5)->nullable($value = true);
            $table->float('minheight', 8, 5)->nullable($value = true);
            $table->float('width', 8, 5)->nullable($value = true);
            $table->float('mxwidth', 8, 5)->nullable($value = true);
            $table->float('minwidth', 8, 5)->nullable($value = true);
            $table->float('depth', 8, 5)->nullable($value = true);
            $table->float('mxdepth', 8, 5)->nullable($value = true);
            $table->float('mindepth', 8, 5)->nullable($value = true);
            $table->char('hinge',10)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->float('weight', 8, 5)->nullable($value = true);
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
        Schema::dropIfExists('products');
    }
}
