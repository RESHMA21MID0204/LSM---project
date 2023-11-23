<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_user")
	{
		save_user();
		exit;
	}
	if($_REQUEST[act]=="delete_user")
	{
		delete_user();
		exit;
	}
	if($_REQUEST[act]=="get_report")
	{
		get_report();
		exit;
	}
	###Code for save user#####
	function save_user()
	{
		global $con;
		$R=$_REQUEST;
		///Checking Username Exits or not ////
		$SQL="SELECT * FROM user WHERE user_username = '$_REQUEST[user_username]'";

		$rs=mysqli_query($con,$SQL);
		if($rs) {
			$data=mysqli_fetch_assoc($rs);
			if($data['user_username'] && $R['user_id'] == "") {
				header("Location:../user.php?msg=Username Already Exits. Kindly choose another....");
				return;
			}
		}
		/////////////////////////////////////
		$image_name = $_FILES[user_image][name];
		$location = $_FILES[user_image][tmp_name];
		if($image_name!="")
		{
			move_uploaded_file($location,"../uploads/".$image_name);
		}
		else
		{
			$image_name = $R[avail_image];
		}
		if($R[user_id])
		{
			$statement = "UPDATE `user` SET";
			$cond = "WHERE `user_id` = '$R[user_id]'";
			$msg = "Data Updated Successfully.";
			
		}
		else
		{
			$statement = "INSERT INTO `user` SET";
			$cond = "";
			$conditions = "
				`user_level_id` = '$R[user_level_id]', 
				`user_username` = '$R[user_username]', 
				`user_password` = '$R[user_password]',";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				$conditions
				`user_name` = '$R[user_name]', 
				`user_add1` = '$R[user_add1]', 
				`user_add2` = '$R[user_add2]', 
				`user_city` = '$R[user_city]', 
				`user_state` = '$R[user_state]', 
				`user_country` = '$R[user_country]', 
				`user_email` = '$R[user_email]', 
				`user_mobile` = '$R[user_mobile]', 
				`user_gender` = '$R[user_gender]', 
				`user_dob` = '$R[user_dob]',
				`user_image` = '$image_name'". 
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		if(!$_SESSION['login'])
		{
			header("Location:../login.php?msg=You are registered successfully. Login with your credential !!!");
			exit;
		}
		if($_SESSION['user_details']['user_level_id'] == 2)
		{
			header("Location:../user.php?user_id=$R[user_id]&msg=Your account has been updated successfully !!!");
			exit;
		}
		header("Location:../user-report.php?msg=$msg");
	}
#########Function for delete user##########3
function delete_user()
{
	global $con;
	$SQL="SELECT * FROM user WHERE user_id = $_REQUEST[user_id]";
	$rs=mysqli_query($con,$SQL);;
	$data=mysqli_fetch_assoc($rs);
	
	/////////Delete the record//////////
	$SQL="DELETE FROM user WHERE user_id = $_REQUEST[user_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	
	//////////Delete the image///////////
	if($data[user_image])
	{
		unlink("../uploads/".$data[user_image]);
	}
	header("Location:../user-report.php?msg=Deleted Successfully.");
}
##############Function for reporting ##################3
function get_report()
{
$fname = 'myCSV.csv';
$fp = fopen($fname,'w');
$column_name = '"ID","user_name","user_add1","user_add2","user_state","user_email","user_city","user_mobile","user_gender","user_dob","user_nl_id","user_image"'."\n\r";
fwrite($fp,$column_name);	
	
$SQL="SELECT * FROM user,city WHERE user_city = city_id";
$rs=mysqli_query($con,$SQL);;
while($data=mysqli_fetch_assoc($rs))
{
	$csvdata=implode(",",$data)."\n\r";
	fwrite($fp,$csvdata);		
}
fclose($fp);
header('Content-type: application/csv');
header("Content-Disposition: inline; filename=".$fname);
readfile($fname);
}
?>
