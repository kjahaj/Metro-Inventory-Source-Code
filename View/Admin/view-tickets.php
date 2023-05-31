<?php
include "../../Model/user.php";
include '../../Model/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tickets</title>
    <link rel="stylesheet" href="../../Asset/CSS/admin.css">
    <link rel="stylesheet" href="../../Asset/CSS/ticket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />

</head>

<body>
    <style>
#ticket-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 10vh;
}

.ticket {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    width: 600px;
}

.left-container {
    flex: 1;
    display: flex;
    align-items: center;
}

.title-status-container {
    display: flex;
    align-items: center;
    justify-content: center;
}

.title {
    margin-right: 10px;
}

.status {
    font-weight: bold;
}

.right-container {
    flex: 1;
    text-align: right;
}

.label {
    margin: 0;
    color: #999;
}

.creation-date {
    margin: 0;
}

.sender {
    margin: 0;
}

.container {
    display: flex;
    justify-content: flex-end;
}

.container button {
    padding: 10px 20px;
    background-color: dodgerblue;
    color: white;
    border: none;
    cursor: pointer;
    max-width: 200px;
}

.popup {
    display: none;
    position: fixed;
    z-index: 2;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 4px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
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

.popup textarea {
    width: 100%;
    max-width: 100%;
    height: 150px;
    max-height: 150px;
    resize: vertical;
    overflow-y: auto;
}

button[type="submit"] {
    background-color: dodgerblue;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
}



#overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    z-index: 1;
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
            <li><a href="view-tickets.php"><i class="fa fa-sharp fa-light fa-ticket" aria-hidden="true"></i> View Tickets</a></li>
        </ul>
    </div>

    <div id="ticket-container" class="container">
        <button id="openCT">Create Ticket</button>

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

                <button type="submit" name="createTicket">Create Ticket</button>
            </form>
        </div>

        <div id="overlay"></div>

    </div>
    

    <footer id="footer">
        <p>&copy; 2023 Admin Dashboard. All rights reserved.</p>
    </footer>

    <script src="../../Controller/show-tickets.js"></script>
    <script>
        document.getElementById("openCT").addEventListener("click", function() {
            document.getElementById("myPopup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        });

        document.getElementsByClassName("close")[0].addEventListener("click", function() {
            document.getElementById("myPopup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        });

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
</body>

</html>