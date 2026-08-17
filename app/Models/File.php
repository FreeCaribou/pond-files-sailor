<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class File extends Model
{
    /** @use HasFactory<\Database\Factories\SavedObjectPropFactory> */
    use HasFactory;

    use HasUuids;

    protected $fillable = ['name', 'description', 'path', 'size', 'mime_type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}