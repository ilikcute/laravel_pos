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
        // 1. Buat tabel roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // contoh: 'admin', 'user'
            $table->timestamps();
        });

        // 2. Tambahkan kolom role_id ke tabel users
        Schema::table('users', function (Blueprint $table) {
            // Opsional: Hapus kolom 'role' jika sudah ada
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }

            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Hapus relasi role_id dari users
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            // Opsional: Tambahkan kembali kolom role
            $table->integer('role')->nullable();
        });

        // 2. Drop tabel roles
        Schema::dropIfExists('roles');
    }
};
