<?php
/**
 * Created by PhpStorm.
 * Filename: getProduction.php
 * User: Andrei Gache
 * Email: andrei.gache.99@gmail.com
 * Website: https://www.andrei-gache.com/
 * Date: 27/04/19
 * Time: 17:23
 */

require __DIR__.'/../vendor/autoload.php';

$production = new \HackathonEpsi\src\bll\GetProductionEnergie();
echo json_encode(array_reverse($production->read()));