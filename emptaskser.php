<?php
$db=mysqli_connect('localhost','root','','khosra');
$temp=0;
	session_start();
	$db=mysqli_connect('localhost','root','','khosra');
	$user=$_SESSION['username'];
	$query1="SELECT * FROM employees WHERE name='$user'";
	$row=mysqli_fetch_array(mysqli_query($db,$query1));
	$emp_id=$row["employee_ID"];
	$query2="SELECT * FROM works WHERE Assigned_to='$emp_id'";
	$row2=mysqli_fetch_array(mysqli_query($db,$query2));
	$pre_req= $row2["pre_requisite"];
	print_r($pre_req);
	echo "<br>";
	$pre=preg_split("/[\,]/",$pre_req);
	foreach($pre as $arr)
	{
		//here pre_req check will happen
		echo $arr."<br>";
		$id=$arr;
		$query3="SELECT * FROM works WHERE task_id='$id'";
		$row=mysqli_fetch_array(mysqli_query($db,$query3));
		//print_r($row);
		$progress=$row["progress"];
		if($progress != 100)
		{
			echo "Can not start work";
			$temp++;
			//header("location: emp_task.php");
		}
		else{
			echo "start work";
			//header("location: emp_sub_task.php");
		}
	    echo "<br>";
	}


if($temp==0)
{
	if(isset($_GET['id']))
	{
	echo "START WORK";
	$val=$_GET['id'];
	$_SESSION['need']=$val;
	print_r($_SESSION['need']);
	print_r($val);
	header("location: emp_sub_task.php?id=".$_GET['id']);
	}
}

else{
	echo"Can't start working";
	header("location: emp_task.php");
}






mysqli_close($db);
?>