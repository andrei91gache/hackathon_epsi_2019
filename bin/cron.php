<?php
/**
 * Created by PhpStorm.
 * Filename: cron.php
 * User: Andrei Gache
 * Email: andrei.gache.99@gmail.com
 * Website: https://www.andrei-gache.com/
 * Date: 27/04/19
 * Time: 11:41
 */

require __DIR__.'/../vendor/autoload.php';

$file_parser = new \HackathonEpsi\src\bll\FileParser();
//Download file from Meteo
$file_parser->httpRequestGetJsonFromAPIMeteo();
try{
    $file_parser->parseArrayAndSave();
}catch (Exception $exception){
    print $exception->getMessage();
}
$file_parser->httpRequestGetFileFromRTE();
