<?php

session_start();

$sessionID = session_id();
          setcookie('session_cookie', $sessionID, time() + 3600, '/');
          
function generateToken( $formName )
{

return $_SESSION['csrftoken'] = base64_encode(openssl_random_pseudo_bytes(32));
}
  
function checkToken( $token)
{

    return $token ===$_SESSION['csrftoken'];
}


if (!$_SESSION["user"]) {

    header('Location: index.php');
    exit();

} else {

    echo '<center><div class="container">  <div class="alert alert-success alert-dismissible fade in">

    <strong>Login Successful!! Welcome</strong>
  </div></div></center>';

}
if (isset($_POST['csrftoken']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['message'])) {

    if (checkToken($_POST['csrftoken'])) {
      echo '<center><div class="container">  <div class="alert alert-success alert-dismissible fade in">
You have successfuly updated your details!
    </div></div></center>';


    } else {

      echo '<center><div class="container">  <div class="alert alert-danger alert-dismissible fade in">
      Invalid CSRF token!
    </div></div></center>';
    }

}



?>


<head>
  <meta charset="UTF-8">
  <title>Update User Profile Details</title>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

	<div class="background-wrap">
	<div class="background"></div>
	</div>
	
<form id="accesspanel" method="post" align="center">
  <h1 id="litheader">UPDATE USER DETAILS</h1>
  <div class="inset">
    <p>
      <input type="text" name="fname" id="fname" placeholder="First Name" align="center">
    </p>
    <p>
      <input type="text" name="lname" id="lname" placeholder="Last Name" align="center">
    </p>
    <p>
      <input type="text" name="message" id="message" placeholder="Message" align="center">
   
	<input id="login-username" type="hidden" class="form-control" name="csrftoken" value=<?php echo '"' . generateToken('sec') . '"';?>>
   
  </div>
  <p class="p-container">
    <input type="submit" name="update" id="go" value="Update">
	<center><a href="logout.php">Logout</a></center>
  </p>
  
  
  
</form>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>

</html>
