<?php
include "./data/config.php";

    // Check user login or not
    if(!isset($_SESSION['card_id'])){
        header('Location: Login.php');
    }

    $id = $_SESSION['id'];
    $user = $_SESSION['name'];

    $sqlCode = "SELECT a.client_id AS ClientId , a.client_firstN , a.client_lastN, a.card_id AS CardID , b.bal_balance AS Balance FROM clients a INNER JOIN balance_inq b ON a.client_id = b.client_id WHERE a.client_id AND EXISTS (SELECT * FROM balance_inq b WHERE a.client_id = b.client_id AND b.client_id = {$id} )";

    $result = $con->query($sqlCode);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>Deposit</title>
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
        <div class="col-xl-10 px-4 mt-3 text-light">
            <div class="container p-5 rounded rounded-5" style="background-color: #37393e;">
                <h3>Enter amount to Deposit:</h3>
                    <div class="container my-3 p-3 text-light border border-light rounded rounded-5 text-center">
                        <h5>Account Name: <?php echo $row['client_firstN']." ".$row['client_lastN'] ?></h5>
                        <h5>Your Card ID: <?php echo $row['CardID'] ?></h5>
                        <h5>Your ATM balance: ??? <?php echo $row['Balance'] ?></h5>
                    </div>
                    <form>
                    <input type="hidden" class="form-control" value="<?php echo $row['ClientId'] ?>" name="id-dep" id="id-dep">
                    <input type="hidden" class="form-control" value="<?php echo $row['client_firstN'] ?>" name="name3" id="name3">
                    <input type="hidden" class="form-control" value="<?php echo $row['CardID'] ?>" name="card3" id="card3">
                    <div class="d-grid col-8 mx-auto">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-dark text-light" id="basic-addon1">???</span>
                            <input type="number" class="form-control form-control-lg bg-dark text-light" min="1" max="1000000" value="0" name="deposit-data" id="deposit-data" required>        
                        </div>
                    </div>
                    </form>
                    <div class="d-grid col-6 mx-auto">
                        <button class="btn btn-primary" id="upt1">Deposit</button>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Hello <?php echo $row['client_firstN'] ?>????</h1>
                <button type="button" class="btn" data-bs-dismiss="modal"><i class="bi bi-x-lg text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="window.location.href='account.php'; "><i class="bi bi-person-circle"></i> My Account</button>
                    <button onclick="window.location.href='Logout.php'" class="btn btn-danger" ><i class="bi bi-box-arrow-right"></i> Log Out</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php }
        }?>

        <!-- Modal -->
    <div class="modal fade" id="confirm2">
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
        $("#active3").attr({
            "class" : "text-dark mb-1 fw-bolder bg-light rounded-3"
        });

        $("#user1").click(function(){
            $("#exampleModal").modal("show");
        });

        $("#upt1").click(function(){
            var id = $("#id-dep").val();
            var deposit = $("#deposit-data").val();
            var name3 = $("#name3").val();
            var card3 = $("#card3").val();

                var fdata = {
                id : id,
                deposit : deposit,
                name3 : name3,
                card3 : card3
                }

                $.ajax({
                url : "./data/deposit-data.php",
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
                        $("#confirm2").modal("show");
                        }
                    }
                });
                $("button#okay1").click(function(){
                    window.location.href="deposit.php"; 
                });
            });
            
    });
</script>
</html>