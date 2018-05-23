<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    // protected $guarded = [];
    
    protected $fillable = [
        'user_id', 'channel_id', 'title', 'body', 
    ];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        // static::addGlobalScope('creator', function ($builder) {
        //     $builder->with('creator');
        // });
    }

    public function path()
    {
        // return route('threads.show', ['channel' => $this->channel->id, 'thread' => $this->id]);
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
        return $this->hasMany(Reply::class)
                ->withCount('favorites')
                ->with('owner');
    }

    /**
     * Creat reply function
     *
     * @param array $reply
     * @return void
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    /**
     * Filter Scope
     *
     * @param string $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
