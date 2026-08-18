<?php

namespace App\Models;

use Database\Factories\SavedObjectPropFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    /** @use HasFactory<SavedObjectPropFactory> */
    use HasFactory;

    use HasUuids;

    protected $fillable = ['name', 'description', 'path', 'size', 'mime_type', 'user_id', 'folder_id', 'type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }
}
