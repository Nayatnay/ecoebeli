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
            @if (\Cart::getTotalQuantity() == 1)
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mi Compra de <strong class="text-orange-600 ml-1">{{ \Cart::getTotalQuantity() }} artículo</strong>
                </h2>
            @else
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mi Compra de <strong class="text-orange-600 ml-1">{{ \Cart::getTotalQuantity() }} artículos</strong>
                </h2>
            @endif
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto p-4 flex justify-between">
        <div class="w-full mr-6">
            <div class="w-full flex border-b border-gray-300  text-base p-4">
                <p class="font-bold mr-6">1. Dirección para el envío</p>

                <div class="text-gray-600 text-sm font-medium ">
                    <p class="uppercase">{{ Auth::user()->name }} </p>
                    <p> {{ Auth::user()->pais }}-{{ Auth::user()->estado }}-{{ Auth::user()->ciudad }}</p>
                    <p>{{ Auth::user()->direccion }}</p>
                    <p> CP.{{ Auth::user()->cp }}</p>
                </div>

            </div>
            <div>
                <p class="font-bold border-b border-gray-300 p-4">2. Método de pago</p>
            </div>
        </div>

        <div class="border rounded-lg ml-6 w-full md:w-[360px]">
            <div class="bg-gray-100 px-4 py-2 text-center font-medium">
                <p>Orden de Compra</p>
            </div>
            <div class="p-4 text-sm">
                <div class="flex justify-between ">
                    <p>Total pedido:</p>
                    <p>US${{ number_format(\Cart::getSubtotal(), 2, '.', '.') }}</p>
                </div>
                <div class="flex justify-between my-1">
                    <p>Envío:</p>
                    <p class=""> US${{ number_format(0, 2, '.', '.') }}</p>
                </div>
                <div class="flex justify-between border-b pb-4">
                    <p>Impuestos:</p>
                    <p class=""> US${{ number_format(0, 2, '.', '.') }}</p>
                </div>
                <div class="flex justify-between text-lg font-medium pt-4">
                    <p>Total Pedido:</p>
                    <p class=""> US${{ number_format(\Cart::getSubtotal(), 2, '.', '.') }}</p>
                </div>
            </div>
            <div class="bg-gray-100 px-4 py-2 text-center">
                Fondo de detalles
            </div>
        </div>
    </div>

</body>

</html>
