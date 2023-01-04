<?php
include "./data/config.php";


if(isset($_POST['userEnt'])){

    $card_id = $_POST['idclient'];

    if ($password != 0){

        $sql_query = "SELECT count(*) AS cntUser, client_id FROM clients WHERE card_id='".$card_id."' ";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];
        $id = $row['client_id'];

        if($count > 0){
            $_SESSION['card_id'] = $card_id;
            $_SESSION['id'] = $id;
            header('Location: dashboard.php');
        }else{
            $msglog = "Card ID Not FOUND";
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
        <a class="navbar-brand mx-2 fs-3 fw-bold text-light" href="homepage.php">AMSBP</a>
    </nav>
    <div class="row">
        <div class="col-xl-6">
            <div class="container mt-2 text-light">  
                <form action="" method="post">
                    <div class="row g-3 align-items-center mx-auto">
                        <div class="mt-3 col-8 mx-auto">
                            <h3>Enter your Card ID Number:</h3>
                        </div>
                        <div class="mt-3 col-8 mx-auto">
                            <input type="password" placeholder="000" id="inputPassword6" class="form-control bg-light" name="idclient" required>
                        </div>
                        <div class="mt-3 col-8 mx-auto text-center">
                            <?php echo '<p class="bg-danger text-light rounded-1">'.@$msglog.'</p>'; ?>
                        </div>
                    </div>
                    <div class="mt-3 d-grid col-6 mx-auto">
                        <input type="submit" class="btn btn-success" value="Enter" name="userEnt">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="container">
                <img src="./img/udrawcard.svg" class="rounded mx-auto d-block" height="400px" width="400px" alt="...">
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