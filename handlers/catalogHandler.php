<?php 
    //echo 'Привет';
    include ($_SERVER['DOCUMENT_ROOT'] .'/php/connect.php');
    
    $cat = $_GET['id'];

//ищем дочерние категории на основании переданной родительской категории
    $query = "SELECT * FROM `categories` WHERE `parent_category` = $cat";
    $result = mysqli_query($db,$query);

    $allCategoriesId = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // 1. идентификаторы каждой строчки помещаем в массив
        array_push($allCategoriesId, $row['id']);
        // 2. превращаем массив в строку
        
    }

    // explode() - строчку текста в массив
    // implode() -  массив в текст
    $catsLine = implode(',',$allCategoriesId);

    // ищем товары, соответствующие категориям

    
    $query = "SELECT * FROM `catalog` WHERE `category_id` IN ($catsLine)";
    
    $goods = mysqli_query($db, $query);  

    //echo mysqli_num_rows($goods);

    $goods_array = [];

    while ( $row = mysqli_fetch_assoc($goods) ) {
       array_push( $goods_array, $row);
    }
    
    //JSON 

    //print_r( $goods_array );


    echo json_encode($goods_array);








    //echo '<pre>';
    //print_r($goods_array);
    //echo '</pre>';






?>

