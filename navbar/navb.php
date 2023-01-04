
<div class="sidebar bg-dark" >
  <a href="dashboard.php" class="text-white mb-1 mx-1" id="active1" title="Balance"><i class="bi bi-wallet2"></i> <span class="c5">  Balance</span></a>
  <a href="../bankgo/withdraw.php" class="text-white mb-1 mx-1" id="active2" title="Withdraw"><i class="bi bi-cash-stack"></i> <span class="c5">  Withdraw Money</span> </a>
  <a href="../bankgo/deposit.php" class="text-white mb-1 mx-1" id="active3" title="Deposit"><i class="bi bi-safe"></i> <span class="c5">  Deposit Money</span> </a>
  <a href="../bankgo/transaction.php" class="text-white mb-1 mx-1" id="active4" title="Transaction"><i class="bi bi-file-text"></i> <span class="c5">  Transaction</span></a>
  <hr class="c4">
  <a href="#" class="text-white c6" id="user1" title="Account"> <i class="bi bi-person-circle"></i> <span class="c5"><?php echo $row['client_firstN'].' '.$row['client_lastN']; ?></span></a>
</div>
