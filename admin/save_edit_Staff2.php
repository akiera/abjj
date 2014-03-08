<?php 
session_start();
$usertype = $_SESSION["user_type"];
if ($usertype!='1')   // 1 = user for administrator
{
header('Location:../');
exit();
}

include '../connection/data2.php';

$username=$_SESSION['username'];
$user_ic=$_SESSION['user_ic'];
$staff_ic =$_SESSION['staff_ic'];

$staffname = $_POST['staffname'];
$staffIC = $_POST['staffic'];
$staffsex = $_POST['staffsex'];
$staffaddress = $_POST['staffadd'];
$staffpostcode = $_POST['staffpostcode'];
$stafftown = $_POST['stafftown'];
$staffState = $_POST['staffstate'];
$staffphone = $_POST['stafftel'];
$staffemail = $_POST['staffemail'];
$staffposition = $_POST['staffcate'];


if($staffposition=='Admin')
{

$query = "UPDATE t_staff SET staff_name='$staffname', staff_ic='$staffIC', staff_sex='$staffsex', staff_add='$staffaddress', staff_post='$staffpostcode', staff_town='$stafftown', staff_state='$staffState', staff_tel='$staffphone', staff_email='$staffemail',  staff_cat='$staffposition', user_type='1' WHERE staff_ic='". $_SESSION["staff_ic"]."'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());
	
$query1="UPDATE logins SET user_type='1' WHERE user_ic='". $_SESSION["staff_ic"]."'";
$result1=mysql_query($query1) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Staff data has been updated successfully!');";
	print "window.location='?p=viewstaff&staff_ic=$staff_ic'";
	print "</script> ";
 }
 
 
 else if($staffposition=='Staff')
{
$query = "UPDATE t_staff SET staff_name='$staffname', staff_ic='$staffIC', staff_sex='$staffsex', staff_add='$staffaddress', staff_post='$staffpostcode', staff_town='$stafftown', staff_state='$staffState', staff_tel='$staffphone', staff_email='$staffemail',  staff_cat='$staffposition', user_type='2' WHERE staff_ic='". $_SESSION["staff_ic"]."'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());
	
$query1="UPDATE logins SET user_type='2' WHERE user_ic='". $_SESSION["staff_ic"]."'";
$result1=mysql_query($query1) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Staff data has been updated successfully!');";
	print "window.location='viewstaff.php?staff_ic=$staff_ic'";
	print "</script> ";
}
else if($staffposition=='Customer')
{
$query = "UPDATE t_staff SET staff_name='$staffname', staff_ic='$staffIC', staff_sex='$staffsex', staff_add='$staffaddress', staff_post='$staffpostcode', staff_town='$stafftown', staff_state='$staffState', staff_tel='$staffphone', staff_email='$staffemail',  staff_cat='$staffposition', user_type='3' WHERE staff_ic='". $_SESSION["staff_ic"]."'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());
	
$query1="UPDATE logins SET user_type='3' WHERE user_ic='". $_SESSION["staff_ic"]."'";
$result1=mysql_query($query1) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Staff data has been updated successfully!');";
	print "window.location='?p=viewstaff&staff_ic=$staff_ic'";
	print "</script> ";
}

/*		
 if ($staffname == null)
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
   require_once("edit_Staff.php");
	echo "<script type='text/javascript'>
	alert(' Please fill in staff name! ');
  </script> ";
}

else if ($staffIC == null)
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
	echo "<script type='text/javascript'>
	alert(' Please fill in your IC number! ');
  </script> ";
  require_once("edit_Staff.php");
}

else if (!ereg("01(0|2|3|4|6|7|9)-[0-9]{7}",$staffphone))
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
	
  require_once("edit_Staff.php");
	echo "<script type='text/javascript'>
	alert(' Invalid phone number, please fill in the correct number with symbol - ');
  </script>";
}

else if ($staffaddress == null)
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
	echo "<script type='text/javascript'>
	alert(' Please fill in the address! ');
  </script> ";
  require_once("edit_Staff.php");
}

else if ($staffpostcode == null)
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
	echo "<script type='text/javascript'>
	alert(' Please fill in the postcode! ');
  </script> ";
  require_once("edit_Staff.php");
}

else if (!ereg("[0-9]{5}",$staffpostcode))
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
	echo "<script type='text/javascript'>
	alert(' Invalid postcode! ');
  </script> ";
  require_once("edit_Staff.php");
}

else if ($stafftown == null)
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
	echo "<script type='text/javascript'>
	alert(' Please fill in town! ');
  </script> ";
  require_once("edit_Staff.php");
}

else if ($staffState == null)
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
	echo "<script type='text/javascript'>
	alert(' Please choose the state! ');
  </script> ";
  require_once("edit_Staff.php");
}

else if ($staffposition == null)
{		
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
  
	echo "<script type='text/javascript'>
	alert(' Please choose the position! ');
  </script> ";
  require_once("edit_Staff.php");
}

else if (!ereg(".+@(.+\.)+.+",$staffemail) && $staffemail!=null)
{
	$staffname = "staffname";
	$staffIC = "staffic";
	$staffsex = "staffsex";
	$staffaddress = "staffadd";
	$staffpostcode = "staffpostcode";
	$stafftown = "stafftown";
	$staffState = "staffstate";
	$staffphone = "stafftel";
	$staffemail = "staffemail";
	$staffposition = "staffcate";
   
	echo "<script type='text/javascript'>
	alert(' Invalid email address, please type again! ');
  </script> ";
  require_once("edit_Staff.php");

}

else{

if($staffposition=='Admin')
{

$query = "UPDATE t_staff SET staff_name='$staffname', staff_ic='$staffIC', staff_sex='$staffsex', staff_add='$staffaddress', staff_postcode='$staffpostcode', staff_town='$stafftown', staff_state='$staffState', staff_tel='$staffphone', staff_email='$staffemail',  staff_cate='$staffposition', user_type='1' WHERE staff_ic='". $_SESSION["staff_ic"]."'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());
	
$query1="UPDATE logins SET user_type='1' WHERE user_ic='". $_SESSION["staff_ic"]."'";
$result1=mysql_query($query1) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Staff data has been updated successfully!');";
	print "window.location='viewstaff.php?staff_ic=$staff_ic'";
	print "</script> ";
 }
 
 
 else if($staffposition=='Staff')
{
$query = "UPDATE t_staff SET staff_name='$staffname', staff_ic='$staffIC', staff_sex='$staffsex', staff_add='$staffaddress', staff_postcode='$staffpostcode', staff_town='$stafftown', staff_state='$staffState', staff_tel='$staffphone', staff_email='$staffemail',  staff_cate='$staffposition', user_type='2' WHERE staff_ic='". $_SESSION["staff_ic"]."'";
$result=mysql_query($query) or die ('Data staff cannot be reached. ' . mysql_error());
	
$query1="UPDATE logins SET user_type='2' WHERE user_ic='". $_SESSION["staff_ic"]."'";
$result1=mysql_query($query1) or die ('Data staff cannot be reached. ' . mysql_error());

	echo "<script>alert('Staff data has been updated successfully!');";
	print "window.location='viewstaff.php?staff_ic=$staff_ic'";
	print "</script> ";
}
}
*/
?>