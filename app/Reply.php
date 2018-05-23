<?php

namespace App;

use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Reply extends Model
{
    use Favoritable;
    
    protected $fillable = [
        'body', 'user_id', 'thread_id',
    ];

    protected $with = [
        'owner',
        'favorites'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
