<?php
/**
 * Created by PhpStorm.
 * Filename: FileParser.php
 * User: Andrei Gache
 * Email: andrei.gache.99@gmail.com
 * Website: https://www.andrei-gache.com/
 * Date: 27/04/19
 * Time: 11:26
 */

namespace HackathonEpsi\src\bll;

require __DIR__.'/../../config/.config.inc.php';

use GuzzleHttp\Client;
use HackathonEpsi\src\dal\ConnectionDB;

class FileParser
{
    private $data_from_meteo;
    private $data_from_rte;


    public function httpRequestGetFileFromRTE()
    {
        $path = __DIR__.'/../files/zip/' . "data.zip";
        $file_path = fopen($path,'w');
        $client = new Client();
        $client->get(ENERGY_RTE_PAYS_DE_LA_LOIRE, ['save_to' => $file_path]);
        $this->unzipAndParseFile();
    }

    public function httpRequestGetJsonFromAPIMeteo()
    {
        $client = new Client();
        $response  = $client->get(METEO_API_NANTES);
        $this->data_from_meteo =  json_decode($response->getBody()->getContents(), true);

    }

    /**
     * @throws \Exception
     */
    public function parseArrayAndSave()
    {
        if (!empty($this->data_from_meteo) && count($this->data_from_meteo) > 0){
            $cnx = new ConnectionDB();
            foreach ($this->data_from_meteo as $key => $item){
                if (is_array($item)){
                    $this->saveIntoMeteoTable($cnx, [
                        $item['nebulosite']['totale'],
                        $key
                    ]);
                }
            }

        }else{
            throw new \Exception('No data from meteo');
        }
    }

    private function saveIntoMeteoTable(ConnectionDB $connectionDB, $data){
        $db = $connectionDB->getConnection();
        $stmt =  $db->prepare("INSERT INTO meteo (nebulosite_totale, date_add) VALUES (:nebulosite_totale, :date_add)");
        $stmt->bindParam(':nebulosite_totale', $data[0]);
        $stmt->bindParam(':date_add', $data[1]);
        $stmt->execute();
    }

    private function unzipAndParseFile()
    {
        $zip = new \ZipArchive();
        if ($zip->open(__DIR__.'/../files/zip/data.zip') === TRUE) {
            $zip->extractTo(__DIR__.'/../files/excel/');
            $zip->close();
            unlink(__DIR__.'/../files/zip/data.zip');
            $this->parseExcelFileAndSave(__DIR__.'/../files/excel/');
        } else {
            echo 'échec';
        }
    }

    /**
     * @param $dir
     * @throws \Exception
     */
    private function parseExcelFileAndSave($dir)
    {
        $handle = opendir($dir);
        $file = "";
        while (false !== ($entry = readdir($handle))) {
            if ($entry !== "." && $entry !== '..'){
               $file =  $dir.$entry;
            }

        }
        closedir($handle);
        try{
            $this->data_from_rte = \PhpOffice\PhpSpreadsheet\IOFactory::load($file)->getActiveSheet()->toArray(null, true, true, true);
            //unlink($file);
        }catch (\Exception $ex){
            print $ex->getMessage();
        }

        if (!empty($this->data_from_rte) && count($this->data_from_rte) > 0){
            $cnx = new ConnectionDB();
            $datas = array_slice($this->data_from_rte, 1);
            foreach ($datas as $key => $item){

                    $this->saveIntoProductionSolaireTable($cnx, [
                        $item['I'],
                        $item['C'].' '.$item['D'],
                    ]);

            }

        }else{
            throw new \Exception('No data from meteo');
        }
    }

    private function saveIntoProductionSolaireTable(ConnectionDB $connectionDB, $data)
    {
        $db = $connectionDB->getConnection();
        $stmt =  $db->prepare("INSERT INTO production_solaire (quantite_produite, date_add) VALUES (:quantite_produite, :date_add)");
        $stmt->bindParam(':quantite_produite', $data[0]);
        $stmt->bindParam(':date_add', $data[1]);
        $stmt->execute();
    }
}