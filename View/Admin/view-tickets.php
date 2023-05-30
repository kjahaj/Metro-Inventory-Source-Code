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
                    <span>Username</span>
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
            <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a></li>
            <br>
            <li><a href="#"><i class="fas fa-clipboard-check" aria-hidden="true"></i> Check Stock</a></li>
            <br>
            <li><a href="#"><i class="fas fa-money-bills" aria-hidden="true"></i> Buy Stock</a></li>
            <br>
            <li><a href="#"><i class="fas fa-receipt" aria-hidden="true"></i> Check Requests</a></li>
            <br>
            <li><a href="#"><i class="fa fa-sharp fa-light fa-ticket" aria-hidden="true"></i> View Tickets</a></li>
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