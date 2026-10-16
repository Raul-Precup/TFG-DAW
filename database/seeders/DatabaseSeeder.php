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
            ['Habitación Individual', 'regular', '65', 'precaps-individual.webp', 'Una habitación tranquila y luminosa, con cama amplia, escritorio y baño completo. Ideal para viajes de trabajo o escapadas cortas.'],
            ['Habitación Doble Estándar', 'regular', '85', 'precaps-doble-estandar.webp', 'Dos camas, luz cálida y todo lo necesario para descansar bien. Perfecta para amigos o familia.'],
            ['Habitación Doble Superior', 'premium', '110', 'precaps-doble-superior.webp', 'Más espacio, zona de estar junto a la ventana y acabados de mayor calidad.'],
            ['Suite Junior', 'premium', '150', 'precaps-suite-junior.webp', 'Suite con salón integrado y balcón abierto al jardín. Cafetera, albornoces y amenities premium.'],
            ['Suite Deluxe', 'deluxe', '220', 'precaps-suite-deluxe.webp', 'Cama con dosel, tonos verdes y mucha luz natural. Pensada para celebrar algo especial.'],
            ['Suite Presidencial', 'deluxe', '320', 'precaps-suite-presidencial.webp', 'La mejor suite del hotel: salón independiente, zona de comedor y atención personalizada.'],
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

        // Solo fotos del hotel: la carpeta tiene además imágenes de prueba que no deben salir en la demo.
        $gallery = [
            'precaps-vestibulo.webp', 'precaps-dormitorio-dorado.webp', 'precaps-piscina-atardecer.webp',
            'precaps-desayuno-cama.webp', 'precaps-spa.webp', 'precaps-terraza.webp',
            'precaps-recepcion.webp', 'precaps-cafe.webp', 'precaps-banera.webp', 'precaps-piscina-palmeras.webp',
        ];

        foreach ($gallery as $image) {
            Gallery::create(['image' => $image]);
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
