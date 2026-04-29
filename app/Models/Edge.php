<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Edge extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'from_node_id',
        'to_node_id',
        'weight',
        'is_stairs',
    ];

    protected $casts = [
        'is_stairs' => 'boolean',
    ];

    public function fromNode(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'from_node_id');
    }

    public function toNode(): BelongsTo
    {
        return $this->belongsTo(Node::class, 'to_node_id');
    }
}