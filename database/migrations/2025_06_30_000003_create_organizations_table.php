<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('organizations', static function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->jsonb('phones');
            $table->unsignedBigInteger('building_id');
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('business_organization', static function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');

            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_organization');
        Schema::dropIfExists('organizations');
    }
};
