<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Floor Plan Map - Admin Dosen</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                            <a href="{{ route('admin.dosen.index') }}" class="block py-2 px-4 rounded-lg bg-white text-black font-bold">Dosen</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('admin.graph.index') }}" class="block py-2 px-4 rounded-lg hover:bg-zinc-600">Node dan Edge</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </sidebar>
        <!-- Sidebar Backdrop -->
        <div id="sidebar-backdrop" class="fixed inset-0 opacity-70 bg-black bg-opacity-50 z-40 hidden"></div>

        <main class="py-0 grow">
            <content>
                <!-- Dosen Card -->
                <div id="dosen-card"
                    class="grid grid-cols-1 items-center justify-center w-full rounded-xl px-15 py-15 my-0 ">
                    <div class="flex justify-between items-center mb-10 w-full">
                        <h1 class="text-4xl font-bold">Dosen</h1>
                        <button onclick="openAddModal()" class="bg-zinc-700 hover:bg-zinc-800 text-white font-bold py-3 px-6 rounded-xl transition cursor-pointer shadow-md flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 448 512">
                                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s-14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                            </svg>
                            Tambah Dosen
                        </button>
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

                    <div class="w-full flex flex-col gap-3 bg-gray-200 shadow-lg rounded-xl p-6">
                        <div>
                            <table class="w-full text-center border-collapse bg-white rounded-4xl overflow-hidden">
                                <thead>
                                    <tr>
                                        <th class="text-xl font-bold text-black p-4 border-r-4 border-b-4 border-black">Kode Dosen</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-r-4 border-black">Nama Dosen</th>
                                        <th class="text-xl font-bold text-black p-4 border-b-4 border-black">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lecturers as $lecturer)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300 font-semibold">{{ $lecturer->kode_dosen }}</td>
                                            <td class="p-4 border-r-2 border-b-2 border-gray-300">{{ $lecturer->nama_dosen }}</td>
                                            <td class="p-4 border-b-2 border-gray-300">
                                                <div class="flex gap-2 justify-center">
                                                    <button onclick="openEditModal({{ json_encode($lecturer) }})" class="bg-zinc-600 hover:bg-zinc-700 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition cursor-pointer">Edit</button>
                                                    <button onclick="openDeleteModal('{{ $lecturer->kode_dosen }}')" class="bg-zinc-600 hover:bg-zinc-700 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition cursor-pointer">Hapus</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-8 px-4 text-center text-zinc-500 italic">
                                                Tidak ada data dosen.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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

        <!-- Add Lecturer Modal -->
        <div id="add-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>

            <!-- Modal content card -->
            <div class="relative bg-white rounded-2xl max-w-lg w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Tambah Dosen</h3>
                    <button onclick="closeAddModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form action="{{ route('admin.dosen.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-4 text-sm font-semibold text-stone-700">
                        <div class="flex flex-col gap-2">
                            <label for="add_kode_dosen">Kode Dosen:</label>
                            <input type="text" id="add_kode_dosen" name="kode_dosen" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: D001">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="add_nama_dosen">Nama Dosen:</label>
                            <input type="text" id="add_nama_dosen" name="nama_dosen" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5" placeholder="Contoh: Dr. Eko Prasetyo">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAddModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Lecturer Modal -->
        <div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>

            <!-- Modal content card -->
            <div class="relative bg-white rounded-2xl max-w-lg w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-extrabold text-stone-900">Edit Dosen</h3>
                    <button onclick="closeEditModal()" class="text-stone-500 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-4 text-sm font-semibold text-stone-700">
                        <div class="flex flex-col gap-2">
                            <label for="edit_kode_dosen">Kode Dosen:</label>
                            <input type="text" id="edit_kode_dosen" disabled class="bg-gray-200 border border-gray-300 rounded-lg p-2.5 text-stone-500 cursor-not-allowed">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="edit_nama_dosen">Nama Dosen:</label>
                            <input type="text" id="edit_nama_dosen" name="nama_dosen" required class="bg-gray-50 border border-gray-300 rounded-lg p-2.5">
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeEditModal()" class="py-2.5 px-5 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="py-2.5 px-5 bg-stone-800 hover:bg-stone-700 text-white font-bold rounded-xl transition cursor-pointer">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Lecturer Confirmation Modal -->
        <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black/55 backdrop-blur-sm transition-opacity duration-300"></div>

            <!-- Modal content card -->
            <div class="relative bg-white rounded-2xl max-w-sm w-full mx-4 p-6 shadow-2xl border border-stone-200 transform scale-95 opacity-0 transition-all duration-300 ease-out flex flex-col items-center text-center z-10">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm128 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm128 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-extrabold text-stone-900 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-stone-600 leading-relaxed mb-6">Apakah Anda yakin ingin menghapus dosen <strong id="delete-item-code"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <form id="delete-form" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteModal()" class="w-1/2 py-3 bg-gray-300 hover:bg-gray-400 text-stone-800 font-bold rounded-xl transition cursor-pointer">Batal</button>
                        <button type="submit" class="w-1/2 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition cursor-pointer">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            initSidebarToggle();
        });

        // ======================================================
        // ADD MODAL ACTIONS
        // ======================================================
        function openAddModal() {
            const modal = document.getElementById('add-modal');
            const card = modal.querySelector('.relative');
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeAddModal() {
            const modal = document.getElementById('add-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // ======================================================
        // EDIT MODAL ACTIONS
        // ======================================================
        function openEditModal(lecturer) {
            const modal = document.getElementById('edit-modal');
            const card = modal.querySelector('.relative');
            
            // Populate fields
            document.getElementById('edit_kode_dosen').value = lecturer.kode_dosen;
            document.getElementById('edit_nama_dosen').value = lecturer.nama_dosen;

            // Set action URL dynamically
            document.getElementById('edit-form').action = `/admin/dosen/${lecturer.kode_dosen}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // ======================================================
        // DELETE MODAL ACTIONS
        // ======================================================
        function openDeleteModal(kode_dosen) {
            const modal = document.getElementById('delete-modal');
            const card = modal.querySelector('.relative');
            
            document.getElementById('delete-item-code').textContent = kode_dosen;
            document.getElementById('delete-form').action = `/admin/dosen/${kode_dosen}`;

            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            const card = modal.querySelector('.relative');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // Close modals on backdrop click
        document.addEventListener('DOMContentLoaded', () => {
            ['add-modal', 'edit-modal', 'delete-modal'].forEach(id => {
                const modal = document.getElementById(id);
                if (modal) {
                    const backdrop = modal.querySelector('.fixed.inset-0');
                    if (backdrop) {
                        backdrop.addEventListener('click', () => {
                            if (id === 'add-modal') closeAddModal();
                            else if (id === 'edit-modal') closeEditModal();
                            else if (id === 'delete-modal') closeDeleteModal();
                        });
                    }
                }
            });
        });

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
    </script>
</body>

</html>
