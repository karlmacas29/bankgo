<?php
include "./data/config.php";

    // Check user login or not
    if(!isset($_SESSION['card_id'])){
        header('Location: Login.php');
    }

    $id = $_SESSION['id'];
    $user = $_SESSION['name'];
    $con = new mysqli($server, $username, $password, $db);

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>Transaction</title>
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
        </div>
        <div class="col-xl-10 px-4 mt-3 text-light">
            <div class="container p-5 rounded rounded-5 text-light overflow-auto" style="background-color: #37393e; height: 500px;">
                <h3>Recent Transactions</h3>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr class="text-white text-center">
                            <th>Card ID</th>
                            <th>Transaction Message</th>
                            <th>Date/Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sqlCode = "SELECT * FROM {$user} ORDER BY date_time DESC";

                    $result = $con->query($sqlCode);
                        if ($result->num_rows > 0) {
                            while ($rowM = $result->fetch_assoc()) {
                        ?>
                    <tr class="text-white text-center">
                    
                        <td><?php echo $rowM["card_id"]; ?></td>
                        <td><?php echo htmlentities($rowM["tran_message"]); ?></td>
                        <td><?php echo $rowM["date_time"]; ?></td>

                    </tr>
                    <?php 
                    }
                    }else{
                        echo "No Transaction History";
                    }
                    ?>
                    </tbody>
                </table>
                <div class="d-grid col-6 mx-auto">
                    <button class="btn btn-danger" id="delt">Delete all History</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Hello <?php echo $firstN; ?>👋</h1>
                <input type="hidden" class="form-control" value="<?php echo $firstN ?>" name="name3" id="name3">
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
        $("#active4").attr({
            "class" : "text-dark mb-1 fw-bolder bg-light rounded-3"
        });
        $("#user1").click(function(){
            $("#exampleModal").modal("show");
        });

        $("#delt").click(function(){
            var name3 = $("#name3").val();

                var fdata = {
                name3 : name3,
                }

                $.ajax({
                url : "./data/delTran.php",
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
                    window.location.href="transaction.php"; 
                });
            });

    });
</script>
</html>