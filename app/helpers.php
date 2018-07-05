<?php

use App\Models\Unit;

function unit_type_human($type)
{
    $types = [
        'ad' => 'Ad',
        'page' => 'Landing Page'
    ];

    return $types[$type];
}

function unit_next_section($type, $sectionSlug)
{
    $availableSections = Unit::$sections[$type];
    $currentSection = array_first($availableSections, function($section) use($sectionSlug) {
        return $section['slug'] == $sectionSlug;
    });

    if(! isset($availableSections[$currentSection['order']])) return null;

    return $availableSections[$currentSection['order']];
}

function absolute_to_relative_url($url)
{
    return str_replace(url()->to('/') . '/', '', $url);
}

function align_to_flex_rule($align)
{
    if($align == 'center' || $align == 'middle') return 'center';
    
    if($align == 'right' || $align == 'bottom') return 'flex-end';
    
    return 'flex-start';
}
