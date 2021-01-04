<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DentistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Authanticated User',
            'description' => 'Kullanıcı üye olduğunda otomatik olarak edindiği roldür',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'name' => 'Patient',
            'description' => 'Hastaların sahip olduğu özel yetkilere sahiptir',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'name' => 'Employee',
            'description' => 'Resepsiyonda veya doktor yanında çalışan personellerdir',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'name' => 'Doctor',
            'description' => 'Klinikte çalışan dişçi doktorlardır',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => "Bunlar admin'dirler, ve kurucu ortaklardır",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('specialties')->insert([
            'name' => 'İmplantoloji',
            'nameEn' => 'Implant',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Estetik Diş Hekimliği',
            'nameEn' => 'Dental Cosmetics',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Kanal Tedavisi',
            'nameEn' => 'Root Canal Therapy',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Prototetik Diş Tedavisi',
            'nameEn' => 'Prosthetic Dentistry',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Periodontoloji',
            'nameEn' => 'Periodontology',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Ortodonti',
            'nameEn' => 'Orthodontics',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('specialties')->insert([
            'name' => 'Sedasyon ve Genel Anestezi',
            'nameEn' => 'Sedation and General Anesthesia',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => "admin@gmail.com",
            'password' => \Hash::make('admin'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 4,
            'user_id' => 1,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 5,
            'user_id' => 1,
        ]);

        DB::table('bookingReasons')->insert([
            'name' => 'Diş Ağrısı',
            'nameEn' => 'Toothache',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('bookingReasons')->insert([
            'name' => 'Diş Estetiği',
            'nameEn' => 'Cosmetic Dentistry',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('bookingReasons')->insert([
            'name' => 'Diş Bakımı',
            'nameEn' => 'Dental Care',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('bookingReasons')->insert([
            'name' => 'Eksik Diş',
            'nameEn' => 'Missing Teeth',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

    // Tedavi tablosu oluşturulacak
    // Booking için tedavi adı sütunu oluşturulacak
    // Bu sütun aynı is_materialized'ın doldurulduğu gibi bildirim vasıtasıyla doldurulacak
}
