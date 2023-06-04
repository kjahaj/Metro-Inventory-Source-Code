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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css" integrity="sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Admin</title>
  <style>
    .main-container {
      display: fixed;
      justify-content: center;
      align-items: center;
      margin-left: 0%;
      margin-top: 5%;
      padding-left: 5%;
      padding-right: 5%;
    }

    #ticket-container {
      display: inline-flex;
      flex-direction: column;
      justify-content: center;
      height: 100%;
      width: 100%;
      overflow-x: unset;
      align-items: center;
      background-color: white;
      margin-top: 10px;
    }

    .createT {
      display: flex;
      justify-content: right;
      align-items: center;
      height: 70px;
      background-color: white;
      margin-top: 8%;
    }

    .create-ticket-button {
      width: auto;
      height: auto;
      background-color: dodgerblue;
      color: white;
      padding: 10px 10px;
      border: none;
      border-radius: 5px;
      font-size: 20px;
      margin-top: auto;
      margin-bottom: auto;
      margin-right: 5%;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    .create-ticket-button:hover{
      transform: scale(1.1);
    }

    .popup {
      display: none;
      position: fixed;
      z-index: 2;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      width: 90%;
      max-width: 400px;
      padding: 30px;
      background-color: #e1f0f7;
      border-radius: 4px;
      box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
      align-items: left;
    }

    .popup h2 {
      margin-bottom: 20px;
    }

    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      color: #888;
      cursor: pointer;
    }

    .close:hover {
      color: #555;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      text-align: left;
    }

    input[type="text"],
    textarea,
    select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    .popup select {
      width: auto;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
    }

    .popup textarea {
      width: 100%;
      height: 150px;
      resize: vertical;
      min-height: 50px;
      max-height: 200px;
      overflow-y: auto;
    }

    button[type="submit"] {
      width: 50%;
      height: auto;
      background-color: #4caf50;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      margin-left: 25%;
      margin-right: 25%;
    }

    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      /* background-color: rgba(0, 128, 0, 0.5); */
      backdrop-filter: blur(3px);
      z-index: 1;
    }

    .ticket {
      margin-top: 10px;
      margin-left: 5%;
      margin-right: 5%;
      width: 90%;
      margin-bottom: 10px;
      align-items: center;
      display: flex;
      border: 1px solid #ccc;
      padding: 10px;
    }

    .details {
      font-size: 15px;
      flex: 1;
    }

    .title {
      font-weight: bold;
      font-size: 25px;
    }

    .status {
      font-size: 15px;
      font-style: italic;
      color: green;
    }

    .closed {
      color: red;
    }

    .actions {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .button {
      width: auto;
      background-color: #6FB8FF;
      color: white;
      border: none;
      padding: 5px 10px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 15px;
      cursor: pointer;
      border-radius: 4px;
      transition: all 0.3s ease;
    }
    .button:hover{
      transform: scale(1.1);
    }
    .main-container {
  transition: margin-left 0.4s ease;
}
  </style>
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
    <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
    <br>
    <li><a href="stockcheck.php"><i class="fas fa-clipboard-check" aria-hidden="true"></i> Check Stock</a></li>
    <br>
    <li><a href="#"><i class="fas fa-money-bills" aria-hidden="true"></i> Buy Stock</a></li>
    <br>
    <li><a href="insertStock.php"><i class="fa-solid fa-boxes-stacked" aria-hidden="true"></i> Insert Stock</a></li>
    <br>
    <li><a href="view-tickets.php"><i class="fa fa-sharp fa-light fa-ticket" aria-hidden="true"></i> View Tickets</a></li>
    <br>

  </ul>
</div>

<div class="main-container">

  <div class="createT">
    <button id="openCT" class="create-ticket-button">Create Ticket</button>

    <div id="myPopup" class="popup">
      <span class="close">&times;</span>
      <h2>Create a Ticket</h2>

      <form action="../../Model/create-ticket.php" method="POST">
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
          <label for="message">Message:</label>
          <textarea id="message" name="message" required></textarea>
        </div>

        <div class="form-group">
          <label for="group">Group:</label>
          <select id="group" name="group" required>
            <option value="SERVICE">SERVICE</option>
            <option value="IT">IT</option>
          </select>
        </div>

        <button type="submit" name="createTicket">Submit</button>
      </form>
    </div>

    <div id="overlay"></div>
  </div>

  <div id="ticket-container"></div>
</div>



<script src="../../Controller/show-tickets.js"></script>

<script>
  var btn = document.querySelector('.toggle');
var btnst = true;
btn.onclick = function() {
  var sidebar = document.getElementById('sidebar');
  var container = document.querySelector('.main-container');

  if (btnst) {
    document.querySelector('.toggle span').classList.add('toggle');
    sidebar.classList.add('sidebarshow');
    container.style.marginLeft = "15%";
  } else {
    document.querySelector('.toggle span').classList.remove('toggle');
    sidebar.classList.remove('sidebarshow');
    container.style.marginLeft = "0%";
  }

  btnst = !btnst;
};


  document.getElementById("openCT").addEventListener("click", function() {
    document.getElementById("myPopup").style.display = "block";
    document.getElementById("overlay").style.display = "block";
  });

  document.getElementsByClassName("close")[0].addEventListener("click", function() {
    document.getElementById("myPopup").style.display = "none";
    document.getElementById("overlay").style.display = "none";
  });
</script>

</body>

</html>