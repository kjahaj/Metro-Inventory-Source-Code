<?php
include "../../Model/user.php";
include '../../Model/session.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../../Asset/CSS/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />
  <title>Admin</title>
</head>
<div class="sidebar" id='sidebar'>
  <div class="headeri">
    <button type="button" class="toggle" id="toggle">
      <span></span>
    </button>
    <div class="admin-dashboard">
      <h1>Admin Dashboard</h1>
    </div>
    <div class="header">
      <div class="user-profile">
        <span><?php echo $userFull; ?></span>
        <div class="dropdown-menu">
          <ul>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="../../View/Login/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <ul>
    <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Dashboard</a></li>
    <br>
    <li><a href="stockcheck.php"><i class="fas fa-clipboard-check" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Check Stock</a></li>
    <br>
    <li><a href="#"><i class="fas fa-money-bills" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Buy Stock</a></li>
    <br>
    <li><a href="insertStock.php"><i class="fa-solid fa-boxes-stacked" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Insert Stock</a></li>
    
    <br>
    <li><a href="view-tickets.php"><i class="fa fa-sharp fa-light fa-ticket" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;View Tickets</a></li>
  </ul>
</div>

<div class="container">
  <h1>Data Insertion</h1>
  <input type="text" id="inputItem" placeholder="Enter item">
  <input type="number" id="quantity" name="quantity" placeholder="Quantity" required>
  <select id="inputCategory">
    <option value="IT">IT</option>
    <option value="service">Service</option>
  </select>
  <select id="dropdown" name="dropdown"></select>
  <br><br>
  <button class="buttoniInsert" onclick="insertData()" style="width:20%;">Insert</button>
</div>
<script src="../../Controller/add-warehouse.js"></script>
<script src="../../Controller/insert-stock.js"></script>



<script>
  var btn = document.querySelector('.toggle');
  var btnst = true;
  btn.onclick = function() {
    if (btnst == true) {
      document.querySelector('.toggle span').classList.add('toggle');
      document.getElementById('sidebar').classList.add('sidebarshow');
      btnst = false;
    } else if (btnst == false) {
      document.querySelector('.toggle span').classList.remove('toggle');
      document.getElementById('sidebar').classList.remove('sidebarshow');
      btnst = true;
    }
  }
</script>
<script rel="script" href="insertStockContr.js">

</script>

</body>

</html>