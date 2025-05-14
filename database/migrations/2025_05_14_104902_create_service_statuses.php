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

        \DB::table('service_statuses')->insert([
            ['id' => 1, 'name' => 'Beklemede', 'description' => 'Servis bekliyor.', 'color' => 'amber', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Devam Ediyor', 'description' => 'Servis devam ediyor.', 'color' => 'blue', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Tamamlandı', 'description' => 'Servis tamamlandı.', 'color' => 'green', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Parça Bekleniyor', 'description' => 'Parça bekleniyor.', 'color' => 'orange', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Dış Servis', 'description' => 'Servis dış serviste.', 'color' => 'gray', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Onay Bekleniyor', 'description' => 'Onay bekleniyor.', 'color' => 'purple', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'İptal Edildi', 'description' => 'Servis iptal edildi.', 'color' => 'red', 'created_at' => now(), 'updated_at' => now()]

        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
