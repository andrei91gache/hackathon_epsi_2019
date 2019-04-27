<?php
/**
 * Created by PhpStorm.
 * Filename: GetProductionEnergie.php
 * User: Andrei Gache
 * Email: andrei.gache.99@gmail.com
 * Website: https://www.andrei-gache.com/
 * Date: 27/04/19
 * Time: 17:28
 */

namespace HackathonEpsi\src\bll;

require __DIR__.'/../../config/.config.inc.php';

use HackathonEpsi\src\dal\ConnectionDB;

class GetProductionEnergie
{

    public function read()
    {
        $db = new ConnectionDB();
        $cnx = $db->getConnection();
        $res  = $cnx->query("SELECT quantite_produite, date_time FROM production_solaire  ORDER BY date_time DESC LIMIT 192")->fetchAll();
        return $res;
    }
    public function readPrev()
    {
        $db = new ConnectionDB();
        $cnx = $db->getConnection();
        $res  = $cnx->query("SELECT AVG(prev_prod) as prev_prod , date_simple FROM meteo GROUP BY date_simple ORDER BY date_simple ASC LIMIT 7")->fetchAll();
        return $res;
    }

    public function getMaxAvgProduction()
    {
        $db = new ConnectionDB();
        $cnx = $db->getConnection();
        $res  = $cnx->query("SELECT AVG(quantite_produite) as moyenne_prod, date_simple FROM production_solaire GROUP BY date_simple ORDER BY AVG(quantite_produite) DESC LIMIT 1")->fetchAll();
        return $res;
    }

    public function getMeteoPrevision()
    {
        $db = new ConnectionDB();
        $cnx = $db->getConnection();
        $res  = $cnx->query("SELECT AVG(nebulosite_totale) as moyenne_neb, date_simple FROM meteo GROUP BY date_simple LIMIT 7")->fetchAll();
        return $res;
    }

    public function updatePrevMeteoProd($data)
    {

        $db = new ConnectionDB();
        $cnx = $db->getConnection();
        $stmt =  $cnx->prepare("UPDATE meteo SET prev_prod =? WHERE date_simple =?");
        $s = $stmt->execute([$data['prev_prod'], $data['date_simple']]);
    }
}