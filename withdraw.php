<?php
include "./data/config.php";

    // Check user login or not
    if(!isset($_SESSION['card_id'])){
        header('Location: Login.php');
    }

    $id = $_SESSION['id'];

    $sqlCode = "SELECT B.client_id AS ClientId, B.card_id AS CardID, B.client_firstN, B.client_lastN, A.bal_balance AS Balance, C.wit_amount AS Withdraw_Amount, D.dep_amount AS Deposit_Amount FROM balance_inq A INNER JOIN clients B ON A.client_id = B.client_id INNER JOIN withdrawals C ON B.client_id = C.client_id INNER JOIN deposit D ON B.client_id = D.client_id WHERE B.client_id = {$id} ";

    $result = $con->query($sqlCode);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>Withdraw</title>
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
                
                <form >
                <h3>Enter amount to Withdraw:</h3>
                    <div class="container my-3 p-3 text-light border border-light rounded rounded-5 text-center">
                        <h5>Account Name: <?php echo $row['client_firstN']." ".$row['client_lastN'] ?></h5>
                        <h5>Your Card ID: <?php echo $row['CardID'] ?></h5>
                        <h5>Your ATM balance: ₱ <?php echo $row['Balance'] ?></h5>
                    </div>
                    <input type="hidden" class="form-control" value="<?php echo $row['ClientId'] ?>" name="id-dep" id="id-wit">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-dark text-light" id="basic-addon1">₱</span>
                            <input type="number" class="form-control form-control-lg bg-dark text-light" min="1" placeholder="0" name="deposit-data" id="wit-data" required>
                        </div></form>
                        <div class="d-grid col-6 mx-auto">
                            <button class="btn btn-primary border border-light" id="upt1">Withdraw</button>
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
        }?>

        <!-- Modal -->
    <div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-check-circle"></i></h1>
        </div>
        <div class="modal-body">
            <strong id="say12"></strong>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="okay1">Okay</button>
        </div>
        </div>
    </div>
    </div>
    
    <div class="modal fade" id="confirmErr">
    <div class="modal-dialog ">
        <div class="modal-content bg-dark text-light">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-circle"></i></h1>
        </div>
        <div class="modal-body">
            <strong id="say12"></strong>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="okay1">Okay</button>
        </div>
        </div>
    </div>
    </div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#active2").attr({
            "class" : "text-dark mb-1 fw-bolder bg-light rounded-3"
        });

        $("#user1").click(function(){
            $("#exampleModal").modal("show");
        });
        $("#upt1").click(function(){
            var id = $("#id-wit").val();
            var wit = $("#wit-data").val();

                var fdata = {
                id : id,
                wit : wit,
                }

                $.ajax({
                url : "/bankgo/data/withdrawdata.php",
                type : "POST",
                data : fdata,
                dataType : "json",
                success : function(res){
                    if(res['val'] == false){
                        var text = res['msg'];
                        $("strong#say12").html(text);
                        $("#confirmErr").modal("show");
                    }else{
                        var text = res['msg'];
                        $("strong#say12").html(text);
                        $("#confirm").modal("show");
                        }
                    }
                });
                $("button#okay1").click(function(){
                    window.location.href="withdraw.php"; 
                });
            });

    });

    
</script>
</html>