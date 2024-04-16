<?php

function select_danhmuc() {
    $sql = "SELECT * FROM categories ORDER BY category_name ASC";
    $result = pdo_query( $sql);
    return $result;
}

function insert_danhmuc($name) {
    $sql = "INSERT INTO categories (category_name) VALUES ('$name')";
    try {
        pdo_execute($sql);
        // Đặt một biến SESSION để thông báo thành công
        $_SESSION["add_success"] = true;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

function delete_danhmuc($id) {
    $sql = "DELETE FROM categories WHERE category_id=" . $id;
    pdo_execute($sql);
}

function select_one_danhmuc($id) {
    $sql = "SELECT * FROM categories WHERE category_id=" . $id;
    $result = pdo_query_one($sql);
    return $result;
}

function update_danhmuc($id, $name) {
    $sql = "UPDATE categories SET category_name = '" . $name . "' WHERE category_id=" . $id;
    try {
        pdo_execute($sql);
        // Đặt một biến SESSION để thông báo thành công
        $_SESSION["update_success"] = true;
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}