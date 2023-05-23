<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Log In Page</title>
  <link rel="stylesheet" href="../../Asset/CSS/logIn.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body id="bg1">

  <div id="regForm">
    <div class="header"><img src="../../Asset/Images/umt.png" alt="MetroInventory Logo"></div>
    <form action="loginprocess.php" method="POST"><br><br>
      <div class="form-field email">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" required = ""/>
      </div>

      <div class="form-field password">
        <i class="fas fa-key"></i>
        <input type="password" name="password" placeholder="Password" required />
      </div>
      <div class="form-field">
      <button class="btn" type="submit" name="sub">Login</button>
      </div>
      <p><b>
          <hr>
        </b></p>
      <div class="form-field">
      <button class="btn" type="submit">UMT LOGIN</button>
      </div>
      <?php
      if (isset($_REQUEST["err"]))
        $msg = "Invalid username or Password";
      ?>
      <p style="color:red;">
        <?php if (isset($msg)) {
          echo $msg;
        }
        ?>
    </form>
  </div>


</body>

</html>