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
    <title>Profile</title>
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
            <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                <i class="bi bi-person-circle fs-1"></i>
                <h1 class="text-center mt-3"><?php echo $row['client_firstN'].' '.$row['client_lastN']; ?></h1>
                <p class="text-center">Client</p>
                <hr>
                <div class="container my-3 p-3 text-light border border-light rounded rounded-5
                ">
                <h3>Your Card ID:</h3>
                <h4><?php echo $row['card_id'] ?></h4>
                </div>
                </div>
                <div class="col-md-8">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="about-tab" data-mdb-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a>
                    </li>
                    </ul>
                    <div class="tab-content" id="about-tab">
                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="about">
                        <div class="container my-4">
                            <table class="table table-dark table-bordered">
                                <tr class="text-center">
                                    <th>Age</th>
                                    <?php
                                    $dateNow = date("Y-m-d");
                                    $bdate = $row["client_bdate"];
                                    $diff = date_diff(date_create($bdate) , date_create($dateNow));
                                    ?>
                                    <td><?php echo $diff->format("%Y"); ?></td>
                                </tr>
                                <tr class="text-center">
                                    <th>Gender</th>
                                    <td><?php echo $row['client_gender'] ?></td>
                                </tr>
                                <tr class="text-center">
                                    <th>Birth Date</th>
                                    <td><?php echo $row['client_bdate'] ?></td>
                                </tr>
                                <tr class="text-center">
                                    <th>Address</th>
                                    <td><?php echo $row['client_c_address'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-circle"></i> Hello <?php echo $row['client_firstN']; ?>👋</h1>
                <button type="button" class="btn" data-bs-dismiss="modal"><i class="bi bi-x-lg text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" id="bt1"><i class="bi bi-person-circle"></i> My Account</button>
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
        $("#bt1").attr({
            "class" : "btn btn-light"
        });

        $("#user1").attr({
            "class" : "text-dark mb-1 fw-bolder bg-light rounded-3 c6"
        });

        $("#user1").click(function(){
            $("#exampleModal").modal("show");
        });
    });

    
</script>
</html>