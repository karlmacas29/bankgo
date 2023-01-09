<?php
include "./data/config.php";

    // Check user login or not
    if(!isset($_SESSION['ad_id'])){
        header('Location: Login.php');
    }


    $sqlCode = "SELECT B.client_id AS ClientId, B.card_id AS CardID, B.client_firstN, B.client_lastN, A.bal_balance AS Balance, C.wit_amount AS Withdraw_Amount, D.dep_amount AS Deposit_Amount, B.client_c_address, B.client_gender, B.client_bdate FROM balance_inq A INNER JOIN clients B ON A.client_id = B.client_id INNER JOIN withdrawals C ON B.client_id = C.client_id INNER JOIN deposit D ON B.client_id = D.client_id ";

    $result = $con->query($sqlCode);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../head/head.php"; ?>
    <title>Admin</title>
</head>
<body class="bg-dark m-3">
    <?php include "./navbar/nav3.php"; ?>
    
    <div class="row">
        <div class="col-xl-2 px-4 text-light">
            <?php include "./navbar/nav4.php" ?>
        </div>
        <div class="col-xl-10 px-4 mt-3 text-light">
            <div class="container p-5 rounded rounded-5 overflow-auto" style="background-color: #37393e;">
            <h3>Client List</h3>
            <table class="table table-dark">
                <tr class="text-center text-light">
                    <th>Client ID</th>
                    <th>Card ID</th>
                    <th>Client First Name</th>
                    <th>Client Last Name</th>
                    <th>Balance</th>
                    <th>Withdraw</th>
                    <th>Deposit</th>
                    <th>Option</th>
                </tr>
            
            <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr class="text-center text-light">
                    <td><?php echo $row['ClientId'] ?></td>
                    <td><?php echo $row['CardID'] ?></td>
                    <td><?php echo $row['client_firstN'] ?></td>
                    <td><?php echo $row['client_lastN'] ?></td>
                    <td>₱ <?php echo $row['Balance'] ?></td>
                    <td>₱ <?php echo $row['Withdraw_Amount'] ?></td>
                    <td>₱ <?php echo $row['Deposit_Amount'] ?></td>
                    <td><button class="btn btn-danger" onclick="dl('<?php echo $row['ClientId'] ?>','<?php echo $row['client_firstN'] ?>')" id="delCon">Delete</button> <button id="uptM" class="btn btn-primary" onclick="up('<?php echo $row['ClientId'] ?>','<?php echo $row['client_firstN'] ?>', '<?php echo $row['client_lastN'] ?>', '<?php echo $row['client_gender'] ?>', '<?php echo $row['client_bdate'] ?>', '<?php echo $row['client_c_address'] ?>')">Update</button></td>
                </tr>
               <?php }
            }
                ?>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-person-circle"></i> ADMIN👋</h1>
                <button type="button" class="btn" data-bs-dismiss="modal"><i class="bi bi-x-lg text-white"></i></button>
            </div>
            <div class="modal-body">
                <div class="d-grid gap-2">
                    <button onclick="window.location.href='Logout.php'" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Log Out</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!--delete modal-->
    <div class="modal fade" id="delMet">
    <div class="modal-dialog bg-dark text-light">
        <div class="modal-content bg-dark">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-circle"></i> DELETE CONFIRMATION</h1>
        </div>
        <div class="modal-body">
            <strong>Are you sure do you want to delete this client account?</strong><br>
            Account Client Name: <span id="idShow"></span>
            <input class="form-control" type="hidden" id="id3" name="id3">
            <input class="form-control" type="hidden" id="nm" name="nm">
            <p>Make sure his balance is 0</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="accDel">Yes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
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
                <input class="form-control" type="hidden" id="idPer" name="idPer" >
                </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control bg-dark text-white" onkeydown="return /[a-z]/i.test(event.key)" oninput="this.value=removeSpaces(this.value);" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control bg-dark text-white" onkeydown="return /[a-z]/i.test(event.key)" oninput="this.value=removeSpaces(this.value);" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label class="my-1">Gender</label>
                <select class="form-select bg-dark text-white" name="sex" id="gend" required>  
                    <option value='Male'>Male</option>
                    <option value='Female'>Female</option>
                    <option value='Others'>Others</option>   
                </select>
            </div>
            <div class="mb-3">
                <label for="bdate" class="form-label">Birth Date</label>
                <input type="date" class="form-control bg-dark text-white" id="bdate" name="bdate" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Your Address</label>
                <textarea class="form-control bg-dark text-white" id="address" rows="2" name="address"></textarea>
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

        $("button#delCon").click(function(){
           $("div#delMet").modal("show");
        });

        $("button#uptM").click(function(){
           $("div#formModal").modal("show");
        });

        $("#accDel").click(function(){
            var id3 = $("#id3").val();
            var nm = $("#nm").val();

                var fdata = {
                id3 : id3,
                nm : nm
                }

                $.ajax({
                url : "./data/deleteClient.php",
                type : "POST",
                data : fdata,
                dataType : "json",
                success : function(res){
                    if(res['val'] == false){
                        var text = res['msg'];
                        $("strong#say12").html(text);
                        $("div#delMet").modal("hide");
                        $("#confirmErr").modal("show");
                    }else{
                        var text = res['msg'];
                        $("strong#say12").html(text);
                        $("div#delMet").modal("hide");
                        $("#confirm2").modal("show");
                        }
                    }
                });
                $("button#okay1").click(function(){
                    window.location.href="admin-home.php"; 
                });
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
                url : "./data/updateClient.php",
                type : "POST",
                data : fdata,
                dataType : "json",
                success : function(res){
                    if(res['val'] == false){
                        var text = res['msg'];
                        $("strong#say12").html(text);
                        $("div#formModal").modal("hide");
                        $("#confirmErr").modal("show");
                    }else{
                        var text = res['msg'];
                        $("strong#say12").html(text);
                        $("div#formModal").modal("hide");
                        $("#confirm2").modal("show");
                    }
                }
            });
            $("button#okay1").click(function(){
                window.location.href="admin-home.php";
                });
        });
    });

    function dl(dl, nm){
        $("#id3").val(dl);
        $("#nm").val(nm);
        $("#idShow").html(nm);
    }

    function up(id, fname, lname, gend, bdate, address){
        $("#idPer").val(id);
        $("#firstname").val(fname);
        $("#lastname").val(lname);
        $("#gend").val(gend);
        $("#bdate").val(bdate);
        $("#address").val(address);
    }
    </script>
    <script>
    function removeSpaces(string) {
    return string.split(' ').join('');
    }
</script>
</html>