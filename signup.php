<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./head/head.php"; ?>
    <title>SignUp</title>
</head>
<body class="bg-dark m-3">
<nav class="navbar bg-body-dark bg-dark">
        <a class="navbar-brand mx-2 fs-3 fw-bold text-light" href="homepage.php">AMSBP</a>
    </nav>
    <div class="row mb-3">
        <div class="col-xl-6 p-3">
            <div class="container mt-2 text-light">  
                <form action="./data/sign_success.php" method="post">
                    <div class="row g-3 align-items-center mx-auto">
                        <h3>Sign Up to your new ATM Account</h3>
                    </div>
                    
                    <div class="input-group my-3 col-8 mx-auto">
                        <label for="input" class="input-group-text bg-secondary text-light">Card ID</label>
                        <input type="number" id="input" class="form-control bg-light " name="idcard" placeholder="000" required>
                    </div>
                    <div class="input-group">
                        <input type="text" id="input1" class="form-control bg-light " name="fname" placeholder="First Name" required>
                        <input type="text" id="input2" class="form-control bg-light " name="lname" placeholder="Last Name" required>
                    </div>
                    <div class="input-group mt-3 col-8 mx-auto">
                    <label class="input-group-text bg-secondary text-light" for="gend">Gender</label>
                        <select class="form-select bg-light" name="gend" id="gend" required>
                            <option value='Male'>Male</option>
                            <option value='Female'>Female</option>
                            <option value='Others'>Others</option>
                        </select>
                    </div>
                    <div class="input-group mt-3 col-8 mx-auto">
                        <label for="bdate" class="input-group-text bg-secondary text-light">Birth Date</label>
                        <input type="date" class="form-control bg-light" id="bdate" name="bdate" required>
                    </div>
                    <div class="mt-3 col-8 mx-auto">
                        <label for="address" class="form-label">Your Address</label>
                        <textarea class="form-control bg-light" id="address" rows="2" name="address" ></textarea>
                    </div>  
                    <div class="mt-3 d-grid col-6 mx-auto">
                        <input type="submit" class="btn btn-success" value="Create Account" name="userEnt">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="container">
                <img src="./img/onlinebank.svg" class="rounded mx-auto d-block" height="400px" width="400px" alt="...">
            </div>
        </div>
    </div>
</body>
</html>