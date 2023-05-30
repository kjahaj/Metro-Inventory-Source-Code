<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <title>Log In Page</title>
  <link rel="stylesheet" href="../../Asset/CSS/logIn.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="../../Controller/showPass.js"></script>
</head>

<body id="bg1">

  <div id="regForm">
    <div class="header"><img class="image" src="../../Asset/Images/umt.png" alt="MetroInventory Logo"></div>
    <form action="loginprocess.php" method="POST"><br><br>
      <div class="form-field email">
        <i class="fas fa-envelope"></i>
        <input class="email" type="email" name="email" placeholder="Email" required="" />
      </div>

      <div class="form-field">
        <i class="fas fa-key"></i>
        <input class="password" type="password" name="password" id="password" placeholder="Password" required />
        <span class="passSpan">
          <i class="fas fa-eye" id="eye" onclick="showPass()"></i>
        </span>
        
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
  <script>
    let state = false;
function showPass(){
  const passwordInput = document.getElementById("password");
  const eyeThing = document.getElementById("eye");
    if(state){
        passwordInput.setAttribute("type","password");
        eyeThing.style.color = "grey";
        state = false;
    }
    else{
        passwordInput.setAttribute("type","text");
        eyeThing.style.color = "dodgerblue";
        state = true;
    }
    
}
  </script>


</body>

</html>