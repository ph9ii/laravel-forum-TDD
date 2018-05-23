<?php

namespace App\Traits;

use App\Favorite;

trait Favoritable
{
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if(! $this->favorites()->where($attributes)->exists()) {
            \Session::flash('success', 'You favourited this reply successfully');
            return $this->favorites()->create($attributes);
        } else {
            \Session::flash('error', 'You already favorited this once.');
        }
    }

    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * Favorties count
     *
     * @return void
     */
    public function getFavoritresCountAttribute()
    {
        return $this->favorites->count();
    }
}