<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_theme")
	{
		save_theme();
		exit;
	}
	if($_REQUEST[act]=="delete_theme")
	{
		delete_theme();
		exit;
	}
	###Code for save theme#####
	function save_theme()
	{
		global $con;
		$R=$_REQUEST;
		if($R[theme_id])
		{
			$statement = "UPDATE `theme` SET";
			$cond = "WHERE `theme_id` = '$R[theme_id]'";
			$msg = "Data Updated Successfully.";
		}
		else
		{
			$statement = "INSERT INTO `theme` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				`theme_title` = '$R[theme_title]', 
				`theme_description` = '$R[theme_description]'". 
				 $cond;
		$rs = mysqli_query($con,$SQL) or die(mysqli_error($con));
		header("Location:../theme-report.php?msg=$msg");
	}
#########Function for delete theme##########3
function delete_theme()
{
	global $con;
	/////////Delete the record//////////
	$SQL="DELETE FROM theme WHERE theme_id = $_REQUEST[theme_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	
	header("Location:../theme-report.php?msg=Deleted Successfully.");
}
?>