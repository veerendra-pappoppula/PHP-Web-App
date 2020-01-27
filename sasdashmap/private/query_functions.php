<?php

	function fetch_dashboard()
		{

		global $db;

		$sql="SELECT * from dashboards order by category";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		return $result;

	}

	function fetch_distinct_category()
		{

		global $db;

		$sql="SELECT distinct category from dashboards order by category";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		return $result;

	}

	function fetch_dashboard_report_id($report_id)
		{

		global $db;

		$sql="SELECT * from dashboards where report_id='".$report_id."'";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		$subject = mysqli_fetch_assoc($result);
    	mysqli_free_result($result);
    	return $subject;

	}

	function fetch_datasets_report_id($report_id)
		{

		global $db;

		$sql="SELECT * from datasets_used where report_id='".$report_id."'";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		$subject = mysqli_fetch_assoc($result);
    	mysqli_free_result($result);
    	return $subject;

	}

	function fetch_datasets_dataset_id($dataset_id)
		{

		global $db;

		$sql="SELECT * from datasets_used where dataset_id='".$dataset_id."'";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		$subject = mysqli_fetch_assoc($result);
    	mysqli_free_result($result);
    	return $subject;

	}

	function fetch_dashboard_name ($report_id)
		{

		global $db;

		$sql="SELECT name from dashboards where report_id='".$report_id."'";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		$subject = mysqli_fetch_assoc($result);
    	mysqli_free_result($result);
    	return $subject;

	}
	function insert_dashboard($subject) {
		global $db;
		$cdate = date('Y-m-d', strtotime(str_replace('-', '/', $subject['create_dt'])));
		$mdate = date('Y-m-d', strtotime(str_replace('-', '/', $subject['modified_dt'])));
		$sql ="insert into sas.dashboards ";
		$sql .= "(category, name,refresh_type, url,create_dt,modified_dt, project_type, project_name, project_locations) values (";
		$sql .= "'".$subject['category']."',";
		$sql .= "'".$subject['dashboard_name']."',";
		$sql .= "'".$subject['refresh_type']."',";
		$sql .= "'".$subject['url']."',";
		$sql .= "'".$cdate."',";
		$sql .= "'".$mdate."',";
		$sql .= "'".$subject['project_type']."',";
		$sql .= "'".$subject['project_name']."',";
		$sql .= "'".$subject['project_location']."')";
		$result=mysqli_query($db,$sql);

		if ($result) {
			return true;
		} else {

			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}

	}

	function update_dashboard($subject ) {
		global $db;
		$cdate = date('Y-m-d', strtotime(str_replace('-', '/', $subject['create_dt'])));
		$mdate = date('Y-m-d', strtotime(str_replace('-', '/', $subject['modified_dt'])));
		$sql ="update sas.dashboards ";
		$sql .= "set category='".$subject['category']."',";
		$sql .= " name='".$subject['dashboard_name']."',";
		$sql .= " refresh_type='".$subject['refresh_type']."',";
		$sql .= " url='".$subject['url']."',";
		$sql .= " create_dt='".$cdate."',";
		$sql .= " modified_dt='".$mdate."',";
		$sql .= " project_type='".$subject['project_type']."',";
		$sql .= " project_name='".$subject['project_name']."',";
		$sql .= " project_location='".$subject['project_location']."' where report_id='".$subject['report_id']."'";
		$result=mysqli_query($db,$sql);

		if ($result) {
			return true;
		} else {

			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}

	}

	function insert_datasets_used($report_id,$sas_libname,$dataset_name ) {
		global $db;
		$sql ="insert into sas.datasets_used ";
		$sql .= "(report_id, sas_libname, dataset_name) values (";
		$sql .= "'".$report_id."',";
		$sql .= "'".$sas_libname."',";
		$sql .= " upper('".$dataset_name."'))";
		$result=mysqli_query($db,$sql);

		if ($result) {
			return true;
		} else {

			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}

	}

	function update_datasets($subject ) {
		global $db;
		$sql ="update sas.datasets_used ";
		$sql .= " set dataset_name='".$subject['dataset_name']."',";
		$sql .= " sas_libname='".$subject['sas_libname']."' where report_id='".$subject['report_id']."' and dataset_id='".$subject['dataset_id']."'";
		$result=mysqli_query($db,$sql);

		if ($result) {
			return true;
		} else {

			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}

	}

	function delete_dashboard($report_id) {

		global $db;

		$sql= "DELETE from sas.dashboards ";
		$sql .= "where report_id='". $report_id ."' ";
		$sql .= "LIMIT 1";
		$result= mysqli_query($db,$sql);

		if ($result) {
			return true;
		} else {

			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function delete_dataset($dataset_id) {

		global $db;

		$sql= "DELETE from sas.datasets_used ";
		$sql .= "where dataset_id='". $dataset_id ."' ";
		$sql .= "LIMIT 1";
		$result= mysqli_query($db,$sql);

		if ($result) {
			return true;
		} else {

			echo mysqli_error($db);
			db_disconnect($db);
			exit;
		}
	}

	function fetch_dashboard_category($category)
		{

		global $db;

		$sql="SELECT * from dashboards where category='".$category."'";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		return $result;

	}

	function find_admin($username) {
	    global $db;

	    $sql = "SELECT * FROM admins ";
	    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
	    $sql .= "LIMIT 1";
	    $result = mysqli_query($db, $sql);
	    confirm_result_set($result);
	    $admin = mysqli_fetch_assoc($result); // find first
	    mysqli_free_result($result);
	    return $admin; // returns an assoc. array
    }

    function fetch_distinct_libnames() {
    	global $db;
    	$sql="SELECT distinct libname from datasets_columns";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		return $result;
    }

    function fetch_table_libname($libname)
		{

		global $db;

		$sql="SELECT distinct dataset_name from datasets_columns where libname='".$libname."'";
		$result=mysqli_query($db,$sql);
		confirm_result_set($result);
		return $result;

	}
?>