<?php

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * Make factory function
 *
 * @param collection $class
 * @param array $attributes
 * @param int $times
 * @return void
 */
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}