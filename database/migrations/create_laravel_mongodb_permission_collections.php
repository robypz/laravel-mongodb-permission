<?php

namespace RobYpz\LaravelMongodbPermission\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use MongoDB\Laravel\Schema\Blueprint;

class CreateLaravelMongodbPermissionCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $collection) {
            $collection->id();
            $collection->string('name');
            $collection->timestamps();
        });

        Schema::create('permissions', function (Blueprint $collection) {
            $collection->id();
            $collection->string('name');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }
}
