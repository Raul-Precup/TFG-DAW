<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>

<body class="main-layout">
    <!-- loader -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#"/></div>
    </div>

    <!-- header -->
    @include('home.header')

    <!-- booking table -->
    <div class="container mt-5">
        <h2 class="mb-4">Mis Reservas</h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha llegada</th>
                    <th>Fecha salida</th>
                    <th>Estado</th>
                    <th>Título de habitación</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>
                            @if($booking->trashed())
                                <span class="text-danger">Eliminado</span>
                            @else
                                <span class="text-success">Activo</span>
                            @endif
                        </td>
                        <td>{{ $booking->room->room_title ?? 'N/A' }}</td>
                        <td>{{ $booking->room->price ?? 'N/A' }}</td>
                        <td>
                            @if($booking->room && $booking->room->image)
                                <img style="width: 200px;" src="/room/{{ $booking->room->image }}" alt="Room Image">
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- footer -->
    @include('home.footer')
</body>
</html>
