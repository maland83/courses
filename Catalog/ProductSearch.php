<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 19.04.2018
 * Time: 21:10
 */

include_once 'Search.php';
class ProductSearch extends Search{


    public function __construct()
    {
        $this->SearchProduct();
    }

    public function SearchProduct()
    {
        if (!empty($_GET['search_string'])) {
            $this->cond[] = ' prod.name LIKE ? ';
            $this->params[] = '%' . $_GET['search_string'] . '%';
        }
        if (!empty($_GET['product_type']) && $_GET['product_type'] != 'all') {
            $this->cond[] = ' prod.type = ? ';
            $this->params[] = $_GET['product_type'];
        }

        $this->having_request_test = '';

        if (!empty($_GET['only_popular'])) {
            $this->having_request_test = ' HAVING counts > 1';
        }

        $this->limit_offset_request_test = '';

        if ($this->with_limit) {
            $this->limit_offset_request_test = $this->CountLimitOffset();
        }

 /*       $this->query_text = 'SELECT prod.name, prod.description,
                               COUNT(orders.id) AS counts,
                               max(prod.id)  AS prod_id
                               FROM products AS prod
                               LEFT JOIN
                               orders AS orders ON orders.product_id = prod.id';*/


        $this->query_text = 'SELECT prod.name
                                   ,prod.description as description
                                   ,max(prod.id) AS prod_id
                                   ,prod.price
                                   ,prod.type 
                               FROM products AS prod';

        $this->cond_text = '';

        if (count($this->cond)) {
            $this->cond_text = implode(' AND ', $this->cond);
            $this->cond_text = ' WHERE ' . $this->cond_text;
        }

        $this->query_text .= $this->cond_text;
        $this->query_text .= ' GROUP BY prod.id ';
        //$this->query_text .= $this->having_request_test;
        $this->query_text .= $this->limit_offset_request_test;
    }

}