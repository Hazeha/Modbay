<?php
// FUnktioner i denne class
// jobApply - Apply job 
$total_jobs = 0;
require_once('includes/server/loginConfig.php');

class JOB
{
	private $conn;
	public function __construct()
	{
		$database = new database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}
	public function runQuery($sql)
	{
		$jobStmt = $this->conn->prepare($sql);
		return $jobStmt;
	}

	// det er til at apply et job. Alts� lave jobopslag.
	// Mangler stadig at få userId og Categorier.
	public function jobApply($jobName, $jobDescription, $jobBudget, $jobGame)
	{
		try
		{
			$jobStmt = $this->conn->prepare("INSERT INTO job_tb (jobName,jobDescription,jobMaxBudget,jobGame) VALUES(:jname, :jdescription, :jmaxbudget, :jgame)");

			$jobStmt->bindparam(":jname", $jobName);
			$jobStmt->bindparam(":jdescription", $jobDescription);
			$jobStmt->bindparam(":jmaxbudget", $jobBudget);
			$jobStmt->bindparam(":jgame", $jobGame);

			$jobStmt->execute();

			return $jobStmt;
		}
		catch(PDOExeption $e)
		{
			echo $e->getMessage();
		}
	
	}

	// Function til at poste jobs p� den overordnede side. 
	// Herfra kunne man lave s�ge kreterier. 
	public function jobPost()
	{
		$getJobs = $this->conn->prepare("SELECT * FROM job_tb ORDER BY jobUploadDate ASC");
		$getJobs->execute();
		$jobs = $getJobs->fetchAll();


		foreach($jobs as $post)//Mangler jobCat
		{
			echo '
                <div class="col-md-3 portfolio-item col-md-4">
                    <div class="thumbnail">
                        <div class="caption">
                            <h4 class="pull-right">' . $post["jobMaxBudget"] . '$</h4>
                            <h4><a href="job.php?jobId=' .$post["id"]. '"> ' . $post["jobName"] . ' </a></h4>
                            <p> ' . $post["jobDescription"] . ' </p>
                        </div>
						<div class="ratings">
						<p>'.$post["jobGame"].' - '.$post["jobCat"].'</p> 
                            <p>Uploaded : '.$post["jobUploadDate"].'</p>
                            
                        </div>
                    </div>
                </div>
			';

		}
	}
	//Her skal der laves en funktion der gør det muligt for content creators at ansøge om jobbet.
	//Der skal også laves en funktion der fortæller om hvor mange der har ansøgt om jobbet.
	public function applyJob()
	{

	}
	//Her skal der laves en function til at post jobbet når man har valgt et.
	public function jobGet($jobId)
	{
		$getJob = $this->conn->prepare("SELECT * FROM job_tb WHERE id=?");
		$getJob->execute([$jobId]);
		$jobInfo = $getJob->fetchAll();
		return $jobInfo;		
	}
	//Til Post af comment til job
	public function jobCommentPost()
	{

	}
	//Skal bruges til at post comments til valgt job.
	//
	public function jobComment($jobId)
	{
		foreach ($comment as $post)
		{
		echo' 
			<div class="media">
				<a class="pull-left" href="#"><img alt="" class="media-object" src="http://placehold.it/64x64"></a>
				<div class="media-body">
					<h4 class="media-heading">Dr. Carsten <small>August 25, 2017 at 9:30 PM</small></h4>Good working meth system and really easy to use. Uses a more modern approach and realistic than the other competitors.
				</div>
			</div>
			';
		}
	}
}
?>