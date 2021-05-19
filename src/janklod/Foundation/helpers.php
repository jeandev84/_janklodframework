<?php

function env($key, $default = null){
     return getenv($key) ?? $default;
}

function app()
{
    return 'app:run';
}