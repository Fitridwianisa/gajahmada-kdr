<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran_magang', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftaran_magang', 'bagian_penempatan')) {
                $table->dropColumn('bagian_penempatan');
            }
            if (Schema::hasColumn('pendaftaran_magang', 'bersedia_ditempatkan_lain')) {
                $table->dropColumn('bersedia_ditempatkan_lain');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran_magang', function (Blueprint $table) {
            $table->string('bagian_penempatan')->nullable();
            $table->boolean('bersedia_ditempatkan_lain')->default(0);
        });
    }
};
