<?php 

function thanh_tien() {
    $sum = 0;
    foreach ($_SESSION['myCart'] as $item) {
        $total = $item[3] * $item[4];
        $sum  += $total;
    }
    return $sum;
}

function insert_bill($idUser, $user, $email, $address, $phone, $time, $total, $paymethod) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare("INSERT INTO bills (user_id, bill_user, bill_email, bill_address, bill_phone, bill_time, bill_total, bill_paymethod) 
                                VALUES (:user_id, :bill_user, :bill_email, :bill_address, :bill_phone, :bill_time, :bill_total, :bill_paymethod)");
        $stmt->bindParam(':user_id', $idUser);
        $stmt->bindParam(':bill_user', $user);
        $stmt->bindParam(':bill_email', $email);
        $stmt->bindParam(':bill_address', $address);
        $stmt->bindParam(':bill_phone', $phone);
        $stmt->bindParam(':bill_time', $time);
        $stmt->bindParam(':bill_total', $total);
        $stmt->bindParam(':bill_paymethod', $paymethod);
        $stmt->execute();
        
        $idBill = $conn->lastInsertId();
        return $idBill;
    } catch (PDOException $e) {
        $conn->rollback(); // Rollback transaction nếu có lỗi
        echo "ERROR: " . $e->getMessage();
        return null;
    }
}
function insert_bill_details($idBill){
    $conn = pdo_get_connection();
    $carts = $_SESSION["myCart"];
    foreach ($carts as $cart){
        $stmt = $conn->prepare("INSERT INTO bill_details (bill_id, product_id, quantity) VALUES (:bill_id, :product_id, :quantity)");
        $stmt->bindParam(':bill_id', $idBill);
        $stmt->bindParam(':product_id', $cart[0]);
        $stmt->bindParam(':quantity', $cart[3]);
        $stmt->execute();
    }
}
function select_one_bill($id) {
    $sql = "SELECT products.product_name, bill_details.quantity, bill_details.bill_id, bills.bill_email, bills.bill_address, bills.bill_phone, bills.bill_paymethod, bills.bill_status, bills.bill_time as bill_time, bills.bill_total as bill_total
            FROM bill_details
            INNER JOIN products 
            ON bill_details.product_id = products.product_id 
            INNER JOIN bills
            ON bills.bill_id = bill_details.bill_id
            WHERE bill_details.bill_id = " . $id;
    $result = pdo_query($sql);
    return $result;
}
function selectAllBill(){
    $sql = "SELECT * FROM bills";
    $result = pdo_query($sql);
    return $result;
}
function selectBillUser($id){
    $sql = "SELECT * FROM bills WHERE user_id = ?";
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}
function deleteBill($id){
    $sql = "DELETE FROM bills WHERE bill_id = ?";
    $conn = pdo_get_connection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    if($stmt->execute()){
        return true;
    }
}


