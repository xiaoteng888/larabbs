<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->string('name')->nullable()->comment('站点名称');
            $table->string('email')->default('605184327@qq.com')->comment('邮箱');
            $table->string('seo_description')->nullable()->comment('seo描述');
            $table->string('seo_key')->nullable()->comment('seo关键词');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
