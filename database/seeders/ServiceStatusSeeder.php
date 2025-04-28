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
                'color' => 'amber',
            ],
            [
                'name' => 'Devam Ediyor',
                'description' => 'Servis devam ediyor.',
                'color' => 'blue',
            ],
            [
                'name' => 'Tamamlandı',
                'description' => 'Servis tamamlandı.',
                'color' => 'green',
            ],
            [
                'name' => 'Parça Bekleniyor',
                'description' => 'Parça bekleniyor.',
                'color' => 'orange',
            ],
            [
                'name' => 'Dış Servis',
                'description' => 'Servis dış serviste.',
                'color' => 'gray',
            ],
            [
                'name' => 'Onay Bekleniyor',
                'description' => 'Onay bekleniyor.',
                'color' => 'purple',
            ],
            [
                'name' => 'İptal Edildi',
                'description' => 'Servis iptal edildi.',
                'color' => 'red',
            ],
        ];

        foreach ($serviceStatuses as $status) {
            ServiceStatus::create($status);
        }
    }
}
