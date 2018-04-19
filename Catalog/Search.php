<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 19.04.2018
 * Time: 16:42
 */
include_once '../../courses/Database.php';
include_once 'ProductSearch.php';

class Search
{

    CONST COUNT_ON_PAGE = 8;

    protected $cond = [];
    protected $params = [];
    protected $with_limit = true;
    protected $having_request_test;
    protected $limit_offset_request_test;
    protected $query_text;
    protected $cond_text;


    public function ExecuteSearch()
    {
        $Database = new Database($this->query_text, $this->params);
        $Database->ExecuteRequest();
        return $Database->GetResult();

    }

    protected function CountLimitOffset(){

        if (empty($_GET['p'])){
            $offset = 0;
        }else{
            $start_element = ($_GET['p']-1)*self::COUNT_ON_PAGE;
            $offset = $_GET['p']==1?0:$start_element;
        }

        $limit_offset_request_test = ' LIMIT '.self::COUNT_ON_PAGE.' OFFSET '.$offset;
        return $limit_offset_request_test;
    }


}

if ($_SERVER['REQUEST_METHOD']=='GET'){
    include_once 'renderSearchResult.php';
    $ProdSearch = new ProductSearch();
    $result = $ProdSearch->ExecuteSearch();
    echo renderSearchResult($result);
}