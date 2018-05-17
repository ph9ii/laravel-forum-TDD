<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    /**
     * ThreadFilters Constructor
     * 
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        if($this->request->has('by')) {
            return $this->by($this->request->by);
        }

        return $this->builder;

        // if(! $username = $this->request->by) return $builder;

        // return $this->by($username);
        
    }
}