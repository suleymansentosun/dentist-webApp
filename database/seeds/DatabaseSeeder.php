<?php

use Illuminate\Database\Seeder;
use App\Specialty;
use App\User;
use App\Patient;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(DentistSeeder::class);
        $users = factory(App\User::class, 10)
           ->create()
           ->each(function ($user) {
                $user->roles()->attach(1);
                $user->roles()->attach(3);
            });
        $doctors = factory(App\Doctor::class, 7)
           ->create()
           ->each(function ($doctor) {
                $countOfSpecialties = rand(1, 3);
                for ($i = 0; $i < $countOfSpecialties; $i++) {
                    $doctor->specialties()->syncWithoutDetaching([rand(1, 7)]);
                }
                $user = User::find($doctor->user_id);
                $user->roles()->attach(1);
                $user->roles()->attach(4);
            });
        $bookings = factory(App\Booking::class, 2000)
            ->create()
            ->each(function ($booking) {
                $user = User::find($booking->user_id);
                $user->roles()->syncWithoutDetaching(1);
                $user->roles()->syncWithoutDetaching(2);
                $user->patients()->syncWithoutDetaching($booking->patient_id);
                $booking->patient->doctors()->syncWithoutDetaching($booking->doctor_id);
            });

        // patientlardan bookingleri arasında is_materialized'ında null ya da 1 olmayancı patientslar arasından çıkar
        foreach(Patient::all() as $patient) {
            $bookingIsMaterializedIsNull = DB::table('bookings')->where('patient_id', $patient->id)
            ->whereNull('is_materialized')->get();
            $bookingIsMaterializedIsTrue = DB::table('bookings')->where('patient_id', $patient->id)
            ->where('is_materialized', true)->get();

            if (count($bookingIsMaterializedIsNull) == 0 && count($bookingIsMaterializedIsTrue) == 0) {
                $patient->delete();
                $patient->users()->detach();
                $patient->doctors()->detach();

                foreach($patient->bookings as $booking) {
                    $booking->patient_id = null;
                    $booking->save();
                }
            }
        }
    }
}
