<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'massage','sender_id','reciver_id'
    ];

    protected $cast = [
        'sender_id' => 'integer',
        'reciver_id' => 'integer',
    ];

    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->sender_id == Auth::id();
        });
    }

    /**
     * Get all of the chatFils for the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatFils(): HasMany
    {
        return $this->hasMany(ChatFile::class);
    }

    /**
     * Get the sender that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'sender_id', 'id');
    }

    /**
     * Get the reciver that owns the Chat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reciver(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'reciver_id', 'id');
    }
}
