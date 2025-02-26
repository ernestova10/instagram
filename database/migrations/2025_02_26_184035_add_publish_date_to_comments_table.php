<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->timestamp('publish_date')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
        });
    }
    
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->timestamp('publish_date')->nullable()->change();
        });
    }
    
};
