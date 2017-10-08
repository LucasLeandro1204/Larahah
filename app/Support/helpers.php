<?php

function dispatchInSequence(array $jobs, $data)
{
    return array_reduce($jobs, function ($data, $job) {
        return dispatch_now(new $job($data));
    }, $data);
}

function user()
{
    return auth()->user();
}

if (! function_exists('filter_keys')) {
    /**
     * Filter an array and return the keys.
     *
     */
    function filter_keys(array $data)
    {
        return array_keys(array_filter($data));
    }
}
