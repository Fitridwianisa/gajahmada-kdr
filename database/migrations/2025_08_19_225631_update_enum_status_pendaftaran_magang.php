<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE pendaftaran_magang 
            MODIFY COLUMN status ENUM('menunggu', 'diterima', 'ditolak', 'selesai') 
            DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pendaftaran_magang 
            MODIFY COLUMN status ENUM('menunggu', 'diterima', 'ditolak') 
            DEFAULT 'menunggu'");
    }
};
