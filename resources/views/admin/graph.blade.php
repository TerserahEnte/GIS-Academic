<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Floor Plan Map - Admin Node & Edge</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .leaflet-div-icon {
            background: transparent !important;
            border: none !important;
        }
    </style>
</head>

<body>
    <div class="flex flex-col min-h-screen">
        <header class="shadow-lg">
            <div class="flex items-center justify-between px-5 py-2 mx-auto w-auto bg-gray-50 shadow-sm sticky top-0 z-10 ">
                <button id="sideBar-btn" class="w-8 col-span-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
                <div class="col-span-1 grid grid-cols-2 gap-4 text-xl font-black">
                    <a href="{{ route('navigation') }}" class="col-span-1 text-center hover:text-zinc-600 transition">Halaman Utama</a>
                    <form action="{{ route('logout') }}" method="POST" class="col-span-1 inline">
                        @csrf
                        <button type="submit" class="w-full text-center hover:text-zinc-600 transition cursor-pointer">Logout</button>
                    </form>
                </div>

            </div>
        </header>

        <!-- Sidebar -->
        <sidebar id="sidebar"
            class="fixed top-0 left-0 h-full w-64 bg-zinc-700 text-white transform -translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="p-4">
                <img src="https://placehold.co/200x50/ffffff/000000?text=Admin+Logo" alt="Admin Logo" class="mb-8">
                <nav>
                    <ul>
                        <li class="mb-2">
                            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-600">Jadwal</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.ruangan.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-600">Ruangan</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.dosen.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-600">Dosen</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.graph.index') }}" class="block py-2 px-4 rounded-lg bg-white text-black font-bold">Node dan Edge</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </sidebar>
        <!-- Sidebar Backdrop -->
        <div id="sidebar-backdrop" class="fixed inset-0 opacity-70 bg-black bg-opacity-50 z-40 hidden"></div>

        <main class="py-0 grow">
            <content>
                <div class="w-full px-15 py-10">
                    <!-- Title & Header Alerts -->
                    <div class="flex justify-between items-center mb-6 w-full">
                        <h1 class="text-4xl font-bold">Graph Management</h1>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm font-semibold mb-6 w-full">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold mb-6 w-full">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Map Visualizer Panel -->
                    <div class="w-full flex flex-col bg-gray-200 shadow-lg rounded-xl p-6 mb-8 gap-4">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full gap-4 mb-2">
                            <h2 class="text-2xl font-bold text-black flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current text-zinc-700" viewBox="0 0 576 512">
                                    <path d="M565.6 36.2C572.1 40.7 576 48.1 576 56L576 392c0 10.7-5.3 20.7-14.2 26.6l-160 106.7c-9.4 6.3-21.9 6.3-31.4 0L208 318.3 22.2 411.2C13.2 415.7 2.4 412.3 .4 402.7S-1.2 380 4 371L160 254l0-198c0-7.9 3.9-15.3 10.4-19.8s15.1-4.7 21.8-1.5L368 118.9 543.8 34.6c6.8-3.3 15-3 21.8 1.5zM384 159.2L240 76.5l0 176.3 144 82.7 0-176.3z"/>
                                </svg>
                                Visualisasi Peta Graph
                            </h2>
                            <div class="flex items-center gap-6 bg-white py-2 px-4 rounded-xl shadow-sm border border-gray-200">
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input type="checkbox" id="toggle-node-id" checked class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-zinc-700"></div>
                                    <span class="ml-2.5 text-xs font-bold text-zinc-700">ID Node</span>
                                </label>
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input type="checkbox" id="toggle-edge-weight" checked class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-zinc-700"></div>
                                    <span class="ml-2.5 text-xs font-bold text-zinc-700">Bobot Edge</span>
                                </label>
                            </div>
                        </div>
                        <div id="map" style="height: 500px;" class="w-full rounded-xl overflow-hidden shadow-inner border border-zinc-300 z-0"></div>
                        <div class="p-2.5 bg-stone-300 rounded-xl shadow-inner">
                            <div id="floor-btn" class="grid grid-cols-5 md:grid-cols-10 gap-3 w-full">
                                <button class="rounded-xl bg-stone-700 text-white py-2 font-bold transition shadow-sm hover:opacity-90 cursor-pointer">L1</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L2</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L3</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L4</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L5</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L6</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L7</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L8</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L9</button>
                                <button class="rounded-xl bg-white text-zinc-800 py-2 font-bold transition shadow-sm hover:bg-gray-100 cursor-pointer">L10</button>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center text-xs text-stone-600 px-1">
                            <div>💡 Gerakkan kursor di peta untuk melacak koordinat. Klik untuk menyalin <code>Lat, Lng</code> ke clipboard.</div>
                            <div class="font-semibold text-stone-700 mt-1 md:mt-0" id="coords-status"></div>
                        </div>
                    </div>

                    <!-- Two columns layout side-by-side -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full items-start">
                        
                        <!-- Left Panel: Nodes CRUD -->
                        <div class="flex flex-col bg-gray-200 shadow-lg rounded-xl p-6 gap-4">
                            <div class="flex justify-between items-center w-full mb-2">
                                <h2 class="text-2xl font-bold text-black">Nodes (Titik)</h2>
                                <button onclick="openAddNodeModal()" class="bg-zinc-700 hover:bg-zinc-800 text-white font-bold py-2.5 px-4 rounded-xl text-sm transition cursor-pointer shadow flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 448 512">
                                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                                    </svg>
                                    Tambah Node
                                </button>
                            </div>
                            <!-- Limit Selector and Status -->
                            <div class="flex justify-between items-center px-1 text-sm font-semibold text-stone-700">
                                <div class="flex items-center gap-1.5">
                                    <span>Tampilkan:</span>
                                    <select id="node-limit-select" class="bg-white border border-gray-300 rounded-lg px-2.5 py-1 text-xs focus:ring-zinc-500">
                                        <option value="5" selected>5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="-1">Semua</option>
                                    </select>
                                    <span>data</span>
                                </div>
                                <div id="node-page-info" class="text-xs text-stone-500"></div>
                            </div>
                            <div class="overflow-x-auto w-full">
                                <table class="w-full text-center border-collapse bg-white rounded-4xl overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th class="text-lg font-bold text-black p-3 border-r-2 border-b-2 border-black">ID</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-r-2 border-black">Nama Node</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-r-2 border-black">Lantai</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-r-2 border-black">Lat, Lng</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-black">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="node-table-body">
                                        @forelse($nodes as $node)
                                            <tr class="hover:bg-gray-50 transition text-sm">
                                                <td class="p-3 border-r border-b border-gray-300 font-semibold">{{ $node->id }}</td>
                                                <td class="p-3 border-r border-b border-gray-300 text-left">{{ $node->name }}</td>
                                                <td class="p-3 border-r border-b border-gray-300">{{ $node->floor }}</td>
                                                <td class="p-3 border-r border-b border-gray-300">{{ $node->lat }}, {{ $node->lng }}</td>
                                                <td class="p-3 border-b border-gray-300">
                                                    <div class="flex gap-1.5 justify-center">
                                                        <button onclick="openEditNodeModal({{ json_encode($node) }})" class="bg-zinc-600 hover:bg-zinc-700 text-white px-2 py-1 rounded text-xs font-bold transition cursor-pointer">Edit</button>
                                                        <button onclick="openDeleteNodeModal('{{ $node->id }}', '{{ $node->name }}')" class="bg-zinc-600 hover:bg-zinc-700 text-white px-2 py-1 rounded text-xs font-bold transition cursor-pointer">Hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="py-8 px-3 text-center text-zinc-500 italic">Tidak ada data node.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination buttons -->
                            <div class="flex justify-end gap-2 px-1" id="node-pagination-controls">
                                <button id="node-prev-btn" class="bg-white hover:bg-gray-100 text-stone-800 border border-gray-300 px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer shadow-sm">Sebelumnya</button>
                                <button id="node-next-btn" class="bg-white hover:bg-gray-100 text-stone-800 border border-gray-300 px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer shadow-sm">Berikutnya</button>
                            </div>
                        </div>

                        <!-- Right Panel: Edges CRUD -->
                        <div class="flex flex-col bg-gray-200 shadow-lg rounded-xl p-6 gap-4">
                            <div class="flex justify-between items-center w-full mb-2">
                                <h2 class="text-2xl font-bold text-black">Edges (Penghubung)</h2>
                                <button onclick="openAddEdgeModal()" class="bg-zinc-700 hover:bg-zinc-800 text-white font-bold py-2.5 px-4 rounded-xl text-sm transition cursor-pointer shadow flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 448 512">
                                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                                    </svg>
                                    Tambah Edge
                                </button>
                            </div>
                            <!-- Limit Selector and Status -->
                            <div class="flex justify-between items-center px-1 text-sm font-semibold text-stone-700">
                                <div class="flex items-center gap-1.5">
                                    <span>Tampilkan:</span>
                                    <select id="edge-limit-select" class="bg-white border border-gray-300 rounded-lg px-2.5 py-1 text-xs focus:ring-zinc-500">
                                        <option value="5" selected>5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="-1">Semua</option>
                                    </select>
                                    <span>data</span>
                                </div>
                                <div id="edge-page-info" class="text-xs text-stone-500"></div>
                            </div>
                            <div class="overflow-x-auto w-full">
                                <table class="w-full text-center border-collapse bg-white rounded-4xl overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th class="text-lg font-bold text-black p-3 border-r-2 border-b-2 border-black">ID</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-r-2 border-black">Dari Node</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-r-2 border-black">Ke Node</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-r-2 border-black">Bobot</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-r-2 border-black">Tangga?</th>
                                            <th class="text-lg font-bold text-black p-3 border-b-2 border-black">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="edge-table-body">
                                        @forelse($edges as $edge)
                                            <tr class="hover:bg-gray-50 transition text-sm">
                                                <td class="p-3 border-r border-b border-gray-300 font-semibold">{{ $edge->id }}</td>
                                                <td class="p-3 border-r border-b border-gray-300 text-left">{{ $edge->from_node_name }} (L{{ $edge->from_node_floor }})</td>
                                                <td class="p-3 border-r border-b border-gray-300 text-left">{{ $edge->to_node_name }} (L{{ $edge->to_node_floor }})</td>
                                                <td class="p-3 border-r border-b border-gray-300">{{ $edge->weight }}</td>
                                                <td class="p-3 border-r border-b border-gray-300">
                                                    @if($edge->is_stairs)
                                                        <span class="bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full font-bold">Ya</span>
                                                    @else
                                                        <span class="text-gray-400 font-bold">-</span>
                                                    @endif
                                                </td>
                                                <td class="p-3 border-b border-gray-300">
                                                    <div class="flex gap-1.5 justify-center">
                                                        <button onclick="openEditEdgeModal({{ json_encode($edge) }})" class="bg-zinc-600 hover:bg-zinc-700 text-white px-2 py-1 rounded text-xs font-bold transition cursor-pointer">Edit</button>
                                                        <button onclick="openDeleteEdgeModal('{{ $edge->id }}')" class="bg-zinc-600 hover:bg-zinc-700 text-white px-2 py-1 rounded text-xs font-bold transition cursor-pointer">Hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="py-8 px-3 text-center text-zinc-500 italic">Tidak ada data edge.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination buttons -->
                            <div class="flex justify-end gap-2 px-1" id="edge-pagination-controls">
                                <button id="edge-prev-btn" class="bg-white hover:bg-gray-100 text-stone-800 border border-gray-300 px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer shadow-sm">Sebelumnya</button>
                                <button id="edge-next-btn" class="bg-white hover:bg-gray-100 text-stone-800 border border-gray-300 px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer shadow-sm">Berikutnya</button>
                            </div>
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

        <!-- ==========================================
             MODALS: NODES
             ========================================== -->
        <!-- Add Node Modal -->
        <div id="add-node-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>
            <div class="relative bg-white rounded-2xl max-w-md w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Tambah Node</h3>
                    <button onclick="closeAddNodeModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form action="{{ route('admin.nodes.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4 text-sm font-semibold text-stone-700">
                        <div class="flex flex-col gap-2">
                            <label for="node_name">Nama Node:</label>
                            <input type="text" id="node_name" name="name" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: Tangga Lantai 1">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="node_floor">Lantai:</label>
                            <input type="number" id="node_floor" name="floor" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: 1">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="node_lat">Latitude (X):</label>
                                <input type="number" id="node_lat" name="lat" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: 150">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="node_lng">Longitude (Y):</label>
                                <input type="number" id="node_lng" name="lng" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: 300">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAddNodeModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Node Modal -->
        <div id="edit-node-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>
            <div class="relative bg-white rounded-2xl max-w-md w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Edit Node</h3>
                    <button onclick="closeEditNodeModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form id="edit-node-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-4 text-sm font-semibold text-stone-700">
                        <div class="flex flex-col gap-2">
                            <label for="edit_node_id">ID Node:</label>
                            <input type="text" id="edit_node_id" disabled class="bg-gray-200 border border-gray-300 rounded-lg p-2.5 text-stone-500 cursor-not-allowed">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edit_node_name">Nama Node:</label>
                            <input type="text" id="edit_node_name" name="name" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edit_node_floor">Lantai:</label>
                            <input type="number" id="edit_node_floor" name="floor" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="edit_node_lat">Latitude (X):</label>
                                <input type="number" id="edit_node_lat" name="lat" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="edit_node_lng">Longitude (Y):</label>
                                <input type="number" id="edit_node_lng" name="lng" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeEditNodeModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Node Modal -->
        <div id="delete-node-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>
            <div class="relative bg-white rounded-2xl max-w-sm w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col items-center text-center z-10">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm128 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm128 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold text-stone-900 mb-2">Konfirmasi Hapus Node</h3>
                <p class="text-sm text-stone-600 leading-relaxed mb-6">Apakah Anda yakin ingin menghapus node <strong id="delete-node-name"></strong> (ID: <span id="delete-node-id"></span>)? Semua edge yang terhubung ke node ini juga akan dihapus.</p>
                <form id="delete-node-form" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteNodeModal()" class="w-1/2 py-3 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="w-1/2 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition cursor-pointer">Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ==========================================
             MODALS: EDGES
             ========================================== -->
        <!-- Add Edge Modal -->
        <div id="add-edge-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>
            <div class="relative bg-white rounded-2xl max-w-md w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Tambah Edge</h3>
                    <button onclick="closeAddEdgeModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form action="{{ route('admin.edges.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4 text-sm font-semibold text-stone-700">
                        <div class="flex flex-col gap-2">
                            <label for="edge_from_node">Dari Node:</label>
                            <select id="edge_from_node" name="from_node_id" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="">Pilih Node Awal</option>
                                @foreach($nodes as $node)
                                    <option value="{{ $node->id }}">{{ $node->name }} (Lantai {{ $node->floor }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edge_to_node">Ke Node:</label>
                            <select id="edge_to_node" name="to_node_id" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                <option value="">Pilih Node Akhir</option>
                                @foreach($nodes as $node)
                                    <option value="{{ $node->id }}">{{ $node->name }} (Lantai {{ $node->floor }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edge_weight">Bobot (Jarak/Pemberat):</label>
                            <input type="number" id="edge_weight" name="weight" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: 10" min="0">
                        </div>
                        <div class="flex items-center gap-2 py-2">
                            <input type="checkbox" id="edge_is_stairs" name="is_stairs" value="1" class="w-4 h-4 text-stone-800 border-gray-300 rounded focus:ring-stone-500">
                            <label for="edge_is_stairs" class="user-select-none">Merupakan Jalur Tangga / Penghubung Lantai</label>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAddEdgeModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Edge Modal -->
        <div id="edit-edge-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>
            <div class="relative bg-white rounded-2xl max-w-md w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Edit Edge</h3>
                    <button onclick="closeEditEdgeModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form id="edit-edge-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-4 text-sm font-semibold text-stone-700">
                        <div class="flex flex-col gap-2">
                            <label for="edit_edge_id">ID Edge:</label>
                            <input type="text" id="edit_edge_id" disabled class="bg-gray-200 border border-gray-300 rounded-lg p-2.5 text-stone-500 cursor-not-allowed">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edit_edge_from_node">Dari Node:</label>
                            <select id="edit_edge_from_node" name="from_node_id" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                @foreach($nodes as $node)
                                    <option value="{{ $node->id }}">{{ $node->name }} (Lantai {{ $node->floor }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edit_edge_to_node">Ke Node:</label>
                            <select id="edit_edge_to_node" name="to_node_id" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                                @foreach($nodes as $node)
                                    <option value="{{ $node->id }}">{{ $node->name }} (Lantai {{ $node->floor }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edit_edge_weight">Bobot:</label>
                            <input type="number" id="edit_edge_weight" name="weight" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" min="0">
                        </div>
                        <div class="flex items-center gap-2 py-2">
                            <input type="checkbox" id="edit_edge_is_stairs" name="is_stairs" value="1" class="w-4 h-4 text-stone-800 border-gray-300 rounded focus:ring-stone-500">
                            <label for="edit_edge_is_stairs" class="user-select-none">Merupakan Jalur Tangga / Penghubung Lantai</label>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeEditEdgeModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Edge Modal -->
        <div id="delete-edge-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>
            <div class="relative bg-white rounded-2xl max-w-sm w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col items-center text-center z-10">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm128 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm128 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold text-stone-900 mb-2">Konfirmasi Hapus Edge</h3>
                <p class="text-sm text-stone-600 leading-relaxed mb-6">Apakah Anda yakin ingin menghapus edge dengan ID <strong id="delete-edge-id-display"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <form id="delete-edge-form" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteEdgeModal()" class="w-1/2 py-3 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="w-1/2 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition cursor-pointer">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let map;
        let nodeLayer, nodeIdLayer, edgeLayer, weightLayer;
        let image;
        let imageUrls = {};
        let bounds;

        document.addEventListener('DOMContentLoaded', () => {
            initSidebarToggle();
            initBackdropClosers();
            initLeafletMap();
            initTablePagination();
        });

        // ======================================================
        // NODE MODAL ACTIONS
        // ======================================================
        function openAddNodeModal() {
            const modal = document.getElementById('add-node-modal');
            const card = modal.querySelector('.relative');
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAddNodeModal() {
            const modal = document.getElementById('add-node-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function openEditNodeModal(node) {
            const modal = document.getElementById('edit-node-modal');
            const card = modal.querySelector('.relative');
            
            document.getElementById('edit_node_id').value = node.id;
            document.getElementById('edit_node_name').value = node.name;
            document.getElementById('edit_node_floor').value = node.floor;
            document.getElementById('edit_node_lat').value = node.lat;
            document.getElementById('edit_node_lng').value = node.lng;

            document.getElementById('edit-node-form').action = `/admin/nodes/${node.id}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditNodeModal() {
            const modal = document.getElementById('edit-node-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function openDeleteNodeModal(id, name) {
            const modal = document.getElementById('delete-node-modal');
            const card = modal.querySelector('.relative');
            
            document.getElementById('delete-node-id').textContent = id;
            document.getElementById('delete-node-name').textContent = name;
            document.getElementById('delete-node-form').action = `/admin/nodes/${id}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteNodeModal() {
            const modal = document.getElementById('delete-node-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // ======================================================
        // EDGE MODAL ACTIONS
        // ======================================================
        function openAddEdgeModal() {
            const modal = document.getElementById('add-edge-modal');
            const card = modal.querySelector('.relative');
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAddEdgeModal() {
            const modal = document.getElementById('add-edge-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function openEditEdgeModal(edge) {
            const modal = document.getElementById('edit-edge-modal');
            const card = modal.querySelector('.relative');
            
            document.getElementById('edit_edge_id').value = edge.id;
            document.getElementById('edit_edge_from_node').value = edge.from_node_id;
            document.getElementById('edit_edge_to_node').value = edge.to_node_id;
            document.getElementById('edit_edge_weight').value = edge.weight;
            document.getElementById('edit_edge_is_stairs').checked = !!edge.is_stairs;

            document.getElementById('edit-edge-form').action = `/admin/edges/${edge.id}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditEdgeModal() {
            const modal = document.getElementById('edit-edge-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function openDeleteEdgeModal(id) {
            const modal = document.getElementById('delete-edge-modal');
            const card = modal.querySelector('.relative');
            
            document.getElementById('delete-edge-id-display').textContent = id;
            document.getElementById('delete-edge-form').action = `/admin/edges/${id}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteEdgeModal() {
            const modal = document.getElementById('delete-edge-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // Close modals on backdrop click
        function initBackdropClosers() {
            const backdropMappings = [
                { id: 'add-node-modal', closer: closeAddNodeModal },
                { id: 'edit-node-modal', closer: closeEditNodeModal },
                { id: 'delete-node-modal', closer: closeDeleteNodeModal },
                { id: 'add-edge-modal', closer: closeAddEdgeModal },
                { id: 'edit-edge-modal', closer: closeEditEdgeModal },
                { id: 'delete-edge-modal', closer: closeDeleteEdgeModal }
            ];

            backdropMappings.forEach(mapping => {
                const modal = document.getElementById(mapping.id);
                if (modal) {
                    const backdrop = modal.querySelector('.fixed.inset-0');
                    if (backdrop) {
                        backdrop.addEventListener('click', mapping.closer);
                    }
                }
            });
        }

        // ======================================================
        // SIDEBAR TOGGLE
        // ======================================================
        function initSidebarToggle() {
            const sidebarBtn = document.getElementById('sideBar-btn');
            const sidebar = document.getElementById('sidebar');
            const sidebarBackdrop = document.getElementById('sidebar-backdrop');

            if (sidebarBtn && sidebar && sidebarBackdrop) {
                sidebarBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarBackdrop.classList.toggle('hidden');
                });

                sidebarBackdrop.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    sidebarBackdrop.classList.add('hidden');
                });
            }
        }

        // ======================================================
        // MAP INITIALIZATION AND GRAPH VISUALIZATION
        // ======================================================
        function initLeafletMap() {
            map = L.map('map', {
                crs: L.CRS.Simple,
                minZoom: -2,
                scrollWheelZoom: false,
                smoothWheelZoom: true,
                smoothSensitivity: 1,
            });

            bounds = [
                [0, 0],
                [1080, 1920]
            ];

            imageUrls = {
                1: '{{ asset('images/L1.png') }}',
                2: '{{ asset('images/L2-L4.png') }}',
                3: '{{ asset('images/L2-L4.png') }}',
                4: '{{ asset('images/L2-L4.png') }}',
                5: '{{ asset('images/L5.png') }}',
                6: '{{ asset('images/L6-L9.png') }}',
                7: '{{ asset('images/L6-L9.png') }}',
                8: '{{ asset('images/L6-L9.png') }}',
                9: '{{ asset('images/L6-L9.png') }}',
                10: '{{ asset('images/L10.png') }}'
            };

            image = L.imageOverlay(imageUrls[1], bounds).addTo(map);
            map.fitBounds(bounds);

            nodeLayer = L.layerGroup().addTo(map);
            nodeIdLayer = L.layerGroup().addTo(map);
            edgeLayer = L.layerGroup().addTo(map);
            weightLayer = L.layerGroup().addTo(map);

            initCoordinatesShow();
            visualizeGraph(1);
            initFloorButtons();
            initLayerToggles();
            drawGrid(10);
        }

        function initCoordinatesShow() {
            const coordsStatus = document.getElementById('coords-status');

            map.on('mousemove', function(e) {
                const lat = e.latlng.lat.toFixed(2);
                const lng = e.latlng.lng.toFixed(2);
                if (coordsStatus) {
                    coordsStatus.innerHTML = `Y: ${lat} | X: ${lng}`;
                }
            });

            map.on('click', function(e) {
                const lat = Math.round(e.latlng.lat);
                const lng = Math.round(e.latlng.lng);
                const coords = `${lat}, ${lng}`;

                navigator.clipboard.writeText(coords).then(() => {
                    if (coordsStatus) {
                        const originalText = coordsStatus.innerHTML;
                        coordsStatus.innerHTML = `<span class="text-green-700 font-extrabold">Tersalin: ${coords}!</span>`;
                        setTimeout(() => {
                            coordsStatus.innerHTML = originalText;
                        }, 1500);
                    }
                });
            });
        }

        function initLayerToggles() {
            const toggleNodeId = document.getElementById('toggle-node-id');
            const toggleEdgeWeight = document.getElementById('toggle-edge-weight');

            if (toggleNodeId) {
                toggleNodeId.addEventListener('change', function() {
                    if (this.checked) {
                        map.addLayer(nodeIdLayer);
                    } else {
                        map.removeLayer(nodeIdLayer);
                    }
                });
            }

            if (toggleEdgeWeight) {
                toggleEdgeWeight.addEventListener('change', function() {
                    if (this.checked) {
                        map.addLayer(weightLayer);
                    } else {
                        map.removeLayer(weightLayer);
                    }
                });
            }
        }

        async function visualizeGraph(floor) {
            try {
                const response = await fetch(`/api/graph-data?floor=${floor}`);
                const data = await response.json();

                nodeLayer.clearLayers();
                nodeIdLayer.clearLayers();
                edgeLayer.clearLayers();
                weightLayer.clearLayers();

                // EDGES
                data.edges.forEach(edge => {
                    if (edge.from_node && edge.to_node) {
                        const from = [edge.from_node.lat, edge.from_node.lng];
                        const to = [edge.to_node.lat, edge.to_node.lng];

                        L.polyline([from, to], {
                            color: edge.is_stairs ? '#d97706' : 'gray',
                            weight: edge.is_stairs ? 3 : 2,
                            dashArray: edge.is_stairs ? '0' : '5, 5'
                        }).addTo(edgeLayer);

                        const midpoint = [
                            (from[0] + to[0]) / 2,
                            (from[1] + to[1]) / 2
                        ];

                        L.marker(midpoint, {
                            icon: L.divIcon({
                                className: 'edge-weight-label',
                                html: `<span style="background:white;padding:2px 4px;border:1px solid #ccc;font-size:12px;border-radius:4px;font-weight:bold;">
                                    ${Math.round(edge.weight)}
                                </span>`,
                                iconSize: [30, 20]
                            }),
                            interactive: false
                        }).addTo(weightLayer);
                    }
                });

                // NODES
                data.nodes.forEach(node => {
                    L.circleMarker([node.lat, node.lng], {
                        radius: 6,
                        color: 'black',
                        fillColor: 'yellow',
                        fillOpacity: 1,
                        weight: 2
                    })
                    .bindTooltip(`ID: ${node.id} - ${node.name}`, { permanent: false, direction: 'top' })
                    .addTo(nodeLayer);

                    L.marker([node.lat - 12, node.lng], {
                        icon: L.divIcon({
                            className: 'node-id-label',
                            html: `<span style="background:rgba(255,255,255,0.85);color:red;padding:1px 3px;border:1px solid #aaa;font-size:11px;border-radius:3px;font-weight:bold;">${node.id}</span>`,
                            iconSize: [24, 16],
                            iconAnchor: [12, 0]
                        }),
                        interactive: false
                    }).addTo(nodeIdLayer);
                });
            } catch (e) {
                console.error("Error visualising graph:", e);
            }
        }

        function initFloorButtons() {
            document.querySelectorAll('#floor-btn button').forEach(button => {
                button.addEventListener('click', function() {
                    let floor = this.innerText.replace('L', '');

                    if (imageUrls[floor]) {
                        image.setUrl(imageUrls[floor]);
                        visualizeGraph(floor);
                    }

                    document.querySelectorAll('#floor-btn button').forEach(btn => {
                        btn.classList.remove('bg-stone-700', 'text-white');
                        btn.classList.add('bg-white', 'text-zinc-800');
                    });

                    this.classList.remove('bg-white', 'text-zinc-800');
                    this.classList.add('bg-stone-700', 'text-white');
                });
            });
        }

        function drawGrid(step) {
            const gridStyle = {
                color: '#000',
                weight: 1,
                opacity: 0.1,
                interactive: false
            };

            for (let y = 0; y <= bounds[1][0]; y += step) {
                L.polyline([
                    [y, 0],
                    [y, bounds[1][1]]
                ], gridStyle).addTo(map);
            }

            for (let x = 0; x <= bounds[1][1]; x += step) {
                L.polyline([
                    [0, x],
                    [bounds[1][0], x]
                ], gridStyle).addTo(map);
            }
        }

        // ======================================================
        // CLIENT-SIDE PAGINATION AND ENTRY LIMITS
        // ======================================================
        function initTablePagination() {
            paginateTable('node-table-body', 'node-limit-select', 'node-page-info', 'node-prev-btn', 'node-next-btn', 'node-pagination-controls');
            paginateTable('edge-table-body', 'edge-limit-select', 'edge-page-info', 'edge-prev-btn', 'edge-next-btn', 'edge-pagination-controls');
        }

        function paginateTable(tbodyId, limitSelectId, pageInfoId, prevBtnId, nextBtnId, controlsId) {
            const tbody = document.getElementById(tbodyId);
            if (!tbody) return;

            const limitSelect = document.getElementById(limitSelectId);
            const pageInfo = document.getElementById(pageInfoId);
            const prevBtn = document.getElementById(prevBtnId);
            const nextBtn = document.getElementById(nextBtnId);
            const controls = document.getElementById(controlsId);

            if (!limitSelect || !pageInfo || !prevBtn || !nextBtn || !controls) return;

            const allRows = Array.from(tbody.querySelectorAll('tr'));
            // Filter out 'no data' row
            const dataRows = allRows.filter(row => {
                const cells = row.querySelectorAll('td');
                return cells.length > 1 && !row.classList.contains('no-data-row');
            });

            if (dataRows.length === 0) {
                controls.classList.add('hidden');
                pageInfo.textContent = '';
                return;
            }

            let currentPage = 1;
            let limit = parseInt(limitSelect.value);

            function render() {
                const totalRows = dataRows.length;
                if (limit === -1) {
                    // Show all rows
                    dataRows.forEach(row => row.classList.remove('hidden'));
                    pageInfo.textContent = `Menampilkan semua (${totalRows}) data`;
                    controls.classList.add('hidden');
                    return;
                }

                controls.classList.remove('hidden');
                const totalPages = Math.ceil(totalRows / limit);
                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;

                const startIdx = (currentPage - 1) * limit;
                const endIdx = startIdx + limit;

                dataRows.forEach((row, idx) => {
                    if (idx >= startIdx && idx < endIdx) {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });

                const showingCount = Math.min(endIdx, totalRows);
                pageInfo.textContent = `Menampilkan ${startIdx + 1}-${showingCount} dari ${totalRows} data`;

                // Update navigation buttons status
                prevBtn.disabled = currentPage === 1;
                if (currentPage === 1) {
                    prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                nextBtn.disabled = currentPage === totalPages;
                if (currentPage === totalPages) {
                    nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }

            limitSelect.addEventListener('change', (e) => {
                limit = parseInt(e.target.value);
                currentPage = 1;
                render();
            });

            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    render();
                }
            });

            nextBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(dataRows.length / limit);
                if (currentPage < totalPages) {
                    currentPage++;
                    render();
                }
            });

            render();
        }
    </script>
</body>

</html>
