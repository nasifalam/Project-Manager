<?php

session_start();


// Place username and pass
$servername = "localhost";
$username = "";
$password = "";
$database = "projects";

// Create and check connection
$conn = new mysqli($servername, $username, $password, $database) or die("Connection failed: " . $conn->connect_error);

$update="false";
$title = '';
$description = '';
$directory = '';
$role = '';
$team = '';
$areas = '';
$keywords = '';
$priority= '';
$significancelevel = '';
$status = '';
$startdate = '';
$enddate = '';

if (isset($_POST['addproject'])) {

  $title = $_POST['title'];
  $description = $_POST['description'];
  $directory = $_POST['directory'];
  $role = $_POST['role'];
  $team = $_POST['team'];
  $areas = $_POST['areas'];
  $keywords = $_POST['keywords'];
  $priority= $_POST['priority'];
  $significancelevel = $_POST['significancelevel'];
  $status = $_POST['status'];
  $startdate = $_POST['startdate'];
  $enddate = $_POST['enddate'];



  $conn->query("INSERT INTO projects (title,description,directory,role,team,areas,keywords,priority,significancelevel,status,startdate,enddate)
  VALUES ('$title','$description','$directory','$role','$team','$areas','$keywords','$priority','$significancelevel','$status','$startdate','$enddate') ") or
  die ($conn->error);


  $SESSION['message'] = "Record has been added!";
  $SESSION['msg_type'] = "success";


  header("location: index.php");

}
if (isset($_GET['delete'])) {

  $projectid = $_GET['delete'];
  $conn->query("DELETE FROM projects WHERE projectid=$projectid") or die($conn->error());

  $SESSION['message'] = "Record has been deleted!";
  $SESSION['msg_type'] = "danger";

    header("location: index.php");



}

if (isset($_GET['edit'])) {

  $projectid = $_GET['edit'];
  $update=true;
  $result = $conn->query("SELECT*FROM projects WHERE projectid =$projectid") or die($conn->error());
  if (count(array($result))==1){
    $row = $result->fetch_array();
    $title =$row['title'];
    $description= $row['description'];
    $directory = $row['directory'];
    $role = $row['role'];
    $team = $row['team'];
    $areas = $row['areas'];
    $keywords = $row['keywords'];
    $priority= $row['priority'];
    $significancelevel = $row['significancelevel'];
    $status = $row['status'];
    $startdate = $row['startdate'];
    $enddate = $row['enddate'];

}
}

if (isset($_POST['update'])) {
  $projectid = $_POST['projectid'];
  $title = $_POST['title'];
  $description =$_POST['description'];

  $conn->query("UPDATE projects SET title='$title',description='$description'") or die($conn->error());
}

?>
