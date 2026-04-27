<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Denah Gedung</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex flex-col min-h-screen">
        <header class="shadow-lg">
            <div class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-gray-50 shadow-sm sticky top-0 z-10 ">
                <img src="https://placehold.co/200x50">
            </div>
        </header>
        <main class="py-10 flex-grow">
            <hero>
                <div class="flex items-center text-center justify-center mx-auto px-4 ">
                    <div class="grid grid-cols-1 gap-2">
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">Denah Gedung</h1>
                        <div class="col-span-1 col-start-1">
                            <p class="text text-sm">
                                Website ini adalah website untuk
                                mengetahui denah gedung, informasi ruangan, dan mencari rute terdekat
                                untuk rungan dari gedung
                                Jurusan Teknik Elektro.
                            </p>
                        </div>
                    </div>
                </div>
            </hero>

            <content>
                <div class="flex items-center justify-center rounded-xl mx-6 mt-10 bg-gray-200 shadow-lg">
                    <div class="grid grid-cols-1 gap-4 py-5">
                        <p class="col-span-1 text text-center text-2xl font-bold">List Gedung</p>
                        <div id="e11" class="col-span-1 flex-col rounded-md bg-white p-4">
                            <img class="w-64 h-64 object-cover"
                                src="https://unnes.ac.id/ft/wp-content/uploads/sites/9/2021/04/E-11.jpg">
                            <p class="text text-center text-lg pt-3">Gedung E11</p>
                        </div>
                        <div id="e6" class="col-span-1 flex-col rounded-md bg-white p-4">
                            <img class="w-64 h-64 object-cover"
                                src="https://unnes.ac.id/ft/wp-content/uploads/sites/9/2021/04/E-6.jpg">
                            <p class="text text-center text-lg pt-3">Gedung E6</p>
                        </div>
                        <div id="e8" class="col-span-1 flex-col rounded-md bg-white p-4">
                            <img class="w-64 h-64 object-cover"
                                src="https://unnes.ac.id/ft/wp-content/uploads/sites/9/2021/04/E-8.jpg">
                            <p class="text text-center text-lg pt-3">Gedung E8</p>
                        </div>
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
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const e11 = document.getElementById('e11');
        const e6 = document.getElementById('e6');
        const e8 = document.getElementById('e8');

        e11.addEventListener('click', function () {
            window.location.href = '/gedung/e11';
        });

        e6.addEventListener('click', function () {
            window.location.href = '/gedung/e6';
        });

        e8.addEventListener('click', function () {
            window.location.href = '/gedung/e8';
        });
    })
</script>
