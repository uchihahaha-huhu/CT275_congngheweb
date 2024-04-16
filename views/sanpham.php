<div class="container">
    <h5 class="my-4">
        ➤
        <?php
        if (isset($_POST["inputTenSP"]) && ($_POST["inputTenSP"]) != '') {
            echo 'Bạn đang tìm kiếm <strong>"' . $_POST["inputTenSP"] . '"</strong>';
        } else {
            echo 'Danh mục sản phẩm';
        }
        ?>
    </h5>
    <h2 class="fw-bold mb-4" style="color: #f07e1aff;">
        <?= $categoryName ?>
    </h2>
    <div class="row g-3">
        <div class="col-md-12 col-lg-8">
            <div class="row g-3">
                <?php 
                foreach ($listProducts as $item) {
                    extract($item);
                    $image = $img_path . $product_image;
                    echo '
                        <div class="col-6 col-md-4">
                            <div class="product-item border w-100" onclick="redirect(' . $product_id . ')">
                                <div class="col-8 col-md-6 mx-auto mt-4" style="height: 200px">
                                    <img src="' . $image . '">
                                </div>
                                <div class="p-3">
                                    <h5 class="text-nowrap overflow-hidden">' . $product_name . '</h5>
                                    <p class="fw-bold fs-5">' . $product_price . ' VNĐ</p>
                                    <a href="#" class="btn btn-outline-danger w-100">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <form action="index.php?page=san-pham" method="post" class="input-group mb-3">
                <input type="text" class="form-control" name="inputTenSP" placeholder="Tên sản phẩm">
                <button class="btn btn-outline-secondary" name="go-search" type="submit">Tìm kiếm</button>
            </form>
            <div class="card card-categories" style="border: 1px solid #f07e1aff;">
                <h5 class="card-header border-0 text-uppercase fw-bold" style="background-color: #f07e1aff;">
                    Danh mục
                </h5>
                <div class="card-body">
                    <div class="list-group">
                        <?php 
                        foreach ($selectCategories as $item) {
                            extract($item);
                            $link = "index.php?page=san-pham&category-id=" . $category_id;
                            echo '
                                <a href="' . $link . '" class="list-group-item list-group-item-action">' . $category_name . '</a>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br>
            <div class="card card-top10" style="border: 1px solid #78b833ff;">
                <h5 class="card-header border-0 text-uppercase fw-bold" style="background-color: #78b833ff;">
                    Top 10 yêu thích
                </h5>
                <div class="card-body">
                    <div class="list-group">
                        <?php 
                        foreach ($selectTop10 as $item) {
                            extract($item);
                            $link = "index.php?page=chi-tiet-san-pham&product-id=" . $product_id;
                            $image = $img_path . $product_image;
                            echo '
                                <li class="d-flex my-1 position-relative">
                                    <img src="' . $image . '" alt="" class="list-group-img p-1">
                                    <a href="' . $link . '" class="list-group-item list-group-item-action">' . $product_name . '</a>
                                    <p class="position-absolute top-0 end-0 m-2">👁️‍🗨️' . $product_view . '</p>
                                </li>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>