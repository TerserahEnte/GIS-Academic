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
            <div
                class="flex items-center justify-center px-5 py-2 mx-auto w-auto bg-gray-50 shadow-sm sticky top-0 z-10 ">
                <img src="https://placehold.co/200x50">
            </div>
        </header>
        <main class="py-10 flex-grow">
            <hero>
                <div class="flex items-center text-center justify-center mx-auto px-4 ">
                    <div class="grid grid-cols-1 gap-2">
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">Rungan E210</h1>
                        <p>Merupakan rungan kelas yang berisi lab untuk jaringan dan lainnya berhubungan dengan
                            komputer.</p>
                        <hr>
                    </div>
                </div>
            </hero>

            <content>
                <div id="ruangan--card"
                    class="flex items-center justify-center rounded-xl mx-6 my-8 bg-gray-200 shadow-lg">
                    <div class="grid grid-cols-1 gap-2 py-5">
                        <p class="col-span-1 text-center text-2xl font-bold">Jadwal</p>
                        <hr>
                        <div class="grid grid-cols-4 gap-2 items-center justify-center my-1 mx-1">
                            <button id="denah-btn"
                                class="col-span-1 bg-zinc-700 rounded-4xl px-auto py-1 text-sm text-white font-bold">Senin</button>
                            <button id="jadwal-btn"
                                class="col-span-2 bg-zinc-700 rounded-4xl px-auto py-1 text-sm text-white font-bold">Selasa</button>
                            <button id="jadwal-btn"
                                class="col-span-1 bg-zinc-700 rounded-4xl px-auto py-1 text-sm text-white font-bold">Rabu</button>
                            <button id="jadwal-btn"
                                class="col-span-2 bg-zinc-700 rounded-4xl px-auto py-1 text-sm text-white font-bold">Kamis</button>
                            <button id="jadwal-btn"
                                class="col-span-2 bg-zinc-700 rounded-4xl px-auto py-1 text-sm text-white font-bold">Jumat</button>
                        </div>
                        <table id="jadwal-rungan-" class="table-auto border-collapse w-full bg-white p-8 rounded-2xl">
                            <thead class="">
                                <tr>
                                    <th class="px-4 py-2 border-b-2 border-r-2 border-gray-400">Waktu</th>
                                    <th class="px-4 py-2 border-b-2 border-gray-400">Jadwal</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2 border-r-2 border-gray-400 text-center">10.00</td>
                                    <td class="px-4 py-2 text-center">Pemrograman Web</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border-r-2 border-gray-400 text-center">11.00</td>
                                    <td class="px-4 py-2 text-center">Pemrograman Web</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border-r-2 border-gray-400 text-center">12.00</td>
                                    <td class="px-4 py-2 text-center">Pemrograman Web</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border-r-2 border-gray-400 text-center">13.00</td>
                                    <td class="px-4 py-2 text-center">Pemrograman Web</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="runganFoto-card"
                    class="flex items-center justify-center rounded-xl mx-6 my-8 bg-gray-200 shadow-lg">
                    <div class="grid grid-cols-1 gap-2 py-5 mx-5">
                        <p class="col-span-1 text-center text-2xl font-bold">Foto</p>
                        <div id="e11" class="col-span-1 flex-col rounded-md bg-white p-4">
                            <img class="w-64 h-64 object-cover"
                                src="https://unnes.ac.id/ft/wp-content/uploads/sites/9/2021/04/E-11.jpg">
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
