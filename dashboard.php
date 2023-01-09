<?php
include "./data/config.php";

    // Check user login or not
    if(!isset($_SESSION['card_id'])){
        header('Location: Login.php');
    }

    $id = $_SESSION['id'];
    $user = $_SESSION['name'];

    $sqlCode = "SELECT B.client_id AS ClientId, B.card_id AS CardID, B.client_firstN, B.client_lastN, A.bal_balance AS Balance, C.wit_amount AS Withdraw_Amount, D.dep_amount AS Deposit_Amount FROM balance_inq A INNER JOIN clients B ON A.client_id = B.client_id INNER JOIN withdrawals C ON B.client_id = C.client_id INNER JOIN deposit D ON B.client_id = D.client_id WHERE B.client_id = "."$id"." ";

    $result = $con->query($sqlCode);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>Dashboard</title>
</head>
<body id="bg1" class="bg-dark m-3">
    <?php include('./navbar/nav2.php'); ?>
    
    <div class="row">
        <div class="col-xl-2 px-4 text-light">
        <?php 

        $sql_query = "SELECT * FROM clients WHERE client_id = {$id}";
        $result4 = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result4);
        $firstN = $row["client_firstN"];
        $lastN = $row["client_lastN"];

        $sql_q = "SELECT count(*) AS cnt FROM {$user} ORDER BY date_time DESC";
        $result5 = mysqli_query($con,$sql_q);
        $row = mysqli_fetch_array($result5);
        $cnt = $row["cnt"];
        
        include "./navbar/navb.php";

        ?>  

    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
        </div>
        <div class="col-xl-10 px-4 mt-1 text-light">
            <div class="container p-5 rounded rounded-5" style="background-color: #37393e;">
            <h3>Your ATM Balance:</h3>
            <h2 class="text-center">₱ <?php echo $row['Balance'] ?></h2>
            <hr>
            <h5>Account Name: <i><?php echo $row['client_firstN'].' '.$row['client_lastN'] ?></i></h5>
            <h5>Your Card ID: <i><?php echo $row['CardID'] ?></i></h5>
            <div class="row justify-content-around mt-3">
                <div class="col-lg-6 my-2">
                    <div class="container p-3 text-center border border-light rounded rounded-5">
                        <h4 class="">Total Money Withdraw:</h4>
                        <h2 class="text-center">₱ <i><?php echo $row['Withdraw_Amount'] ?></i></h2>
                    </div>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="container p-3 text-center border border-light rounded rounded-5">
                        <h4 class="">Total Money Deposit:</h4>
                        <h2 class="text-center">₱ <i><?php echo $row['Deposit_Amount'] ?></i></h2>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Hello <?php echo $row['client_firstN'] ?>👋</h1>
                <button type="button" class="btn" data-bs-dismiss="modal"><i class="bi bi-x-lg text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="window.location.href='account.php'; "><i class="bi bi-person-circle"></i> My Account</button>
                    <button onclick="window.location.href='Logout.php'" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Log Out</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php }
        }
        
        ?>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#active1").attr({
            "class" : "text-dark mb-1 fw-bolder bg-light rounded-3"
        });

        $("#user1").click(function(){
            $("#exampleModal").modal("show");
        });
    });

    
</script>
</html>