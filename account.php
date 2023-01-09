<?php
include "./data/config.php";

    // Check user login or not
    if(!isset($_SESSION['card_id'])){
        header('Location: Login.php');
    }

    $id = $_SESSION['id'];

    $sql1 = "SELECT client_firstN FROM clients WHERE client_id = {$id}";
            $result = mysqli_query($con, $sql1);
            $row = mysqli_fetch_array($result);
            $Us1 = $row["client_firstN"];

            $_SESSION['name'] = $Us1;
            $user = $_SESSION['name'];
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
            <h3>Profile</h3>
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
                            <div class="d-grid col-6 mx-auto">
                                <button class="btn btn-primary" id="fedit">EDIT</button>
                            </div>
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
    
        <div class="modal fade" id="formModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark text-light">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg text-white"></i></button>
        </div>
        <div class="modal-body">
            <!--Form-->
            <form>
            <div class="mb-3">
                <input class="form-control " type="hidden" id="idPer" name="idPer" value="<?php echo $row['client_id'];?>">
                </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control bg-dark text-white" onkeydown="return /[a-z]/i.test(event.key);" oninput="this.value=removeSpaces(this.value);" id="firstname" name="firstname" value="<?php echo $row['client_firstN'];?>" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control bg-dark text-white" onkeydown="return /[a-z]/i.test(event.key);" oninput="this.value=removeSpaces(this.value);" id="lastname" name="lastname" value="<?php echo $row['client_lastN'];?>" required>
            </div>
            <div class="mb-3">
                <label class="my-1">Gender</label>
                <select class="form-select bg-dark text-white" name="sex" id="gend" required>
                    <?php
                    if ($row['client_gender'] == "Male"){
                        echo "<option value='Male' selected>Male</option>";
                        echo "<option value='Female'>Female</option>";
                        echo "<option value='Others'>Others</option>";
                    }elseif ($row['client_gender'] == "Female"){
                        echo "<option value='Male'>Male</option>";
                        echo "<option value='Female' selected>Female</option>";
                        echo "<option value='Others'>Others</option>";
                    }elseif ($row['client_gender'] == "Others"){
                        echo "<option value='Male'>Male</option>";
                        echo "<option value='Female'>Female</option>";
                        echo "<option value='Others' selected>Others</option>";
                    }else{
                        echo "<option value='Male'>Male</option>";
                        echo "<option value='Female'>Female</option>";
                        echo "<option value='Others'>Others</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="bdate" class="form-label">Birth Date</label>
                <input type="date" class="form-control bg-dark text-white" id="bdate" name="bdate" value="<?php echo $row['client_bdate']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Your Address</label>
                <textarea class="form-control bg-dark text-white" id="address" rows="2" name="address"><?php echo $row['client_c_address']; ?></textarea>
            </div>
        </form>
        <!--Form-->
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" id="upt1">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
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
        $("#bt1").attr({
            "class" : "btn btn-light"
        });

        $("#user1").attr({
            "class" : "text-dark mb-1 fw-bolder bg-light rounded-3 c6"
        });

        $("#user1").click(function(){
            $("#exampleModal").modal("show");
        });

        $("button#fedit").click(function(){
            $("div#formModal").modal("show");
        });


        $("#upt1").click(function(){
            var id = $("#idPer").val();
            var fname = $("#firstname").val();
            var lname = $("#lastname").val();
            var gend = $("#gend").val();
            var bdate = $("#bdate").val();
            var address = $("#address").val();

            var fdata = {
                id : id,
                fname : fname,
                lname : lname,
                sex : gend,
                bdate : bdate,
                addr : address,
            }
            
            $.ajax({
                url : "./data/uptData.php",
                type : "POST",
                data : fdata,
                dataType : "json",
                success : function(res){
                    if(res['val'] == false){
                        var text = res['msg'];
                        $("#say12").html(text);
                        $("div#formModal").modal("hide");
                        $("#confirmErr").modal("show");
                    }else{
                        var text = res['msg'];
                        $("#say12").html(text);
                        $("div#formModal").modal("hide");
                        $("#confirm2").modal("show");
                    }
                }
            });
            $("button#okay1").click(function(){
                window.location.href="account.php";
                });
        });
    });
    
</script>
<script>
    function removeSpaces(string) {
    return string.split(' ').join('');
    }
</script>
</html>