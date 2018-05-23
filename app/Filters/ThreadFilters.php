<?php

namespace App\Filters;

use App\User;
use App\Thread;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular'];

    /**
     *  Filter the query by a given username.
     * 
     * @param string $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
            
        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Filter query according to most popular threads
     *
     * @return void
     */
    protected function popular()
    {
        // Clear any other order by that already been set
        $this->builder->getQuery()->orders = [];
        
        return $this->builder->orderBy('replies_count', 'desc');
    }
}