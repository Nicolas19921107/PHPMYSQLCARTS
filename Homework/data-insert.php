<?php include __DIR__ . '/phphtml/init.php';

$sql = $pdo->query("SELECT pf.*,pc.cate_name FROM `products_food` pf JOIN product_cate pc ON pf.cate_sid=pc.sid")->fetchAll();
?>
<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>
<style>
    .card {
        width: 400px;
    }

    .form-group img {
        width: 100%;
    }

    .form-group label {
        font-size: 1.5rem;
    }

    .form-group p {
        font-size: 1rem;
    }

    .info {
        height: 400px;
    }
</style>
<div class="container">
    <div class="row">
        <h1 class="card-title">產品專區</h1>
        <?php foreach ($sql as $s) : ?>
            <div class="card mx-2 my-2">
                <div class="card-body">
                    <!-- return false 相當於 preventdefault()  -->
                    <form name="foodaddform" onsubmit="checkForm(); return false;">
                        <div class="form-group mt-3">
                            <label for="img"><img src="./image/<?= $s['product_id'] ?>.png" alt=""></label>
                        </div>
                        <div class="form-group info mb-5">
                            <label for="name">產品名稱</label>
                            <h6><?= $s['name'] ?></h6>
                            <label for="product_cate">產品類別</label>
                            <h6><?= $s['cate_name'] ?></h6>
                            <label for="introduction">產品介紹:
                                <p><?= $s['introduction'] ?></p>
                            </label>
                            <label for="product_cate">產品單價:<?= $s['price'] ?></label>
                            <label for="flavor">產品口味</label>
                            <button class="btn btn-outline-primary" value="<?= $s['product_id'] ?>"><?= $s['flavor'] ?></button>
                        </div>
                        <div class="form-group discount">
                            <label for="Order_Amount">產品數量</label>
                            <input type="number" class="form-control" id="Order_Amount" name="Order_Amount">
                            <small class="form-text"></small>
                            <label for="Order_Discount">請輸入優惠券代碼</label>
                            <input type="text" class="form-control" id="Order_Discount" name="Order_Discount">
                            <small class="form-text"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">提交資料</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include __DIR__ . '/phphtml/footer.php'; ?>
<!-- <script>
    // const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    // const mobile_re = /^09\d{2}-d{3}-?\d{3}$/;
    const onlineday_re = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;

    const onlineday = document.querySelector('#onlineday');
    const day = document.querySelector('#day');
    const totalamount = document.querySelector('#totalamount');


    function checkForm() {

        onlineday.nextElementSibling.innerHTML = '';
        onlineday.style.border = '1px solid #CCCCCC';
        day.nextElementSibling.innerHTML = '';
        day.style.border = '1px solid #CCCCCC';
        // mobile.nextElementSibling.innerHTML = '';
        // mobile.style.border = '1px solid #CCCCCC';

        let isPass = true;
        // 如果日期沒寫 or 格式錯誤
        if (!onlineday_re.test(onlineday.value)) {
            isPass = false;
            onlineday.nextElementSibling.innerHTML = '請重新輸入正確的日期';
            onlineday.style.border = '1px solid red';
        }

        // 如果填寫內容不屬於信箱格式 or 沒寫
        if (!day.value.length) {
            isPass = false;
            day.nextElementSibling.innerHTML = '請重新輸入正確的星期格式';
            day.style.border = '1px solid red';
        }

        // // 如果填寫內容不屬於手機格式 or 沒寫
        // if (!mobile_re.test(mobile.value)) {
        //     isPass = false;
        //     mobile.nextElementSibling.innerHTML = '請重新輸入正確的手機號碼';
        //     mobile.style.border = '1px solid red';
        // }
        if (isPass) {
            const fd = new FormData(document.foodaddform);
            fetch('data_insert_apitest.php', {
                    method: 'POST',
                    body: fd
                })
                // 要求 json 格式，回傳格式也就需要 json
                .then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        // 新增成功，判斷是否回列表頁 or 繼續新增資料
                        const checkforadd = confirm('新增成功!請問要繼續新增資料嗎?')
                        if (!checkforadd) {
                            location.href = 'data_list_test.php';
                        } else {
                            onlineday.value = "";
                            day.value = "";
                            totalamount.value = "";
                        }

                    } else {
                        alert(obj.error);
                    }
                })
                // 回傳 json 格式錯誤時的處理方式: 即用字串顯示錯誤
                .catch(error => {
                    console.log('error:', error);
                });
        }
    }
</script> -->