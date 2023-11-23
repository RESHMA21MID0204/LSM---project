<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_event")
	{
		save_event();
		exit;
	}
	if($_REQUEST[act]=="register")
	{
		register();
		exit;
	}
	if($_REQUEST[act]=="delete_event")
	{
		delete_event();
		exit;
	}
	if($_REQUEST[act]=="get_report")
	{
		get_report();
		exit;
	}
	###Code for save event#####
	function save_event()
	{
		global $con;
		$R=$_REQUEST;
		/////////////////////////////////////
		$image_name = $_FILES[event_image][name];
		$location = $_FILES[event_image][tmp_name];
		if($image_name!="")
		{
			move_uploaded_file($location,"../uploads/".$image_name);
		}
		else
		{
			$image_name = $R[avail_image];
		}
		if($R[event_id])
		{
			$statement = "UPDATE `event` SET";
			$cond = "WHERE `event_id` = '$R[event_id]'";
			$msg = "Data Updated Successfully.";
			
		}
		else
		{
			$statement = "INSERT INTO `event` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				`event_title` = '$R[event_title]', 
				`event_theme_id` = '$R[event_theme_id]', 
				`event_status_id` = '$R[event_status_id]', 
				`event_minimum_guest` = '$R[event_minimum_guest]', 
				`event_maximum_guest` = '$R[event_maximum_guest]', 
				`event_date` = '$R[event_date]', 
				`event_description` = '$R[event_description]', 
				`event_image` = '$image_name'". 
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		if(!$_SESSION['login'])
		{
			header("Location:../login.php?msg=You are registered successfully. Login with your credential !!!");
			exit;
		}
		header("Location:../event-report.php?msg=$msg");
	}
#########Function for delete event##########3
function delete_event()
{
	global $con;
	$SQL="SELECT * FROM event WHERE event_id = $_REQUEST[event_id]";
	$rs=mysqli_query($con,$SQL);;
	$data=mysqli_fetch_assoc($rs);
	
	/////////Delete the record//////////
	$SQL="DELETE FROM event WHERE event_id = $_REQUEST[event_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	
	//////////Delete the image///////////
	if($data[event_image])
	{
		unlink("../uploads/".$data[event_image]);
	}
	header("Location:../event-report.php?msg=Deleted Successfully.");
}
#########Function for delete event##########3
function register()
{
	if($_SESSION['login'] != 1) {
		header("location:../login.php?msg=Login to your account to register for the event..");
	}
	global $con;
	$SQL="INSERT INTO event_registration SET er_event_id = $_REQUEST[event_id], er_student_id = ".$_SESSION['user_details']['user_id'];
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	header("Location:../event_details.php?event_id=$_REQUEST[event_id]&msg=You have registered successfully for the event..");
}
?>
