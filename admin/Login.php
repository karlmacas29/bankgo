<?php
include "./data/config.php";


if(isset($_POST['userEnt'])){

    $ad_email = $_POST['email'];
    $ad_pass = $_POST['pass'];

    if ($ad_email != "" and $ad_pass != ""){

        $sql = "SELECT count(*) AS cntUser, ad_id, ad_email , ad_pass FROM admin_acc WHERE ad_email = '{$ad_email}' AND ad_pass = '{$ad_pass}' ";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];
        $id = $row['ad_id'];

        if($count > 0){
            $_SESSION['ad_id'] = $id;
            header('Location: admin-home.php');
        }else{
            $msglog = "Email And Password are Incorrect";
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>LogIn</title>
</head>
<body id="bg1" class="bg-dark m-3">
    <nav class="navbar bg-body-dark bg-dark">
        <a class="navbar-brand mx-2 fs-3 fw-bold text-light" href="../homepage.php">AMSBP</a>
    </nav>
    <div class="row">
        <div class="col-xl-6">
            <div class="container mt-2 text-light">  
            <form action="" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control bg-dark text-light" id="exampleInputEmail1" placeholder="mail@mail.com" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control bg-dark text-light" id="exampleInputPassword1" name="pass">
                </div>
                <div class="mt-3 col-8 mx-auto text-center">
                        <?php echo '<p class="bg-danger text-light rounded-1">'.@$msglog.'</p>'; ?>
                    </div>
                <div class="d-grid col-6 mx-auto mb-3">
                    <input type="submit" class="btn btn-primary" value="Log In" name="userEnt">
                </div>
            </form>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="container">
                <img src="./img/wow.svg" class="img-fluid rounded mx-auto d-block" height="400px" alt="...">
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