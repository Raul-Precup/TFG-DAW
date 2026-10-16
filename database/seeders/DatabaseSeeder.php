<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Datos de demostración. No usa factories porque Faker solo se instala en desarrollo
 * y en el despliegue de Vercel no está disponible.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::forceCreate([
            'name' => 'Administrador',
            'email' => 'admin@hotel.test',
            'password' => Hash::make('demo1234'),
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::forceCreate([
            'name' => 'Cliente Demo',
            'email' => 'cliente@hotel.test',
            'phone' => '600000000',
            'password' => Hash::make('demo1234'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        $rooms = [
            ['Habitación Individual', 'regular', '65', '1746531217.jpg', 'Habitación tranquila y luminosa, ideal para viajes de trabajo o escapadas cortas.'],
            ['Habitación Doble Estándar', 'regular', '85', '1746540458.jpg', 'Cama de matrimonio, baño completo y escritorio. Todo lo necesario para una estancia cómoda.'],
            ['Habitación Doble Superior', 'premium', '110', '1746540913.jpg', 'Más espacio, zona de estar y acabados de mayor calidad.'],
            ['Suite Junior', 'premium', '150', '1746780771.jpg', 'Suite con salón integrado, cafetera y amenities premium.'],
            ['Suite Deluxe', 'deluxe', '220', '1746781479.jpg', 'Amplia suite con vistas, bañera y servicio de habitaciones.'],
            ['Suite Presidencial', 'deluxe', '320', '1746781499.jpg', 'La mejor suite del hotel: salón independiente, terraza y atención personalizada.'],
        ];

        foreach ($rooms as [$title, $type, $price, $image, $description]) {
            Room::create([
                'room_title' => $title,
                'room_type' => $type,
                'price' => $price,
                'image' => $image,
                'description' => $description,
                'wifi' => 'yes',
            ]);
        }

        foreach (glob(public_path('gallery').'/*.{jpg,jpeg,png}', GLOB_BRACE) as $file) {
            Gallery::create(['image' => basename($file)]);
        }

        $bookings = [
            [1, now()->addDays(3), now()->addDays(5), 'approve'],
            [4, now()->addDays(10), now()->addDays(14), 'waiting'],
        ];

        foreach ($bookings as [$roomId, $start, $end, $status]) {
            $booking = Booking::create([
                'room_id' => $roomId,
                'name' => 'Cliente Demo',
                'email' => 'cliente@hotel.test',
                'phone' => '600000000',
                'start_date' => $start->toDateString(),
                'end_date' => $end->toDateString(),
            ]);
            $booking->status = $status;
            $booking->save();
        }

        Contact::create([
            'name' => 'Laura Martín',
            'email' => 'laura@example.com',
            'phone' => '611111111',
            'message' => '¿Tenéis disponibilidad para dos noches el próximo fin de semana?',
        ]);
    }
}
