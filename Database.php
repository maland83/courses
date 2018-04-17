<?php
/**
 * Created by PhpStorm.
 * User: medias
 * Date: 17.04.2018
 * Time: 11:42
 */


class Database
{

    private $mysqli_conn;
    protected $db_parameters;

    private $RequestText;
    private $RequestParameters;


    public function __construct($requestText, $requestParameters)
    {
        $this->GetBDParameters();
        $this->MakeConnect();
        //$this->SetProperties($requestText, $requestParameters);

    }

//    private function SetProperties($requestText, $requestParameters){
//        $this->RequestText       = $requestText;
//        $this->RequestParameters = $requestParameters;
//
//    }
    public function ExecuteRequest(){

    }

    private function MakeConnect(){

        $this->mysqli_conn = new mysqli($this->db_parameters['host'],
                                         $this->db_parameters['user'],
                                         $this->db_parameters['pass'],
                                         $this->db_parameters['db_name'],
                                         $this->db_parameters['port']);
        return $this->mysqli_conn;
    }

    private function GetBDParameters()
    {
        require 'settings.php';
        $this->db_parameters = getProjectSettings();
    }

}