<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('file_path');
            $table->string('jabatan_penandatangan')->nullable()->after('deskripsi');
            $table->string('nama_penandatangan')->nullable()->after('jabatan_penandatangan');
        });
    }

    public function down()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'jabatan_penandatangan', 'nama_penandatangan']);
        });
    }
};
