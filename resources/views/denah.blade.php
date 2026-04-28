<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Floor Plan Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 300px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex flex-col min-h-screen">
        <header class="shadow-lg">
            <div
                class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-gray-50 shadow-sm sticky top-0 z-10 ">
                <img src="https://placehold.co/200x50">
            </div>
        </header>
        <main class="py-10 flex-grow">
            <hero>
                <div class="flex items-center text-center justify-center mx-auto px-4 ">
                    <div class="grid grid-cols-1 gap-2">
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">Navigasi Ruangan</h1>
                        <p>Titik Awal -> Titik Akhir</p>
                        <hr>
                    </div>
                </div>
            </hero>

            <content>
                <div id="runganFoto-card"
                    class="w-full max-w-md mx-auto rounded-xl px-4 py-6 my-10 bg-gray-200 shadow-lg">

                    <div class="w-full flex flex-col gap-3">
                        <p class="text-center text-2xl font-bold">Peta</p>

                        <!-- Map should fill container -->
                        <div id="map" class="w-full h-64 rounded-lg"></div>

                        <button class="w-full rounded-4xl bg-white py-2 font-bold">
                            Lantai Berikutnya
                        </button>

                        <div class="grid grid-cols-3 gap-3 w-full">
                            <button class="rounded-4xl bg-white py-2 font-bold">L1</button>
                            <button class="rounded-4xl bg-stone-700 text-white py-2 font-bold">L2</button>
                            <button class="rounded-4xl bg-white py-2 font-bold">L3</button>
                        </div>

                        <button class="w-full rounded-4xl bg-stone-700 text-white py-2 mt-4 font-bold">
                            Lihat Informasi Ruangan
                        </button>
                    </div>
                </div>
            </content>
        </main>

        <footer class="shadow-lg">
            <div class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-zinc-700 shadow-sm top-0 z-10 ">
                <p class="text text-white">Copyright © 2025</p>
            </div>
        </footer>
    </div>


    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map', {
            crs: L.CRS.Simple,
            minZoom: -2
        });

        var bounds = [
            [0, 0],
            [100, 100]
        ]; // [height, width]

        var image = L.imageOverlay('{{ asset('images/Denah E11-Lantai-1.png') }}', bounds).addTo(map);

        map.fitBounds(bounds);
    </script>

</body>

</html>
