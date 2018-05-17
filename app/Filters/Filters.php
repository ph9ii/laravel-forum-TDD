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
     * Apply request by query
     * 
     * @param mixed $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        if($this->request->has('by')) {
            return $this->by($this->request->by);
        }

        return $this->builder;
    }
}