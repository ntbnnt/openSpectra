<?php
require_once('user_manager.php');
//require_once('connections/spectra.php');
session_start();
$usermgr = new UserManager();
$USER_USERNAME = NULL;
$userloginid = $usermgr->sessionLoggedIn(session_id());

//mysql_select_db($database_openSpectra, $openSpectra);

if (isset($_GET['whoseSets'])) {

	if ($_GET['whoseSets'] == 'yourSets') {
		$queryYourUploads = "SELECT * FROM DATASETS WHERE USER_ID='" . $userloginid . "' ";
		
		$yourUploads = mysqli_query($conn, $queryYourUploads) or die(mysqli_error($conn));
		$row_yourUploads = mysqli_fetch_assoc($yourUploads);
		//$YOUR_SET_ID = $row_yourUploads['SET_ID'];
		$returnYourUploads = array();
		while($row_yourUploads) {
			$returnYourUploads[] = $row_yourUploads;
			$row_yourUploads = mysqli_fetch_assoc($yourUploads);
		}
		echo json_encode($returnYourUploads);
		exit;

	} else if ($_GET['whoseSets'] == 'allPublicSets') {
		$queryAllPublicSets = "SELECT * FROM DATASETS WHERE USER_ID <> '" . $userloginid . "' ";
		
		$allPublicSets = mysqli_query($conn, $queryAllPublicSets) or die(mysqli_error($conn));
		$row_allPublicSets = mysqli_fetch_assoc($allPublicSets);
		//$ALL_SET_ID = $row_allPublicSets['SET_ID'];
		$returnAllPublicSets = array();
		while($row_allPublicSets) {
			$returnAllPublicSets[] = $row_allPublicSets;
			$row_allPublicSets = mysqli_fetch_assoc($allPublicSets);
		}
		echo json_encode($returnAllPublicSets);
		exit;
	}

} else {
	$queryError = "not receiving the whoseSets variable";
	echo $queryError;
	exit;
}



?>