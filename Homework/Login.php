<?php include __DIR__ . '/phphtml/init.php'; ?>
<?php include __DIR__ . '/phphtml/head.php'; ?>
<?php include __DIR__ . '/phphtml/navbar.php'; ?>
<style>
    .navbar {
        width: 100vw;
        position: fixed;
        z-index: 2;
    }

    .navbar-brand {
        width: 10vw;
        text-align: center;
        font-weight: 700;
    }

    .card h1 {
        text-align: center;
        font-weight: 700;
        margin-top: 30px;
    }

    .form-login {
        width: 50vw;
        margin: 0 auto;
        padding: 25vh 0;
    }

    .form-group {
        margin: 20px 0;
    }

    .form-login .btn {
        width: 200px;
        margin: 0 auto;
    }

    .submit {
        width: 100%;
        text-align: center;
    }

    .card-body label {
        font-size: 1.5rem;
        font-weight: 700;
    }

    .form-text {
        color: red;
        display: none;
    }
</style>
<div class="container">
    <div class="row form-login">
        <div class="col">
            <div class="card my-5">
                <h1>系統登入頁面</h1>
                <div class="card-body">
                    <form name="loginform" onsubmit="Sendajax(); return false;">
                        <div class="form-group">
                            <label for="account">帳號</label>
                            <input type="email" class="form-control" id="account" name="account" aria-describedby="emailHelp" placeholder="請在此輸入帳號">
                            <small class="form-text">請記得填寫帳號</small>
                        </div>
                        <div class="form-group">
                            <label for="password">密碼</label>
                            <input type="password" class="form-control" id="passowrd" name="password" placeholder="Password">
                            <small class="form-text">請記得填寫密碼</small>
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn btn-primary">登入</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/phphtml/footer.php'; ?>
<?php include __DIR__ . '/phphtml/script.php'; ?>
<script>
    function Sendajax() {
        let Pass = true;
        let getaccount = document.loginform.account;
        let getpassword = document.loginform.password;
        getaccount.nextElementSibling.style.display = 'none';
        getpassword.nextElementSibling.style.display = 'none';

        if (!getaccount.value) {
            getaccount.nextElementSibling.style.display = 'block';
            getaccount.style.border = '1px solid red';
            pass = false;
        }

        if (!getpassword.value) {
            getpassword.nextElementSibling.style.display = 'block';
            getpassword.style.border = '1px solid red';
            pass = false;
        }

        if (Pass) {
            const fd = new FormData(document.loginform)
            fetch('Login-api.php', {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(obj => {
                    if (obj.success) {
                        console.log(obj);
                        location.href = 'index-home.php';
                    }
                })
                .catch(error => {
                    console.log('error', error);
                });

        }

    }
</script>