<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminGraphController extends Controller
{
    /**
     * Display a listing of the nodes and edges.
     */
    public function index()
    {
        $nodes = DB::table('nodes')
            ->orderBy('id', 'asc')
            ->get();

        $edges = DB::table('edges')
            ->join('nodes as from_node', 'edges.from_node_id', '=', 'from_node.id')
            ->join('nodes as to_node', 'edges.to_node_id', '=', 'to_node.id')
            ->select(
                'edges.*',
                'from_node.name as from_node_name',
                'from_node.floor as from_node_floor',
                'to_node.name as to_node_name',
                'to_node.floor as to_node_floor'
            )
            ->orderBy('edges.id', 'asc')
            ->get();

        return view('admin.graph', compact('nodes', 'edges'));
    }

    /**
     * Store a newly created node.
     */
    public function storeNode(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'floor' => ['required', 'integer'],
            'lat' => ['required', 'integer'],
            'lng' => ['required', 'integer'],
        ]);

        DB::table('nodes')->insert($validated);

        return redirect()->route('admin.graph.index')->with('success', 'Node berhasil ditambahkan!');
    }

    /**
     * Update the specified node.
     */
    public function updateNode(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'floor' => ['required', 'integer'],
            'lat' => ['required', 'integer'],
            'lng' => ['required', 'integer'],
        ]);

        DB::table('nodes')
            ->where('id', $id)
            ->update($validated);

        return redirect()->route('admin.graph.index')->with('success', 'Node berhasil diperbarui!');
    }

    /**
     * Remove the specified node.
     */
    public function destroyNode($id)
    {
        DB::table('nodes')->where('id', $id)->delete();

        return redirect()->route('admin.graph.index')->with('success', 'Node berhasil dihapus!');
    }

    /**
     * Store a newly created edge.
     */
    public function storeEdge(Request $request)
    {
        $validated = $request->validate([
            'from_node_id' => ['required', 'integer', 'exists:nodes,id'],
            'to_node_id' => ['required', 'integer', 'exists:nodes,id', 'different:from_node_id'],
            'weight' => ['required', 'integer', 'min:0'],
            'is_stairs' => ['nullable', 'boolean'],
        ]);

        // Default stairs to false if not set
        $validated['is_stairs'] = $request->has('is_stairs') ? (bool)$request->input('is_stairs') : false;

        DB::table('edges')->insert($validated);

        return redirect()->route('admin.graph.index')->with('success', 'Edge berhasil ditambahkan!');
    }

    /**
     * Update the specified edge.
     */
    public function updateEdge(Request $request, $id)
    {
        $validated = $request->validate([
            'from_node_id' => ['required', 'integer', 'exists:nodes,id'],
            'to_node_id' => ['required', 'integer', 'exists:nodes,id', 'different:from_node_id'],
            'weight' => ['required', 'integer', 'min:0'],
            'is_stairs' => ['nullable', 'boolean'],
        ]);

        $validated['is_stairs'] = $request->has('is_stairs') ? (bool)$request->input('is_stairs') : false;

        DB::table('edges')
            ->where('id', $id)
            ->update($validated);

        return redirect()->route('admin.graph.index')->with('success', 'Edge berhasil diperbarui!');
    }

    /**
     * Remove the specified edge.
     */
    public function destroyEdge($id)
    {
        DB::table('edges')->where('id', $id)->delete();

        return redirect()->route('admin.graph.index')->with('success', 'Edge berhasil dihapus!');
    }
}
