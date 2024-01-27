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

<body class="antialised bg-gray-100">

    @livewire('cabecera.nav-cabeza')

    <div class="shadow bg-white">
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

    <!-- Cuerpo de Compras -->

    <div class="max-w-screen-xl mx-auto p-4 flex justify-between">

        <div class="w-full mr-6 bg-white p-4">

            <div class="w-full text-base p-4">
                <div class="flex border-b border-gray-300 pb-4">
                    <div class="font-bold mr-6">
                        <p>1. Dirección para el envío</p>
                    </div>
                    <div class="text-gray-600 text-sm font-medium">
                        <p class="uppercase">{{ Auth::user()->name }} </p>
                        <p> {{ Auth::user()->pais }}-{{ Auth::user()->estado }}-{{ Auth::user()->ciudad }}</p>
                        <p>{{ Auth::user()->direccion }}</p>
                        <p> CP.{{ Auth::user()->cp }}</p>
                    </div>
                </div>

            </div>

            <div class="w-full p-4 text-base">
                <p class="font-bold border-b border-gray-300 pb-4">2. Método de pago</p>
                <div class="w-full flex justify-between text-gray-600 text-sm font-medium my-4">
                    <p><i class="fa-regular fa-credit-card mr-4"></i>Visa que termina de 6578</p>
                    <p> {{ Auth::user()->name }}</p>
                    <p>10/2027</p>
                </div>
                <div class="w-full flex justify-between text-gray-600 text-sm font-medium my-4">
                    <p><i class="fa-regular fa-credit-card mr-4"></i>Mastercard que termina de 4875</p>
                    <p> {{ Auth::user()->name }}</p>
                    <p>10/2027</p>
                </div>
                <div class="w-full flex justify-between text-gray-600 text-sm font-medium mt-4">
                    <p><i class="fa-regular fa-credit-card mr-4"></i>Visa Platinium que termina de 6021</p>
                    <p> {{ Auth::user()->name }}</p>
                    <p>10/2027</p>
                </div>
            </div>

            <div class="p-4">
                @livewire('medios.agregar-tc')
            </div>

        </div>

        <div class="border rounded-lg ml-6 w-full md:w-[360px] max-h-[268px]">
            <div class="px-4 py-3 text-center font-medium border-b bg-zinc-700 text-white rounded-t-lg">
                <p>Orden de Compra</p>
            </div>
            <div class="p-4 text-sm">
                <div class="flex justify-between ">
                    <p>Total pedido:</p>
                    <p>US${{ number_format(\Cart::getSubtotal(), 2, '.', '.') }}</p>
                </div>
                <div class="flex justify-between my-2">
                    <p>Envío:</p>
                    <p class=""> US${{ number_format(0, 2, '.', '.') }}</p>
                </div>
                <div class="flex justify-between border-b pb-4">
                    <p>Impuestos:</p>
                    <p class=""> US${{ number_format(0, 2, '.', '.') }}</p>
                </div>
                <div class="flex justify-between text-lg font-medium pt-4 text-orange-600">
                    <p>Total Pedido:</p>
                    <p class=""> US${{ number_format(\Cart::getSubtotal(), 2, '.', '.') }}</p>
                </div>
            </div>
            <div class="p-4 bg-gray-200 rounded-b-lg">
                @livewire('medios.mediosde-pago')
                <a href="https://wa.me/+584126067734?text=Hola. Me gustaria conocer los medios de pago que acepta además de los indicados en la web."
            target="_blank" class="hover:underline text-xs">Contacto en Venezuela +58-4126067734</a>
            </div>
            
        </div>

</body>

</html>
