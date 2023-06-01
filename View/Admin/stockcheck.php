<?php
include "../../Model/user.php";
include '../../Model/session.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../../Asset/CSS/admin.css">
  <link rel="stylesheet" href="../../Asset/CSS/stockcheck.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />
  <title>Admin</title>
</head>
<body>
  <style>
    .open-button {
    background-color: #2f40a0;
    border: none;
    color: white;
    padding: 7px 40px;
    
    justify-content: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
  
    
  }
  .buttonContainer{
    margin-left: 50%;
    
  }
  .buttonContainer button{
    display: flex;
  justify-content: center;
  margin-top: 20px;
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

  
  

  @media (max-width: 768px) {
      .container {
        overflow-x: auto;
      }
    }

    /* Hide the table header on smaller screens */
    @media (max-width: 480px) {
      #data-table thead {
        display: none;
        font-size: 10px;
      }
    }

    /* Display table rows as blocks on smaller screens */
    @media (max-width: 768px) {
      #data-table tbody,
      #data-table tr,
      #data-table td {
        display: block;
      }
    }

    /* Adjust the individual table cells */
    @media (max-width: 768px) {
      #data-table td {
        text-align: right;
        padding: 10px;
        white-space: nowrap;
      }
      #data-table td:before {
        content: attr(data-label);
        display: inline-block;
        font-weight: bold;
        margin-right: 5px;
      }
    }
    .container th{
      text-align: center;
    }

    /* Pop up container-i*/ 
    
    #popupContainer {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    z-index: 9999;
    max-width: 400px;
    width: 100%;
    border-radius: 4px;
  }

  /* Styles for the input bar */
  .input-bar {
    margin-bottom: 30px;
  }

  /* Styles for the submit button */
  .submit-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
  }
  /* The box after we press the button*/
  .popup{
      padding: 50px;
      border-radius: 4px;
  }
  .popup #dropdown{
    height: 20px;
  }
  .popup #input2{
    height: 20px;
  }
  .popup button{
    background-color: dodgerblue;
    border-radius: 4px;
    margin-left: 25%;
    margin-right: 25%;
    padding-left: 10px;
    padding: 7px 8px;
    font-size: 14px;
    width: 65px;
  }

  .close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 20px;
    color: #999;
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
    <li><a href="stockcheck.php"><i class="fas fa-clipboard-check" aria-hidden="true"></i> Check Stock</a></li>
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

<div class="buttonContainer">
  <button class="open-button" onclick="showPopup()">Edit Quantity</button>
</div>

<div id="popupContainer" style="display: none;">
  <div class="popup">
    <span class="close-button" onclick="closePopup()">&times;</span>
    <div class="input-bar">
      Select the item:  <select id="dropdown" name="dropdown"></select>
    </div>
    
    <div class="input-bar">
      <label for="input2">Quantity:</label>
      <input type="number" id="input2">
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


  function closePopup() {
    document.getElementById("popupContainer").style.display = "none";
  }
</script>

</body>

</html>