<?php 
if (isset($_SESSION['update_success']) && $_SESSION['update_success']) {
    require_once '../assets/toast.php';
    unset($_SESSION['update_success']);
}
?>

<div class="container">
    <h1 class="text-center alert alert-success">Xem đơn hàng</h1>
    <div class="row mx-0 mt-3" style="margin-bottom: 10rem;">
        <table>
            <?php 
                if(!empty($listBills)){
                    echo "
                    <thead>
                    <tr>
                        <th class='col-1'>ID</th>
                        <th class='col-1'>USERID</th>
                        <th class='col-2'>TÊN KHÁCH HÀNG</th>
                        <th class='col-2'>NGÀY ĐẶT HÀNG</th>
                        <th class='col-2'>ĐỊA CHỈ</th>
                        <th class='col-1'>TỔNG TIỀN</th>
                        <th class='col-1'>CÀI ĐẶT</th>
                    </tr>
                    </thead>
                    ";
                    echo "<tbody>";
                    foreach ($listBills as $row) {
                        extract($row);
                        echo '
                            <tr>
                                <td>' . $user_id   . '</td>
                                <td>' . $bill_id   . '</td>
                                <td>' . $bill_user . '</td>
                                <td>' . $bill_time   . '</td>
                                <td>'. $bill_address   . '</td>
                                <td>' . $bill_total   . ' VNĐ</td>
                                <td>
                                    <a href="admin.php?page=don-hang-chi-tiet&id=' . $bill_id . '" class="btn btn-sm btn-success w-100">Chi tiết</a>
                                    <button class="btn btn-sm btn-danger w-100 mt-2" onclick="openModal(' . $bill_id . ')">Xóa</button>
                                </td>
                            </tr>';
                    }
                    echo "</tbody>";
                }else{
                    echo "Chưa có đơn hàng nào";
                }
                ?>
        </table>
    </div>
</div>



<?php
require_once '../assets/modal_window.php';
?>

<script>
    function openModal(id) {
        // Open the modal
        document.getElementById('myModal').style.display = 'block';

        // Set the href attribute dynamically for the "OK" button
        document.getElementById('ok-btn').href = 'admin.php?page=xoa-don-hang&id=' + id;
    }
</script>