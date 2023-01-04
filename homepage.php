<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>AMSBP</title>
</head>
<body id="bg1" class="bg-dark m-3">
    <nav class="navbar  bg-body-dark " >
        <a class="navbar-brand mx-2 fs-3 fw-bold text-light" href="homepage.php">AMSBP</a>
    </nav>
    <div class="container">
    <div class="row">
            <div class="col-xl-6">
                <div class="container text-start p-5 text-light">
                    <small>BankGo</small>
                    <h1 class="fw-bolder">Simply and Useful for ATM here in Panabo.</h1>
                    <small>Sign up for new account ATM for you.</small>
                </div>
                <div class="container p-5">
                    <button class="btn btn-outline-light" id="bp" onclick="window.location.href='signup.php'">Sign Up</button>
                    <button class="btn btn-outline-light" id="bp" onclick="window.location.href='Login.php'">Card Id Login</button>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="container">
                    <img src="./img/cardatm.svg" class="rounded mx-auto d-block" height="400px" width="400px" alt="...">
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    });
</script>
</html>