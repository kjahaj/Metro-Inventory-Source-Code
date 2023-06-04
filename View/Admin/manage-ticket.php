<?php
include '../../Model/user.php';
include '../../Model/session.php';
$ticketID = $_GET['ticketID'];
$groupID = $user->getGroupID();

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
  #main-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 5%;
    margin-top: 5%;
  }

  #ticket-container {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    border-radius: 4px;
    box-shadow: 7px 8px #135CA3;
  }
  .ticket {
    padding: 35px;
    margin-bottom: 10px;
    border-radius: 4px;
  }

  .title-field {
    width: 100%;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
    border-radius: 4px;
  }

  .message-textarea {
    width: 100%;
    height: 100px;
    resize: vertical;
    margin-bottom: 10px;
    resize: none;
    border-radius: 4px;
  }

  .status-group-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }

  .status-label {
    display: inline-block;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-weight: bold;
    margin-right: 10px;
    color: white;
  }

  .complete {
    background-color: red;
  }

  .active {
    background-color: #32de84;
  }
  .group-container {
    display: flex;
    align-items: center;
    margin-right: 10px;
  }

  p {
    margin-bottom: 5px;
  }

  .edit-button,
  .close-ticket-button {
    padding: 5px 10px;
    margin-top: 10px;
    background-color: dodgerblue;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: auto;
    height: auto;
  }

  .edit-button:hover,
  .close-ticket-button:hover {
    background-color: #45a049;
  }
  #main-container {
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
    <li><a href="index"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
    <br>
    <li><a href="stockcheck"><i class="fas fa-clipboard-check" aria-hidden="true"></i> Check Stock</a></li>
    <br>
    <li><a href="#"><i class="fas fa-money-bills" aria-hidden="true"></i> Buy Stock</a></li>
    <br>
    <li><a href="insertStock"><i class="fa-solid fa-boxes-stacked" aria-hidden="true"></i> Insert Stock</a></li>
    
    <br>
    <li><a href="view-tickets"><i class="fa fa-sharp fa-light fa-ticket" aria-hidden="true"></i> View Tickets</a></li>
    <br>

  </ul>
</div>

<div id="main-container">
  <div id="ticket-container">
    <div class="ticket">
      <input type="text" class="title-field" readonly>
      <textarea class="message-textarea" readonly></textarea>
      <div class="status-group-container">
        <label class="status-label"></label>
        <div class="group-container">
          <p></p>
        </div>
      </div>
      <p>Sender:</p>
      <!-- <button class="edit-button">EDIT</button> -->
      <button class="close-ticket-button">CLOSE TICKET</button>
    </div>
  </div>
</div>

<script>
  var ticketID = "<?php echo $ticketID; ?>";
  var groupID = "<?php echo $groupID; ?>";
</script>
<script src="../../Controller/display-ticket.js"></script>
<script>
  var btn = document.querySelector('.toggle');
  var btnst = true;
  btn.onclick = function() {
    if (btnst == true) {
      document.querySelector('.toggle span').classList.add('toggle');
      document.getElementById('sidebar').classList.add('sidebarshow');
      var div = document.getElementById("main-container");
      div.style.marginLeft = "15%";
      btnst = false;
    } else if (btnst == false) {
      document.querySelector('.toggle span').classList.remove('toggle');
      document.getElementById('sidebar').classList.remove('sidebarshow');
      var div = document.getElementById("main-container");
      div.style.marginLeft = "0%";
      btnst = true;
    }
  }
</script>

</body>

</html>