<?php
function connect(){
    $mysqli= new mysqli("localhost","root","","magazin");
    if($mysqli->connect_errno!=0){
        return $mysqli->connect_error;
    }else{
        return $mysqli;
    }
}

function getAllProducts(){
    $mysqli=connect();
    $res=$mysqli->query("SELECT * FROM products ORDER BY RAND() ");
    while($row=$res->fetch_assoc()){
        $products[]=$row;
    }
    return $products;
}

function getProductsByCategory($category){
    $mysqli=connect();
    $res=$mysqli->query("SELECT * FROM products WHERE category = '$category'");
    while($row=$res->fetch_assoc()){
        $products[] = $row;
    }
    return $products;

}