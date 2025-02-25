<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            if (!Schema::hasColumn('agendas', 'deleted_at')) {
                $table->softDeletes(); // Menambahkan kolom deleted_at jika belum ada
            }
        });
    }

    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            if (Schema::hasColumn('agendas', 'deleted_at')) {
                $table->dropColumn('deleted_at'); // Menghapus kolom jika rollback
            }
        });
    }
};
