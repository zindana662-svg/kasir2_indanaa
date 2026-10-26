<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jenjangs', function (Blueprint $table) {
            $table->string('status', 20)->default('Aktif')->change();
        });

        DB::table('jenjangs')
            ->where('status', '1')
            ->update(['status' => 'Aktif']);

        DB::table('jenjangs')
            ->where('status', '0')
            ->update(['status' => 'Nonaktif']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('jenjangs')
            ->where('status', 'Aktif')
            ->update(['status' => '1']);

        DB::table('jenjangs')
            ->where('status', 'Nonaktif')
            ->update(['status' => '0']);

        Schema::table('jenjangs', function (Blueprint $table) {
            $table->boolean('status')->default(true)->change();
        });
    }
};