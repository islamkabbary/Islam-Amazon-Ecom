<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id','path'
    ];

    protected $cast = [
        'chat_id' => 'integer',
    ];

    protected $appends = [
        'full_path'
    ];

    public function getFullPathAttribute ()
    {
        return URL::to('/') . "/" . $this->path ;
    }
    /**
     * Get the chat that owns the ChatFile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
