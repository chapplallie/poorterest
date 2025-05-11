<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('medias', function (Blueprint $table) {
            // Supprime l'ancienne colonne si elle existe
            if (Schema::hasColumn('medias', 'category')) {
                $table->dropColumn('category');
            }

            // Ajoute la nouvelle colonne category_id si elle n'existe pas
            if (!Schema::hasColumn('medias', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('size');

                $table->foreign('category_id')
                    ->references('id')->on('categories')
                    ->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->string('category')->nullable(); 
        });
    }
};
