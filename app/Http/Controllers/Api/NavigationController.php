<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Edge;
use App\Models\Node;
use App\Services\NavigationService;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function findPath(Request $request, NavigationService $service)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        // Calculate the IDs
        // $pathIds = $service->getShortestPath($start, $end);
        $result = $service->getShortestPath($start, $end);
        $pathIds = $result['path'];

        // Fetch full node data (with X/Y coords) in the correct order
        $nodes = Node::whereIn('id', $pathIds)
            ->orderByRaw('FIELD(id, '.implode(',', $pathIds).')')
            ->get();

        return response()->json($nodes);
    }

    // Hasil algoritma dijkstra berseta waktu penyelasai algoritma selesai dan total distance
    public function findPathDebug(Request $request, NavigationService $service)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        // Jalankan algoritma
        $result = $service->getShortestPath($start, $end);

        // Ambil ID node dari hasil algoritma
        $pathIds = $result['path'];

        // Jika tidak ada jalur
        if (empty($pathIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Path not found.',
                'path' => [],
                'distance' => null,
                'execution_time' => $result['execution_time'],
            ]);
        }

        // Ambil data node sesuai urutan path
        $nodes = Node::whereIn('id', $pathIds)
            ->orderByRaw('FIELD(id,'.implode(',', $pathIds).')')
            ->get();

        return response()->json([
            'success' => true,
            'start_node' => $start,
            'end_node' => $end,
            'total_nodes' => count($pathIds),
            'distance' => $result['distance'],
            'execution_time' => round($result['execution_time'] * 1000, 3), // ms
            'path' => $nodes,
        ]);
    }

    // In your NavigationController.php
    public function getGraphData(Request $request)
    {
        $floor = $request->query('floor', 1);

        return response()->json([
            'nodes' => Node::where('floor', $floor)->get(),
            'edges' => Edge::whereHas('fromNode', function ($q) use ($floor) {
                $q->where('floor', $floor);
            })->with(['fromNode', 'toNode'])->get(),
        ]);
    }

    // Tambahkan method ini untuk mengambil seluruh data node
    public function getAllNodes()
    {
        return response()->json(Node::all());
    }
}
