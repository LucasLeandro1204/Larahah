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

if (! function_exists('array_get_d')) {
    /**
     * Get array value with default array value.
     */
    function array_get_d(array $data, $key, $defaultKey): array
    {
        return array_get($data, $key, array_get($data, $defaultKey));
    }
}
