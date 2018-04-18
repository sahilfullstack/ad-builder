<?php

function unit_type_human($type)
{
    $types = [
        'ad' => 'Ad',
        'page' => 'Landing Page'
    ];

    return $types[$type];
}