<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    // protected $guarded = [];
    
    protected $fillable = [
        'user_id', 'channel_id', 'title', 'body', 
    ];

    public function path()
    {
        // return route('threads.show', ['thread' => $this->id]);
        return "threads/{$this->channel->slug}/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}
