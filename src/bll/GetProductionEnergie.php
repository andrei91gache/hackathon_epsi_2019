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
        $res  = $cnx->query("SELECT quantite_produite, date_add FROM production_solaire  ORDER BY date_add DESC LIMIT 7")->fetchAll();
        return $res;
    }
}