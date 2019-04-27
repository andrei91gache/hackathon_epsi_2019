<?php
/**
 * Created by PhpStorm.
 * Filename: calc_prevision.php
 * User: Andrei Gache
 * Email: andrei.gache.99@gmail.com
 * Website: https://www.andrei-gache.com/
 * Date: 27/04/19
 * Time: 20:53
 */

require __DIR__.'/../vendor/autoload.php';

$production = new \HackathonEpsi\src\bll\GetProductionEnergie();

$moyenne_production_max = $production->getMaxAvgProduction();

$previsions_jours = $production->getMeteoPrevision();

$jours_with_prev = [];
foreach ($previsions_jours as $jour){

    $production_moyenne_prevu = bcmul($moyenne_production_max[0]['moyenne_prod'], '1', 2)/$jour['moyenne_neb'];
    $jour['prev_prod'] = $production_moyenne_prevu;
    $production->updatePrevMeteoProd($jour);
}

