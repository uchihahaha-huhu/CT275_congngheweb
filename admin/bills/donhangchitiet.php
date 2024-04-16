<div class="container">
    <h1 class="text-center alert alert-success">Đơn hàng chi tiết</h1>
    <div class="row mx-0 mt-3" style="margin-bottom: 10rem;">
        <table>
            <thead>
                <tr>
                    <th class="col-3">BILL ID</th>
                    <th class="col-6">TÊN SẢN PHẨM</th>
                    <th class="col-1">SỐ LƯỢNG</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($billDetail as $row){
                extract($row);
                $payment = "";
                $status = "";
                switch ($bill_paymethod) {
                    case 1:
                        $payment = "Thanh toán khi nhận hàng";
                        break;
                    case 2:
                        $payment = "Thanh toán tài khoản ngân hàng";
                        break;
                    case 3:
                        $payment = "Ví điện tử MoMo";
                        break;
                    
                    default:
                        $payment = "Lỗi";
                        break;
                }
                switch ($bill_status) {
                    case 0:
                        $status = "Đơn mới";
                        break;
                    case 1:
                        $status = "Đang xử lí";
                        break;
                    case 2:
                        $status = "Đang giao hàng";
                        break;
                    case 3:
                        $status = "Đã giao hàng";
                        break;
                    
                    default:
                        $status = "Lỗi";
                        break;
                }
                echo '
                    <tr>
                        <td>' . $bill_id   . '</td>
                        <td>' . $product_name . '</td>
                        <td>' . $quantity . '</td>
                    </tr>
                    ';
                }
                echo "
                <tr>
                    <td colspan='3'>Email: $bill_email</td>
                </tr>
                <tr>
                    <td colspan='3'>Địa chỉ: $bill_address</td>
                </tr>
                <tr>
                    <td colspan='3'>Số điện thoại: $bill_phone</td>
                </tr>
                <tr>
                    <td colspan='3'>Phương thức thanh toán: $payment</td>
                </tr>
                <tr>
                    <td colspan='3'>Trạng thái: $status</td>
                </tr>
                ";
                ?>
            </tbody>
        </table>
    </div>
</div>
<td colspan="3"></td>
