
<?php

session_start();
$error=0;
$reg=$reg1='';
if(isset($_POST['submit'])){
	//echo '<pre>';print_r($_POST);exit;
	
	
	$errormsg=$errormsg1=$errormsg2=$errormsg3='';
	
	
  $nameuesr = $_POST['nameuesr'];
  $emailid = $_POST['emailid'];
  $password = $_POST['password'];
  $mobile = $_POST['mobile'];
  $image =$_FILES['image']['name'];
  if($nameuesr=='')
  {
	  $errormsg="enter valid number";
	  $error=1;
  }
  if($emailid!='')
  {
  $regex ="/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 
  //$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
   if(!preg_match( $regex, $emailid ))
  {
	  $errormsg1="this is not valid emailid";
	  $error=1;
  }
  } else
  {
	  $errormsg1="please enter  emailid";
	  $error=1;
  }
   if ($password=='')
  {
	  $errormsg2="please enter the password";
	  $error=1;
  }
  
  if($mobile='')
  {
	  
		$errormsg3="plese enter the mobile number";
		$error=1;
		}
		
   
  
	  
  if($error==0)
  {
	  
	
	
	$con=mysql_connect("localhost","root","");
	mysql_select_db("spc",$con);
  
  $quer1="SELECT * FROM registration WHERE emailid='".$_POST['emailid']."'";
  echo $quer1;exit;
  $result=mysql_query($quer1);
  $rows = mysql_fetch_assoc($result);
  if($rows!='')
  {
	  $reg1='<span style="color:red"> already registered</span>';
  }
  else{
  $nameuesr = $_POST['nameuesr'];
  $emailid = $_POST['emailid'];
  $password = $_POST['password'];
  $mobile = $_POST['mobile'];
  
 
  
  
  $image =$_FILES['image']['name'];
  //echo '<pre>';print_r($_FILES['image']['name']);exit;
  //echo '<pre>';print_r($_FILES['image']['name']);exit;
    move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $_FILES['image']['name']);
  //echo '<pre>';print_r($_FILES['image']['name']);exit;
  
  
  ////data base fields names registration (nameuesr, emailid, password,mobile)
  $query = "INSERT INTO registration (nameuesr, emailid, password,mobile,image) VALUES('".$nameuesr."','".$emailid."', 
  '".$password."', '".$mobile."','".$_FILES['image']['name']."')";//VALUES('$nameuesr','$emailid', '$password', '$mobile');"; assign  values
  //echo "<pre>";print_r($query);exit;
      $_SESSION['nameuesr'] = $_POST['nameuesr'];
      $_SESSION['emailid'] = $_POST['emailid'];
      $_SESSION['password'] =  $_POST['password'];    
      $_SESSION['mobile'] =  $_POST['mobile'];   
      $_SESSION['image'] =  $_FILES['image']['name'];   


  $re=mysql_query($query,$con);
  if($re!='')
  {
	 $reg='<span style="color:red">you have a successfully registered</span>';
  }
  }
 mysql_close($con);

    
  }
       
}
  ?>



<?php include('header.php');?> 
<html>
     <head>
		

      </head>
     <title>REGISTRATION</title>
   <body>
		
		<center>
		<form action="" enctype="multipart/form-data" method="POST" >
		<table>
				<h1>REGISTATION FORM</h1>
				<?php if(isset($reg)){if($reg!=''){  echo $reg;}}?>
				<?php if(isset($reg1)){if($reg1!=''){  echo $reg1;}}?>
					
			   <tr>
			   <td>USERNAME:</td>
				<td><input type="text"  name="nameuesr" value="<?php echo isset($_POST['nameuesr']) ? $_POST['nameuesr']:'' ?>" id="name"><?php if($error==1){ echo '<span style="color:red">'. $errormsg.'</span>';
				}?>
				</td>
			</tr> 
			<tr>
			  <td>EMAIL ID:</td>
			  <td><input type="text"  name="emailid" value="<?php echo isset($_POST['emailid']) ? $_POST['emailid']:'' ?>" id="email" ><?php if($error==1){ echo '<span style="color:red">'. $errormsg1.'</span>';
				}?></td>
			</tr>
			<tr>
			   <td>PASSWORD:</td>
				<td><input type="password"  name="password" value="<?php echo isset($_POST['password']) ? $_POST['password']:'' ?>" id="pass" ><?php if($error==1){ echo '<span style="color:red">'. $errormsg2.'</span>';
				}?></td>
			</tr>
			<tr>
			   <td>MOBILE NUMBER:</td>
			   <td><input type="text"  name="mobile" value="<?php echo isset($_POST['mobile']) ? $_POST['mobile']:'' ?>" id="mob" ><?php if($error==1){ echo '<span style="color:red">'. $errormsg3.'</span>';
				}?></td>
				
			</tr>
			
			<tr>
			   <td>IMAGE:</td>
			   <td><input type="file"  name="image" value="" id="image"></td>
			</tr>
			 <tr>
			   <td><input type="submit"  name="submit" value="submit"></td>
			</tr>
			
		</table>
		</form>
			</center>
	
    </body>
</html>
<?php include('footer.php');?> 
		<script src="js/jquery-1.8.0.min.js" type="text/javascript"></script>
		<script src="js/jquery.maskedinput.js"></script>
		<script type="text/javascript">
  jQuery(function($){
   $("#mob").mask("(999)/(999)/(9999)");
});


		
function myFunction() {
    var myWindow = window.open("", "MsgWindow", "width=200, height=100");
    myWindow.document.write("<p>This is 'MsgWindow'. I am 200px wide and 100px tall!</p>");
}
</script>