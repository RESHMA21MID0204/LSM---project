<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_programs")
	{
		save_programs();
		exit;
	}
	if($_REQUEST[act]=="delete_programs")
	{
		delete_programs();
		exit;
	}
	if($_REQUEST[act]=="get_report")
	{
		get_report();
		exit;
	}
	###Code for save programs#####
	function save_programs()
	{
		global $con;
		$R=$_REQUEST;
		/////////////////////////////////////
		$image_name = $_FILES[programs_image][name];
		$location = $_FILES[programs_image][tmp_name];
		if($image_name!="")
		{
			move_uploaded_file($location,"../uploads/".$image_name);
		}
		else
		{
			$image_name = $R[avail_image];
		}
		if($R[programs_id])
		{
			$statement = "UPDATE `programs` SET";
			$cond = "WHERE `programs_id` = '$R[programs_id]'";
			$msg = "Data Updated Successfully.";
			
		}
		else
		{
			$statement = "INSERT INTO `programs` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				`programs_title` = '$R[programs_title]', 
				`programs_event_id` = '$R[programs_event_id]', 
				`programs_ptype_id` = '$R[programs_ptype_id]', 
				`programs_start_time` = '$R[programs_start_time]', 
				`programs_end_time` = '$R[programs_end_time]', 
				`programs_participants` = '$R[programs_participants]', 
				`programs_description` = '$R[programs_description]', 
				`programs_image` = '$image_name'". 
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		if(!$_SESSION['login'])
		{
			header("Location:../login.php?msg=You are registered successfully. Login with your credential !!!");
			exit;
		}
		header("Location:../programs-report.php?msg=$msg");
	}
#########Function for delete programs##########3
function delete_programs()
{
	global $con;
	$SQL="SELECT * FROM programs WHERE programs_id = $_REQUEST[programs_id]";
	$rs=mysqli_query($con,$SQL);;
	$data=mysqli_fetch_assoc($rs);
	
	/////////Delete the record//////////
	$SQL="DELETE FROM programs WHERE programs_id = $_REQUEST[programs_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	
	//////////Delete the image///////////
	if($data[programs_image])
	{
		unlink("../uploads/".$data[programs_image]);
	}
	header("Location:../programs-report.php?msg=Deleted Successfully.");
}
?>
