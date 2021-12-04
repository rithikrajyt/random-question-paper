<?php
include_once 'database.php';
//This is a Method to generate a Random data from the Database
$result = mysqli_query($conn,"SELECT * FROM `temp`");
?>

<!DOCTYPE html>
<html>
<head>
<title> Question Paper</title>
<style>
    #btn{
        padding : 32px;
        margin : auto;
        border : 3px solid black;
        outline : none;
        color: hotpink;
        
    }
</style>
</head>
<body>
<table>
<tr>
<td>Question</td>
<td>Marks</td>
<td>CO Number</td>
</tr>
<!--The below code selects a random value from the database-->
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {   
?>
<tr >
<td><?php echo $row["Question"]; ?></td>
<td><?php echo $row["Marks"]; ?></td>
<td><?php echo $row["CO_Number"]; ?></td>
</tr>
<?php
$i++;

}
?>
<button id= "btn" onclick="window.print()">Print this page</button>
</table>
</body>
</html>