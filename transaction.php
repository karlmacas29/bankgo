<?php
include "./data/config.php";

    // Check user login or not
    if(!isset($_SESSION['card_id'])){
        header('Location: Login.php');
    }

    $id = $_SESSION['id'];
    $con = new mysqli($server, $username, $password, $db);

    $sqlCode = "SELECT * FROM clients WHERE client_id = {$id} ";

    $result = $con->query($sqlCode);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>Transaction</title>
</head>
<body id="bg1" class="bg-dark m-3">
    <?php include('./navbar/nav2.php'); ?>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <div class="row">
        <div class="col-xl-2 px-4 text-light">
            <?php include "../bankgo/navbar/navb.php" ?>
        </div>
        <div class="col-xl-10 px-4 mt-3 text-light">
            <div class="container p-5 rounded rounded-5" style="background-color: #37393e;">
                <h3>Recent Transactions</h3>
                <table class="table table-bordered">
                    <tr class="text-white text-center">
                        <th>#</th>
                        <th>Card ID</th>
                        <th>Transaction Message</th>
                        <th>Date</th>
                    </tr>
                    <tr>
                        
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Hello User👋</h1>
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
        }?>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#active4").attr({
            "class" : "text-dark mb-1 fw-bolder bg-light rounded-3"
        });

        $("#user1").click(function(){
            $("#exampleModal").modal("show");
        });
    });

    
</script>
</html>