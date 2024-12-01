<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT  p.*, v.shop_name as vendor, c.name as `category` FROM `product_list` p inner join vendor_list v on p.vendor_id = v.id inner join category_list c on p.category_id = c.id where p.delete_flag = 0 and p.id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    } else {
        echo "<script> alert('Unknown Product ID.'); location.replace('./?page=products') </script>";
        exit;
    }
} else {
    echo "<script> alert('Product ID is required.'); location.replace('./?page=products') </script>";
    exit;
}
?>
<style>
    body {
        background-color: #121212;
        color: #e0e0e0;
    }

    .card {
        background-color: #1e1e1e;
        border: none;
    }

    .card-header {
        background-color: #14453d;
        color: #ffffff;
    }

    .btn-primary {
        background-color: #14453d;
        border-color: #14453d;
    }

    .btn-primary:hover {
        background-color: #0f3830;
        border-color: #0f3830;
    }

    a {
        color: #14453d;
    }

    a:hover {
        color: #0f3830;
    }

    #prod-img-holder {
        height: 45vh !important;
        width: 100%;
        overflow: hidden;
    }

    #prod-img {
        object-fit: scale-down;
        height: 100%;
        width: 100%;
        transition: transform .3s ease-in;
    }

    #prod-img-holder:hover #prod-img {
        transform: scale(1.2);
    }

    .form-control {
        background-color: #2c2c2c;
        color: #e0e0e0;
        border: 1px solid #444444;
    }

    .form-control:focus {
        background-color: #2c2c2c;
        color: #e0e0e0;
        border-color: #14453d;
        box-shadow: none;
    }

    .text-primary {
        color: #14453d !important;
    }

    .alert-danger {
        background-color: #ff6b6b;
        color: #ffffff;
        border: none;
    }
</style>
<div class="content py-3">
    <div class="card card-outline rounded-0 shadow">
        <div class="card-header">
            <h5 class="card-title"><b>Product Details</b></h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div id="msg"></div>
                <div class="row">
                    <div class="col-lg-4 col-md-5 col-sm-12 text-center">
                        <div class="position-relative overflow-hidden" id="prod-img-holder">
                            <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="<?= $row['name'] ?>" id="prod-img" class="img-thumbnail bg-gradient-gray" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <h3><b><?= $name ?></b></h3>
                        <div class="d-flex w-100">
                            <div class="col-auto px-0"><small class="text-muted">Vendor: </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                <p class="m-0"><small class="text-muted"><?= $vendor ?></small></p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Category: </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                <p class="m-0"><small class="text-muted"><?= $category ?></small></p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-auto px-0"><small class="text-muted">Price: </small></div>
                            <div class="col-auto px-0 flex-shrink-1 flex-grow-1">
                                <p class="m-0 pl-3"><small class="text-primary"><?= format_num($price) ?></small></p>
                            </div>
                        </div>
                        <div class="row align-items-end">
                            <div class="col-md-3 form-group">
                                <input type="number" min="1" id='qty' value="1" class="form-control rounded-0 text-center">
                            </div>
                            <div class="col-md-3 form-group">
                                <button class="btn btn-primary btn-flat" type="button" id="add_to_cart"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                            </div>
                        </div>
                        <style>
                            #description {
                                color: white !important;
                            }
                        </style>
                        <div class="w-100 description" id="description"><?= html_entity_decode($description) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function add_to_cart() {
        var pid = '<?= isset($id) ? $id : '' ?>';
        var qty = $('#qty').val();
        var el = $('<div>')
        el.addClass('alert alert-danger')
        el.hide()
        $('#msg').html('')
        start_loader()
        $.ajax({
            url: _base_url_ + 'classes/Master.php?f=add_to_cart',
            method: 'POST',
            data: {
                product_id: pid,
                quantity: qty
            },
            dataType: 'json',
            error: err => {
                console.error(err)
                alert_toast('An error occurred.', 'error')
                end_loader()
            },
            success: function(resp) {
                if (resp.status == 'success') {
                    location.reload()
                } else if (!!resp.msg) {
                    el.text(resp.msg)
                    $('#msg').append(el)
                    el.show('slow')
                    $('html, body').scrollTop(0)
                } else {
                    el.text("An error occurred. Please try to refresh this page.")
                    $('#msg').append(el)
                    el.show('slow')
                    $('html, body').scrollTop(0)
                }
                end_loader()
            }
        })
    }
    $(function() {
        $('#add_to_cart').click(function() {
            if ('<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3 ?>') {
                add_to_cart();
            } else {
                location.href = "./login.php"
            }
        })
    })
</script>