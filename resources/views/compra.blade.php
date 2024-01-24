<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito | Ebeli&trade;</title>
    <link rel="shortcut icon" href="{!! asset('img/icono.png') !!}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialised">
    @livewire('cabecera.nav-cabeza')
    <div class="shadow">
        <div class="flex items-center justify-between p-4 max-w-screen-xl mx-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mi Compra de <strong class="text-orange-600 ml-1">{{ \Cart::getTotalQuantity() }} artículos</strong>
            </h2>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto p-4 flex justify-between">
        <div class="w-full flex datos border rounded-lg p-4 text-lg">
            <p class="font-bold mr-6">1. dirección para el envío</p>

            <p class="text-gray-600 text-base">
                {{ Auth::user()->name }} <br>
                {{ Auth::user()->pais }}
                -{{ Auth::user()->estado }}-{{ Auth::user()->ciudad }} <br>{{ Auth::user()->direccion }} <br>
                CP.{{ Auth::user()->cp }}
            </p>
        </div>
        <div class="orden border rounded-lg p-4">
            hola mundos
        </div>
    </div>

</body>

</html>
