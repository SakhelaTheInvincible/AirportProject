<?php

use App\Models\User;
use App\Models\Airport;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'sakhelashviligiorgi23@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(), // mark email as verified
            'is_admin' => true,
        ]);
        

        // create 2 users
        User::create([
            'first_name' => 'Tengo',
            'last_name' => 'Giorgadze',
            'email' => 'giorgiadzetuguna@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'first_name' => 'Saba',
            'last_name' => 'Beradze',
            'email' => 'sababeradze@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // create 5 airports
        $airports = ['Tbilisi International Airport', 'Batumi International Airport', 'Kutaisi International Airport', 'Paris Charles de Gaulle Airport', 'Dubai International Airport'];
        foreach ($airports as $airport) {
            Airport::create(['name' => $airport]);
        }

        Ticket::create([
            'source_airport_id' => 1,
            'destination_airport_id' => 2,
            'date' => '2024-12-03',
            'class' => 'Economy',
            'price' => 300,
        ]);

        Ticket::create([
            'source_airport_id' => 1,
            'destination_airport_id' => 2,
            'date' => '2024-12-03',
            'class' => 'Business',
            'price' => 400,
        ]);

        Ticket::create([
            'source_airport_id' => 1,
            'destination_airport_id' => 2,
            'date' => '2024-12-03',
            'class' => 'First',
            'price' => 500,
        ]);

        Ticket::create([
            'source_airport_id' => 2,
            'destination_airport_id' => 3,
            'date' => '2024-12-05',
            'class' => 'Economy',
            'price' => 100,
        ]);

        Ticket::create([
            'source_airport_id' => 2,
            'destination_airport_id' => 3,
            'date' => '2024-12-05',
            'class' => 'Business',
            'price' => 150,
        ]);


        Ticket::create([
            'source_airport_id' => 3,
            'destination_airport_id' => 4,
            'date' => '2024-12-06',
            'class' => 'Business',
            'price' => 190,
        ]);

        Ticket::create([
            'source_airport_id' => 4,
            'destination_airport_id' => 5,
            'date' => '2024-12-20',
            'class' => 'Economy',
            'price' => 110,
        ]);

        Ticket::create([
            'source_airport_id' => 5,
            'destination_airport_id' => 1,
            'date' => '2024-12-25',
            'class' => 'First',
            'price' => 350,
        ]);

        Ticket::create([
            'source_airport_id' => 5,
            'destination_airport_id' => 1,
            'date' => '2024-12-25',
            'class' => 'First',
            'price' => 330,
        ]);
    }
}