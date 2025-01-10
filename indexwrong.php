<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/sidebar.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body {
  font-family: "Lato", sans-serif;
  color: #cc7a00;
  background-image:url('');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #ffffff;
  position:fixed;
}


body {
  font-family:'Poppins', sans-serif;
  color: #fff;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #000;
  }

table {
	width: 100%;
	text-align: left;
}

table td {
	padding: 0.5em 1em 0.5em 1em;
}

table th {
	text-align: left;
	padding: 0.5em 1em 0.5em 1em;
				
}
  
fieldset{
 width : 500px;
 height: 300px;
 border-width: 5px; 
}

.main {
  margin-left: 420px; 

}

div{
  max-width: 500px;
  height: 100px;
}

#id{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
}  
#password{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;     
}  

#log{  
  position: relative;
		display: inline-block;
		border-radius: 0.35em;
		color: #333 !important;
		text-decoration: none;
		padding: 1em 5em 1em 5em;
		background-color: #07f757 ;
		border: 0;
		cursor: pointer;
		
		-moz-transition: background-color 0.35s ease-in-out;
		-webkit-transition: background-color 0.35s ease-in-out;
		-ms-transition: background-color 0.35s ease-in-out;
		transition: background-color 0.35s ease-in-out;
	} 

  a:link {
  color: #07f757;
  background-color: transparent;
  text-decoration: none;
}

</style>
</head>
<body>

  <div class="main">

    <center><h1>F&J Delivery </h1></center>
    <center><img src="F&J noBG.png" style="width: 150px; height: 150px; border-radius: 12px;"></center>
    <h3></h3>
    <div style="padding:0px" id="about">
      <div style="padding:0px" id="about">
        <div style="margin-top:20px">
    <h3></h3>
    <fieldset>
     <center> <form method="POST" action="process.php">
    
        <h1>Login</h1>
        <p></p>
      
        <table width="900%">
         
            <tr>
              <td colspan="2" style="color:red; font-weight:bold; ">Wrong ID or Password</td>
            </tr>
          </tr>
          <tr>
            <td>ID (NRIC)</td>
            <td> <input type="text" placeholder="Enter ID" name="id" id="id"required></td>
          </tr>
          <tr>
            <td>Password</td>
            <td> <input type="password" placeholder="Enter Password" name="password" id="password" required></td>
            </tr>
          <tr>
            <td colspan="2"> 
              <center><input type="submit" class="signupbtn" name="login" id="log" value="Log In"></center>    
            </td></center>
            <tr>
          </tr> 
           <tr>
              <td colspan="2" align="center">Don't have an account? <a href="../signup/Register.php" style="color:#07f757;">SignUp</a></td> 
            </tr>
        </table> 
      </form></center>
    </fieldset>

  </div>
   
</body>
</html> 
