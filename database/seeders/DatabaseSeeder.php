<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Kendaraan;
use App\Models\Driver;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- DATA USER ---
        // Admin
        User::create([
            'name' => 'Admin Logistik',
            'email' => 'admin@kosiwa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Approver 1
        User::create([
            'name' => 'Manager Operasional 1',
            'email' => 'ardhan@kosiwa.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);

        // Approver 2
        User::create([
            'name' => 'Kepala Cabang 1',
            'email' => 'amir@kosiwa.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);

        // Approver 3
        User::create([
            'name' => 'Manager Operasional 2',
            'email' => 'arip@kosiwa.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);

        // Approver 4
        User::create([
            'name' => 'Kepala Cabang 2',
            'email' => 'pete@kosiwa.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);

        // Approver 5
        User::create([
            'name' => 'Manager Operasional 3',
            'email' => 'sutris@kosiwa.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);

        // Approver 6
        User::create([
            'name' => 'Kepala Cabang 3',
            'email' => 'ali@kosiwa.com',
            'password' => Hash::make('password'),
            'role' => 'approver',
        ]);


        // --- DATA KENDARAAN ---
        Kendaraan::create([
            'name' => 'Toyota Avanza',
            'type' => 'angkutan_orang',
            'plate' => 'N 1234 AB',
            'status' => 'available'
        ]);

        Kendaraan::create([
            'name' => 'Toyota HiAce',
            'type' => 'angkutan_orang',
            'plate' => 'N 1234 AB',
            'status' => 'available'
        ]);
        
        Kendaraan::create([
            'name' => 'Mitsubishi Triton',
            'type' => 'angkutan_orang',
            'plate' => 'B 8899 QW',
            'status' => 'unavailable'
        ]);
        
        Kendaraan::create([
            'name' => 'Isuzu ELF Crew Bus',
            'type' => 'angkutan_orang',
            'plate' => 'DK 4455 LM',
            'status' => 'available'
        ]);
        
        Kendaraan::create([
            'name' => 'Mitsubishi Fuso',
            'type' => 'angkutan_barang',
            'plate' => 'N 5678 CD',
            'status' => 'available'
        ]);

        Kendaraan::create([
            'name' => 'Caterpillar 789 Haul Truck',
            'type' => 'angkutan_barang',
            'plate' => 'KT 9090 ZZ',
            'status' => 'available'
        ]);

        Kendaraan::create([
            'name' => 'Komatsu HD785',
            'type' => 'angkutan_barang',
            'plate' => 'KT 7788 YY',
            'status' => 'unavailable'
        ]);

        Kendaraan::create([
            'name' => 'Volvo FMX Dump Truck',
            'type' => 'angkutan_barang',
            'plate' => 'L 6621 TR',
            'status' => 'available'
        ]);


        // --- DATA DRIVER ---
        Driver::create([
            'name' => 'Slamet',
            'phone' => '08123456789'
        ]);

        Driver::create([
            'name' => 'Udin',
            'phone' => '08198765432'
        ]);

        Driver::create([
            'name' => 'Bintang',
            'phone' => '081232364385'
        ]);

        Driver::create([
            'name' => 'Dhika',
            'phone' => '08198084369'
        ]);

        Driver::create([
            'name' => 'Ipul',
            'phone' => '081231284675'
        ]);

        Driver::create([
            'name' => 'Sebas',
            'phone' => '08187654321'
        ]);

        Driver::create([
            'name' => 'Alphonse',
            'phone' => '08932743274'
        ]);

        Driver::create([
            'name' => 'Rizky',
            'phone' => '081234987654'
        ]);
    }
}
