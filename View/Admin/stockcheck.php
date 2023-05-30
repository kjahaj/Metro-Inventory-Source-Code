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
<style> 
/* KALOJE TEK CSS ADMIN */
    .open-button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
    }

    /* Style for the pop-up */
    .popup {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      border: 1px solid #ccc;
      padding: 20px;
      z-index: 9999;
    }

    /* Style for the input bars */
    .input-bar {
      margin-bottom: 10px;
    }

    /* Style for the submit button */
    .submit-button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
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
    <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
    <br>
    <li><a href="stockcheck.html"><i class="fas fa-clipboard-check" aria-hidden="true"></i> Check Stock</a></li>
    <br>
    <li><a href="#"><i class="fas fa-money-bills" aria-hidden="true"></i> Buy Stock</a></li>
    <br>
    <li><a href="insertStock.php"><i class="fa-solid fa-boxes-stacked" aria-hidden="true"></i> Insert Stock</a></li>
    <br>
    <li><a href="#"><i class="fas fa-receipt" aria-hidden="true"></i> Check Requests</a></li>
    <br>
    <li><a href="#"><i class="fa fa-sharp fa-light fa-ticket" aria-hidden="true"></i> View Tickets</a></li>
  </ul>
</div>

<div class="container">
  <table id="data-table">
    <thead>
      <tr>
        <th>Item</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Warehouse</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>


<button class="open-button" onclick="showPopup()">Open Pop-up</button>

  <div id="popupContainer" style="display: none;">
    <div class="popup">
      <div class="input-bar">
        Select the item <select id="dropdown" name="dropdown"></select>
      </div>
      <div class="input-bar">
        <label for="input2"></label>
       Quantity: <input type="number" id="input2">
      </div>
      <button class="submit-button" id="edit-quantity" onclick="insertQuantity()">Submit</button>
    </div>
  </div>

  <script src="../../Controller/show-stock.js"></script>
  <script src="../../Controller/add-quantity.js"></script>

  <script>
    function showPopup() {
      document.getElementById("popupContainer").style.display = "block";
    }  
  </script>

</body>

</html>