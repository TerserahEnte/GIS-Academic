<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-4 min-h-screen flex items-center justify-center">
    @php
        // Fetch all nodes and order them nicely for the dropdown
        $nodes = \App\Models\Node::orderBy('floor')->orderBy('name')->get();
    @endphp

    <div class="w-full max-w-xl bg-white p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Cari Rute Ruangan</h1>

        <!-- Navigation Form -->
        <form action="{{ route('denah') }}" method="GET" class="flex flex-col gap-4">
            <div>
                <label for="start-node" class="block text-sm font-semibold text-gray-700">Titik Awal</label>
                <select id="start-node" name="start" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Pilih Titik Awal...</option>
                    @foreach($nodes as $node)
                        <option value="{{ $node->id }}">{{ $node->name }} (Lantai {{ $node->floor }})</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="end-node" class="block text-sm font-semibold text-gray-700">Titik Akhir</label>
                <select id="end-node" name="end" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border p-2 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Pilih Titik Akhir...</option>
                    @foreach($nodes as $node)
                        <option value="{{ $node->id }}">{{ $node->name }} (Lantai {{ $node->floor }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-stone-700 hover:bg-stone-800 text-white font-bold py-3 px-4 rounded-lg transition mt-4">
                Mulai Navigasi
            </button>
        </form>
    </div>
</body>
</html>