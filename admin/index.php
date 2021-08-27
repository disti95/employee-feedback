

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="LoginAndCSVDownload.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepickerFrom" ).datepicker();
    $( "#datepickerTo" ).datepicker();
    $( "#datepickerFrom" ).datepicker("option", "dateFormat", "yy-mm-dd");
    $( "#datepickerTo" ).datepicker("option", "dateFormat", "yy-mm-dd");
  } );
  </script>
</head>

<div id="Login_container">
    
<?php
    if(!isset($_POST["btnLogin"])) {
?>


<h2>Login Form</h2>

  <div class="container">
      <form class="login__form" method="post">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <input  type="submit" name="btnLogin" value="Login"/>

    </form>
  </div>

  



<?php
}
if(isset($_POST["btnLogin"])) {
    
    $validUsername = "admin";    
    $validPassword = "St@rt123";

    $username = $_POST['uname'];    
    $password = $_POST['psw'];
    
    if($username == $validUsername &&
       $password ==  $validPassword){
        
        
      ?>  

        <form class="dateTimePicker__form" method="post">
         <label for="dropdownObjectIds">Objekt Id:</label>
        <select id="dropdownObjectIds">
          <option value="all">Alle</option>
        </select>
        <p>Von: <input class="datePicker" type="text" id="datepickerFrom" autocomplete="off" style="width: 115px;"  name="datePickerFromName"></p>
        <p>Bis: <input class="datePicker" type="text" id="datepickerTo" autocomplete="off" style="width: 115px;" name="datePickerToName"></p>
        <input  type="submit" name="btnCreateReiwagCSV" value="Download Reiwag CSV"/>
        <input  type="submit" name="btnCreateLewagCSV" value="Download Lewag CSV"/>
        </form>


       <?php         
    }else{
       ?>
    <h2>Login Form</h2>

  <div class="container">
      <form class="login__form" method="post">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <input  type="submit" name="btnLogin" value="Login"/>
    
    <p name="errorText" class="errorMessage"><b>Username or password invalid!</b></p>

    </form>
  </div>
    
    <?php 
    }
}
    
  ?>
</div>


<?php 
if(isset($_POST["btnCreateReiwagCSV"]) || isset($_POST["btnCreateLewagCSV"])) {
    include 'DownloadCSV.php';
}
    
  ?>





























    
    
