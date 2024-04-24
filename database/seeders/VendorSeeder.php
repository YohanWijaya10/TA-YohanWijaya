<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'nama_vendor' => 'Jamu Sehat Nusantara',
                'no_telepon' => '081234567890',
                'alamat' => 'Jalan Jamu Sehat No. 123',
            ],
            [
                'nama_vendor' => 'Herbalindo Jamu Tradisional',
                'no_telepon' => '082345678901',
                'alamat' => 'Jalan Herbalindo No. 456',
            ],
            [
                'nama_vendor' => 'Jamu Sejahtera Indonesia',
                'no_telepon' => '083456789012',
                'alamat' => 'Jalan Jamu Sejahtera No. 789',
            ],
            [
                'nama_vendor' => 'Jamu Makmur Berkah',
                'no_telepon' => '084567890123',
                'alamat' => 'Jalan Jamu Makmur No. 1011',
            ],
            [
                'nama_vendor' => 'Jamu Bumi Nusantara',
                'no_telepon' => '085678901234',
                'alamat' => 'Jalan Jamu Bumi No. 1314',
            ],
            [
                'nama_vendor' => 'Jamu Warisan Leluhur',
                'no_telepon' => '086789012345',
                'alamat' => 'Jalan Jamu Warisan No. 1516',
            ],
            [
                'nama_vendor' => 'Jamu Tradisional Indonesia',
                'no_telepon' => '087890123456',
                'alamat' => 'Jalan Jamu Tradisional No. 1718',
            ],
            [
                'nama_vendor' => 'Jamu Cahaya Hati',
                'no_telepon' => '088901234567',
                'alamat' => 'Jalan Jamu Cahaya No. 1920',
            ],
            [
                'nama_vendor' => 'Jamu Sejahtera Hidup',
                'no_telepon' => '089012345678',
                'alamat' => 'Jalan Jamu Sejahtera No. 2122',
            ],
            [
                'nama_vendor' => 'Jamu Berkat Alam',
                'no_telepon' => '090123456789',
                'alamat' => 'Jalan Jamu Berkat No. 2324',
            ],
        ];

        // Looping untuk memasukkan data ke dalam database
        foreach ($vendors as $vendorData) {
            // Memasukkan data vendor ke dalam database
            Vendor::create($vendorData);
        }
        
    }
}
