<style>
    body {
        background-color: #121212;
        color: #ffffff;
        font-family: Arial, sans-serif;
    }

    .container-fluid {
        padding: 20px;
    }

    .text-left {
        color: #ffffff;
    }

    .product-item {
        margin-bottom: 20px;
    }

    .card {
        background-color: #1e1e1e;
        border: none;
    }

    .card-body {
        border-top: 1px solid #333333;
    }

    .product-img-holder {
        background-color: #333333;
    }

    .product-img {
        width: 100%;
        height: auto;
    }

    .text-muted {
        color: #bbbbbb !important;
    }

    .text-primary {
        color: #14453d !important;
    }

    .btn-primary {
        background-color: #14453d;
        border-color: #14453d;
    }

    .btn-primary:hover {
        background-color: #0f3a32;
        border-color: #0f3a32;
    }

    .text-reset {
        color: #ffffff !important;
    }

    .text-decoration-none {
        text-decoration: none !important;
    }

    .truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="col-lg-12 py-5">
    <div class="container-fluid">

        <h3 class="text-left"><b>Products</b></h3>

        <div class="row" id="product_list">
            <?php
            $products = $conn->query("SELECT p.*, v.shop_name as vendor, c.name as `category` FROM `product_list` p inner join vendor_list v on p.vendor_id = v.id inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.`status` =1 order by RAND() limit 4");
            while ($row = $products->fetch_assoc()):
            ?>
                <div class="col-lg-3 col-md-6 col-sm-12 product-item" style="overflow: hidden;">
                    <a href="./?page=products/view_product&id=<?= $row['id'] ?>" class="card shadow rounded-3 text-reset text-decoration-none h-100" style="overflow: hidden;">
                        <div class="product-img-holder position-relative" style="overflow: hidden;">
                            <img src="<?= validate_image($row['image_path']) ?>" alt="Product-image" class="img-top product-img bg-gradient-gray" style="object-fit: cover; overflow: hidden;">
                        </div>
                        <div class="card-body border-top border-gray d-flex flex-column" style="overflow: hidden;">
                            <h5 class="card-title text-truncate w-100" style="overflow: hidden;"><?= $row['name'] ?></h5>
                            <div class="d-flex w-100" style="overflow: hidden;">
                                <div class="col-auto px-0" style="overflow: hidden;"><small class="text-muted">Vendor: </small></div>
                                <div class="col-auto px-0 flex-shrink-1 flex-grow-1" style="overflow: hidden;">
                                    <p class="text-truncate m-0" style="overflow: hidden;"><small class="text-muted"><?= $row['vendor'] ?></small></p>
                                </div>
                            </div>
                            <div class="d-flex" style="overflow: hidden;">
                                <div class="col-auto px-0" style="overflow: hidden;"><small class="text-muted">Category: </small></div>
                                <div class="col-auto px-0 flex-shrink-1 flex-grow-1" style="overflow: hidden;">
                                    <p class="text-truncate m-0" style="overflow: hidden;"><small class="text-muted"><?= $row['category'] ?></small></p>
                                </div>
                            </div>
                            <div class="d-flex" style="overflow: hidden;">
                                <div class="col-auto px-0" style="overflow: hidden;"><small class="text-muted">Price: </small></div>
                                <div class="col-auto px-0 flex-shrink-1 flex-grow-1" style="overflow: hidden;">
                                    <p class="m-0 pl-3" style="overflow: hidden;"><small class="text-primary"><?= format_num($row['price']) ?></small></p>
                                </div>
                            </div>
                            <p class="card-text truncate-3 w-100 flex-grow-1" style="overflow: hidden;"><?= strip_tags(html_entity_decode($row['description'])) ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="clear-fix mb-2"></div>
        <div class="text-center">
            <a href="./?page=products" class="btn btn-large btn-primary rounded-pill col-lg-3 col-md-5 col-sm-12">Explore More Products</a>
        </div>
    </div>
</div>