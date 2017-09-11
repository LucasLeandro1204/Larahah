<?php

use JWTAuth;

function dispatchInSequence(array $jobs, $data)
{
    return array_reduce($jobs, function ($data, $job) {
        return dispatch_now(new $job($data));
    }, $data);
}

function user()
{
    return JWTAuth::parseToken()->authenticate();
}
