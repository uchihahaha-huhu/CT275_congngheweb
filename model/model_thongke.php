<?php 
function numRowTable($table){
    $sql = "SELECT * FROM $table ";
    $result = pdo_query($sql);
    $num = 0;
    foreach ($result as $item){
        $num++;
    }
    return $num;
}
function revenue(){
    $sql = "SELECT SUM(bills.bill_total) AS revenue FROM bills";
    $result = pdo_query_one($sql);
    return $result;
}
function statis(){
    $sql = "SELECT DATE(bill_time) AS order_date, COUNT(*) AS total_orders 
    FROM bills 
    WHERE bill_time >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
    AND bill_time <= CURDATE()
    GROUP BY DATE(bill_time);";
    $result = pdo_query($sql);
    return $result;
}