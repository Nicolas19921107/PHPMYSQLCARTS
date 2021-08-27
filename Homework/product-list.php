<?php include __DIR__ . '/phphtml/init.php';

$sql = $pdo->query("SELECT pf.*,pc.cate_name FROM `products_food` pf JOIN product_cate pc ON pf.cate_sid=pc.sid")->fetchAll();
?>
<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>
<style>
    .product {
        width: 400px;
        margin: 0 20px;
    }

    .title {
        width: 100vw;
        text-align: center;
    }

    .qty {
        width: 80%;
    }

    .btn {
        width: 100px;
        margin: 0 20px;
    }

    .card-body h2 {
        font-weight: 700;
    }

    .card-text {
        margin: 20px 0;
    }
</style>

<div class="container">
    <!-- <div class="row">
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?<?php
                                                            $pageBtnQS['page'] = $page - 1;
                                                            echo http_build_query($pageBtnQS)
                                                            ?>">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++) :
                                $pageBtnQS['page'] = $i;
                            ?>
                                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                    <a class="page-link" href="?<?= http_build_query($pageBtnQS) ?>">
                                        <?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link" href="?<?php
                                                            $pageBtnQS['page'] = $page + 1;
                                                            echo http_build_query($pageBtnQS)
                                                            ?>">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> -->
    <div class="row">
        <div class="title">
            <h1>產品列表</h1>
        </div>
        <?php foreach ($sql as $s) : ?>
            <div class="product mx-3 mt-3" data-sid="<?= $s['product_id'] ?>">
                <div class="card">
                    <img src="./image/<?= $s['product_id'] ?>.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h2 class="card-title"><?= $s['name'] ?></h2>
                        <h4 class="card-text">品牌: <?= $s['brand'] ?></h4>
                        <h4 class="card-text">售價: NT$ <?= $s['price'] ?></h4>
                        <form>
                            <h4>訂購數量</h4>
                            <div class="form-group d-flex">
                                <select class="form-control qty">
                                    <option disabled selected>--請選擇數量--</option>
                                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                                <button type="button" class="btn btn-primary add-to-cart-btn"><i class="fas fa-cart-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="showModalClose();">Close</button>
                <button type=" button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/phphtml/footer.php'; ?>
<?php include __DIR__ . '/phphtml/script.php'; ?>

<script>
    const addtocart = $('.add-to-cart-btn');

    addtocart.click(function() {
        const sid = $(this).closest('.product').attr('data-sid');
        //const qty = $(this).prev().val();
        const qty = $(this).closest('.product').find('.qty').val();
        console.log(sid, qty);
        fetch('add-to-cart-api.php?sid=' + sid + '&qty=' + qty)
    });
</script>