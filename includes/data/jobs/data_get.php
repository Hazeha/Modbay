<?php
// Kan smides ud, n�r jeg har sat en t�ller op et andet sted.
// Men den bruges ikke p� nuv�rende tidspunkt.
	include 'includes/server/connect.php';

	$job_info = mysqli_query($conn, "SELECT jobId, jobName, jobDescription, jobSalary_max, jobSalary_min, jobClientId, jobUploadDate FROM job_tb");

	if ($job_info->num_rows > 0) {
		$total_jobs = $job_info->num_rows;
	}
?>