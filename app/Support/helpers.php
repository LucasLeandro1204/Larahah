<?php

if (! function_exists('user')) {
    /**
     * Return user authenticated.
     */
    function user()
    {
        return auth()->user();
    }
}

if (! function_exists('filter_keys')) {
    /**
     * Filter an array and return the keys.
     */
    function filter_keys(array $data): array
    {
        return array_keys(array_filter($data));
    }
}
