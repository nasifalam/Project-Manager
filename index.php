<!DOCTYPE html>
<html lang="en">
<head>
  <title>Project Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</head>
<body>



<?php require_once 'process.php';?>

<?php

if (isset($_SESSION['message'])):?>




<div class="alert alert-<?=$_SESSION['msg_type']?>">


echo $_SESSION['message'];
unset($_SESSION['message']);
?>

</div>
<?php endif ?>



<?php $conn = new mysqli($servername, $username, $password, $database) or die("Connection failed: " . $conn->connect_error);
$result = $conn->query ("SELECT*FROM projects") or die ($conn->error);
//pre_r($result);
//pre_r ($result->fetch_assoc());
?>
<div class="row justify-content-center">

  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th> Project ID </th>
        <th> Project Title </th>
        <th> Project Description </th>
        <th> Project Directory </th>
        <th> Role </th>
        <th> Team </th>
        <th> Areas of Focus </th>
        <th> Keywords </th>
        <th> Priority Level</th>
        <th>Significance Level</th>
        <th> Status</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th colspan ="5"> Action</th>
      </tr>
    </thead>
    <?php
    while ($row = $result->fetch_assoc()): ?>
    <tr >
    <td class="text-center"> <?php echo $row['projectid'];?> </td>
    <td> <?php echo $row['title'];?> </td>
    <td> <?php echo $row['description'];?> </td>
    <td> <?php echo $row['directory'];?> </td>
    <td> <?php echo $row['role'];?> </td>
    <td> <?php echo $row['team'];?> </td>
    <td> <?php echo $row['areas'];?> </td>
    <td> <?php echo $row['keywords'];?> </td>
    <td> <?php echo $row['priority'];?> </td>
    <td> <?php echo $row['significancelevel'];?> </td>
    <td> <?php echo $row['status'];?> </td>
    <td> <?php echo $row['startdate'];?> </td>
    <td> <?php echo $row['enddate'];?> </td>
    <td>
         <a href="index.php?edit=<?php echo $row['projectid'];?>"
           class="btn btn-info"> Edit </a>

           <a href="process.php?delete=<?php echo $row['projectid'];?>"
             class="btn btn-danger"> Delete </a>
    </td>
    </tr>
  <?php endwhile; ?>
  </table>
</div>



<?php
function pre_r($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
?>
<h2 class ="row justify-content-center" class="container"> Project Infromation </h2>


<div class ="row justify-content-center" class="container">


<form action="process.php" method="POST">





<div class="row">
<div class="col-sm">



<div class="form-group">
<label>Project Title</label>
<input type="text" name="title" value= "<?php echo $title;?>"class="form-control">
</div>

<div class="form-group" >
<label>Project Description </label>
<textarea id="description" name="description" rows="4" cols="50" class="form-control">
  <?php echo $description;?>
</textarea> </div>

<div class="form-group" >
<label> Project Directory</label>
<input type="text" name="directory" value= "<?php echo $directory;?>" class="form-control">
</div>

<div class="form-group" >
<label>Role</label>
<input type="text" name="role" value= "<?php echo $role;?>" class="form-control"><br>
</div>
</div>

<div class="col-sm">
<div class="form-group" >
<label>Team</label>
<input type="text" name="team" value= "<?php echo $team;?>" class="form-control"><br>
</div>

<div class="form-group" >
<label for="areas">Areas of Focus</label>
  <select name="areas" id="areas" class ="form-control">
    <option value="Software Engineering">Software Engineering</option>
    <option value="Electrical Engineering">Electrical Engineering</option>
    <option value="Infrastructure Engineering">Infrastructure Engineering</option>
    <option value="Project Management">Project Management</option>
  </select>
</div>

<div class="form-group" >
<label>Keywords </label>
<textarea id="keywords" name="keywords" rows="4" cols="30" class="form-control">
  <?php echo $keywords;?>
</textarea> </div>

<div class="form-group" >
<label for="priority">Priority Level</label>
  <select name="priority" id="priority" class ="form-control">
    <option value="Low">Low</option>
    <option value="Medium">Medium</option>
    <option value="High">High</option>
  </select>
</div>

<div class="form-group" >
<label for="significancelevel">Significance Level</label>
  <select name="significancelevel" id="significancelevel" class ="form-control">
    <option value="Low">Low</option>
    <option value="Medium">Medium</option>
    <option value="High">High</option>
  </select>
</div>
<div class="form-group" >
<label for="status">Status</label>
  <select name="status" id="status" class ="form-control">
    <option value="In Progress">In Progress</option>
    <option value="Created">Created</option>
    <option value="Completed">Completed</option>
    <option value="Defunct">Defunct</option>
  </select>
</div>


<div class="form-group" >
<label>Start Date</label>
 <input type="date" name="startdate"class="form-control">
</div>

<div class="form-group" >
<label>End Date</label>
 <input type="date" name="enddate"class="form-control">
</div>
<div class="form-group" >

<?php
if ($update==false): ?>

<button type="submit" name="update" class="btn btn-info"> Update</button>

<?php else: ?>:

<button type="submit" name="addproject" class="btn btn-primary"> Add Project</button>
<?php endif;?>:


</div>
</form>
</div>

</body>

</html>
