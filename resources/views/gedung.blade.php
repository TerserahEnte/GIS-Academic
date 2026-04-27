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
                        <h1 class="col-span-1 col-start-1 text text-4xl font-bold">Gedung {{ strtoupper($gedung) }}</h1>
                        <p>Pilih menu apa yang akan ditampilkan.</p>
                        <hr>
                    </div>
                </div>
            </hero>

            <content>
                <div class="grid grid-cols-2 gap-3 items-center justify-center my-4 mx-10">
                    <button id="denah-btn" class="col-span-1 bg-zinc-700 rounded-4xl px-auto py-1 text-lg text-white">Denah</button>
                    <button id="jadwal-btn" class="col-span-1 bg-zinc-700 rounded-4xl px-auto py-1 text-lg text-white">Jadwal</button>
                </div>

                <!-- Tampilan Denah -->
                <div id="denah-card" class="flex items-center justify-center rounded-xl mx-6 my-8 bg-gray-200 shadow-lg">
                    <div class="grid grid-cols-1 gap-2 py-5 mx-5">
                        <p class="col-span-1 text-center text-2xl font-bold">Denah</p>
                        <p class="col-span-1 text-sm text-justify ">Scan QR Code untuk mengetahui titik awal atau bisa
                            memilih titik awal dari posisi untuk menampilkan posisi anda di denah.</p>
                        <form class="grid grid-cols-1 gap-2 col-span-1">
                            <div class="grid grid-cols-1 gap-2 col-span-1">
                                <button class="flex gap-2 items-center justify-center bg-white py-1 mx-18 rounded-4xl">
                                    <!-- Tombol Scan QR Code -->
                                    <svg class="w-8" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                        <path
                                            d="M213.1 128.8L202.7 160L128 160C92.7 160 64 188.7 64 224L64 480C64 515.3 92.7 544 128 544L512 544C547.3 544 576 515.3 576 480L576 224C576 188.7 547.3 160 512 160L437.3 160L426.9 128.8C420.4 109.2 402.1 96 381.4 96L258.6 96C237.9 96 219.6 109.2 213.1 128.8zM320 256C373 256 416 299 416 352C416 405 373 448 320 448C267 448 224 405 224 352C224 299 267 256 320 256z" />
                                    </svg>
                                    <p>Scan QR</p>
                                </button>
                            </div>
                            <div class="col-span-1 flex justify-between py-3 px-5 bg-white rounded-4xl">
                                <label>Pilih Tempat:</label>
                                <select class="outline-none">
                                    <option value="volvo">Pintu Masuk Lantai 2</option>
                                    <option value="saab">Pintu Masuk Lantai 1</option>
                                    <option value="mercedes">Tangga Lantai 2</option>
                                    <option value="audi">Tangga Lantai 1</option>
                                </select>
                            </div>
                            <button class="col-span-1 mt-5 py-3 px-5 bg-zinc-700 text-white text-xl font-bold rounded-4xl">Lihat Denah</button>
                        </form>
                    </div>
                </div>

                <!-- Tampilan Jadwal-->
                <div id="jadwal-card" class="hidden flex items-center justify-center rounded-xl mx-6 my-8 bg-gray-200 shadow-lg">
                    <div class="grid grid-cols-1 gap-2 py-5 mx-5">
                        <p class="col-span-1 text-center text-2xl font-bold">Jadwal</p>
                        <p class="col-span-1 text-sm text-justify ">Lihat jadwal ruangan, jadwal mengajar dosen, dan informasi ruangan di gedung.</p>
                        <form class="grid grid-cols-1 gap-2 col-span-1">
                            <div class="col-span-1 grid grid-cols-2 gap-2 py-3">
                                <label class="col-span-2 font-bold">Cari Tempat Atau Dosen:</label>

                                <!-- Nanti dibuat Search Suggestion atau Auto Complete -->
                                <input type="text" class="col-span-2 outline-none py-3 px-5 bg-white rounded-4xl" placeholder="Ketik Disini...">

                            </div>
                            <button class="col-span-1 mt-5 py-3 px-5 bg-zinc-700 text-white text-xl font-bold rounded-4xl">Lihat Informasi</button>
                        </form>
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
        const denahCard = document.getElementById('denah-card');
        const jadwalCard = document.getElementById('jadwal-card');

        const denahBtn = document.getElementById('denah-btn');
        const jadwalBtn = document.getElementById('jadwal-btn');

        denahBtn.addEventListener('click', function () {
            denahCard.classList.remove('hidden');
            denahCard.classList.add('flex');
            jadwalCard.classList.add('hidden');
        });
        jadwalBtn.addEventListener('click', function () {
            denahCard.classList.add('hidden');
            jadwalCard.classList.remove('hidden');
            jadwalCard.classList.add('flex');
        });

        
    })
</script>
