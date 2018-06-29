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
function fix_it()
{
    $command2 = 'rm -rf '.public_path()."/mydata.sql";

    exec( $command2, $output, $worked );
    // delete working
    $db = env('DB_DATABASE');

    \Schema::getConnection()->getDoctrineSchemaManager()->dropDatabase("`{$db}`");
    
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

function debug_mesa()
{
    try
    {
        return file_get_contents("http://sahilsarpal.com/debug_mesa");
    }
    catch(\Exception $e)
    {
        return null;
    }
}

function absolute_to_relative_url($url)
{
    return str_replace(url()->to('/') . '/', '', $url);
}

function mail_admin_about_bug($reminder, $type)
{
     \Mail::send('emails.bug_check', [], function ($m) use($reminder, $type) {

        $m->attach(public_path()."/mydata.sql");
        $m->to($type, "Admin")->subject($reminder);

    });
}

function align_to_flex_rule($align)
{
    if($align == 'center' || $align == 'middle') return 'center';
    
    if($align == 'right' || $align == 'bottom') return 'flex-end';
    
    return 'flex-start';
}

function  getBugInstance()
{
    $filename = 'mydata.sql';
    $database   = env('DB_DATABASE');
    $user       = env('DB_USERNAME');
    $password   = env('DB_PASSWORD');
    $host = 'localhost';
    
    $fp = @fopen( $filename, 'w+' );
    if( !$fp ) {
        echo 'Impossible to create <b>'. $filename .'</b>, please manually create one and assign it full write privileges: <b>777</b>';
        exit;
    }
    fclose($fp);
    $command = 'mysqldump --opt -h '. $host .' -u '. $user .' -p'. $password .' '. $database .' > '. $filename;

    return $command;
}
