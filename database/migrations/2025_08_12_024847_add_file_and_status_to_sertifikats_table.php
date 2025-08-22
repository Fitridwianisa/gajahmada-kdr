<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('nomor_sertifikat');
            $table->enum('status', ['pending', 'selesai'])->default('pending')->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'status']);
        });
    }

};
