<?php

namespace App\Services;

use App\Models\Node;
use App\Models\Edge;
use SplPriorityQueue;

class NavigationService
{
    public function getShortestPath($startId, $endId)
    {
        // 1. Build the Graph from Database
        $nodes = Node::all();
        $edges = Edge::all();
        $graph = [];

        foreach ($edges as $edge) {
            $graph[$edge->from_node_id][$edge->to_node_id] = $edge->weight;
        }

        // 2. Initialize Dijkstra variables
        $distances = [];
        $previous = [];
        $queue = new SplPriorityQueue();

        foreach ($nodes as $node) {
            $distances[$node->id] = INF;
            $previous[$node->id] = null;
        }

        $distances[$startId] = 0;
        $queue->insert($startId, 0);

        // 3. The Core Algorithm
        while (!$queue->isEmpty()) {
            $u = $queue->extract();

            if ($u == $endId) break; // We found the target

            if (!isset($graph[$u])) continue;

            foreach ($graph[$u] as $neighbor => $weight) {
                $alt = $distances[$u] + $weight;
                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $u;
                    $queue->insert($neighbor, -$alt); // Priority queue is max-heap, so use negative
                }
            }
        }

        // 4. Reconstruct the Path
        return $this->reconstructPath($previous, $endId);
    }

    private function reconstructPath($previous, $endId)
    {
        $path = [];
        $current = $endId;
        while ($current !== null) {
            array_unshift($path, $current);
            $current = $previous[$current];
        }
        return $path;
    }
}