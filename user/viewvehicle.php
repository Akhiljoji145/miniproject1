<?php
session_start();
include('../php/connection.php');
error_reporting(0);
if (strlen($_SESSION['email']==0 && $_SESSION['user_id']==0 && $_SESSION['vehi_no']==0)) {
    header('location:../user/siginform.php');
} 
else{ 
$id=$_SESSION['user_id'];
$vehi_no=$_SESSION['vehi_no'];
$sql="SELECT users.username,users.vehi_no,vehicles.* FROM  users,vehicles WHERE vehicles.status='IN' AND vehicles.vehi_no='$vehi_no' AND users.vehi_no=vehicles.vehi_no ";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
if($row['vehicle.time']>7200)
{
    include("unbook.php");
}
elseif($result==TRUE)
{
echo"
<html>
<head>
<style>
table
{
border-collapse:collapse;
border:1px solid black;
}
th
{
background-color:black;
color:white;
}
.border
{
border-right:white;
}
td
{
    background-color:white;
    color:black;
}
</style>
</head>
<body>
<table border='1' align='center'>
<tr class='border'>
<th>username</th>
<th>vehicle name</th>
<th>vehicle type</th>
<th>vehicle no</th>
<th>lot no</th>
<th>contact no</th>
<th>time of arr</th>
<th>date of arr</th>
<th>status</th>
<th>unbook</th>

</tr>
<tr>
    <td>$row[0]</td>
    
    <td>$row[3]</td>
    <td>$row[4]</td>
    <td>$row[5]</td>
    <td>$row[6]</td>

    <td>$row[7]</td>
    <td>$row[8]</td>
    <td>$row[9]</td>
    <td>$row[10]</td>
    <td><a href='unbook.php'>unbook</a></td>
    </tr>
    </table>
</body>
</html>";
}
else {
echo"NO VEHICLES";
}
}

?>