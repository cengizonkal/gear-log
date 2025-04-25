<?php

namespace Database\Seeders;

use App\Models\ServiceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceStatuses = [
            [
                'name' => 'Beklemede',
                'description' => 'Servis bekliyor.',
            ],
            [
                'name' => 'Devam Ediyor',
                'description' => 'Servis devam ediyor.',
            ],
            [
                'name' => 'Tamamlandı',
                'description' => 'Servis tamamlandı.',
            ],
            [
                'name' => 'Parça Bekleniyor',
                'description' => 'Parça bekleniyor.',
            ],
            [
                'name' => 'Dış Servis',
                'description' => 'Servis dış serviste.',
            ],
            [
                'name' => 'Onay Bekleniyor',
                'description' => 'Onay bekleniyor.',
            ],
            [
                'name' => 'İptal Edildi',
                'description' => 'Servis iptal edildi.',
            ],
        ];

        foreach ($serviceStatuses as $status) {
            ServiceStatus::create($status);
        }
    }
}
