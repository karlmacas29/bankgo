
<div class="sidebar bg-dark" >
  <a href="dashboard.php" class="text-white mb-1 mx-1" id="active1" title="Balance"><i class="bi bi-wallet2"></i> <span class="c5">  Balance</span></a>
  <a href="./withdraw.php" class="text-white mb-1 mx-1" id="active2" title="Withdraw"><i class="bi bi-cash-stack"></i> <span class="c5">  Withdraw Money</span> </a>
  <a href="./deposit.php" class="text-white mb-1 mx-1" id="active3" title="Deposit"><i class="bi bi-safe"></i> <span class="c5">  Deposit Money</span> </a>
  <a href="./transaction.php" class="text-white mb-1 mx-1" id="active4" title="Transaction"><i class="bi bi-file-text"></i> <span class="c5">  Transaction </span><span class="span3 badge text-bg-primary "><?php
  if ($cnt == 0) {

  } else {
    echo $cnt;
  }
  ?></span></a>
  <hr class="c4">
  <a id="user1" href="#" class="text-white c6" title="Account"> <i class="bi bi-person-circle"></i> <span class="c5"><?php echo $firstN.' '.$lastN; ?></span></a>
</div>
