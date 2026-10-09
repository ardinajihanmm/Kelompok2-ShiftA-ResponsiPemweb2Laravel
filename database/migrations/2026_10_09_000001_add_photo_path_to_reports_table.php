<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('reports', 'photo_path')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->string('photo_path')->nullable()->after('description');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('reports', 'photo_path')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->dropColumn('photo_path');
            });
        }
    }
};
