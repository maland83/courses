<?php
/**
 * Created by PhpStorm.
 * User: medias
 * Date: 17.04.2018
 * Time: 11:42
 */


class Database
{
//**************************************************************************************
    private $mysqli_conn;
    private $mysqli_stmt;

    protected $db_parameters;

    private $RequestText;
    private $RequestParameters;

    private $Response;
//**************************************************************************************

//**************************************************************************************
    public function __construct($requestText, array $requestParameters = [])
    {
        $this->RequestText = $requestText;
        $this->RequestParameters = $requestParameters;

        if (empty($mysqli_conn)) {
            $this->GetBDParameters();
            $this->MakeConnect();
        }
    }

    private function GetBDParameters()
    {
        require_once 'settings.php';
        $this->db_parameters = getProjectSettings();
    }

    private function MakeConnect(){

        $this->mysqli_conn = new mysqli($this->db_parameters['host'],
                                         $this->db_parameters['user'],
                                         $this->db_parameters['pass'],
                                         $this->db_parameters['db_name'],
                                         $this->db_parameters['port']);
        return $this->mysqli_conn;
    }

    public function ExecuteRequest(){

        $this->mysqli_stmt = $this->mysqli_conn->prepare($this->RequestText);

        if (!empty($this->RequestParameters)){
            $this->bind_params();
        }

        $this->mysqli_stmt->execute();
        $result = $this->mysqli_stmt->get_result();

        if ($this->mysqli_stmt->insert_id != 0){
            $this->Response = $this->mysqli_stmt->insert_id;
            return true;
        }

        if (strstr(strtoupper($this->RequestText), 'UPDATE')){
            $this->Response = $this->mysqli_stmt->affected_rows;
            return true;
        }

        $response_array = [];

        while ($row = $result->fetch_assoc()){
            $response_array[] = $row;
        };
        $this->Response = $response_array;
    }

    private function bind_params()
    {
        $param_type = '';
        $params = $this->RequestParameters;
        $mysqli_stmt = $this->mysqli_stmt;

        foreach ($params as $_param) {
            if ((int)$_param != 0) {
                $param_type .= 'd';
            } else
                $param_type .= 's';
        }

        $a_param[] = &$param_type;

        $n = count($params);
        for ($i = 0; $i < $n; $i++) {
            $a_param[] = &$params[$i];
        }

        call_user_func_array(array($mysqli_stmt, 'bind_param'), $a_param);
    }

    public function GetResult(){
        return $this->Response;
    }
}
//**************************************************************************************