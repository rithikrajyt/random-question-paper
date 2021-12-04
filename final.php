<?php
include 'database.php';
include_once 'drop_table.php';
mysqli_query($conn,"drop table mastercopy");
#CREATE A copy of master and copy the whole data from master and replace master by master copy
include 'copytable.php';
include_once 'newtable.php';

function Insert($conn,$question,$mark,$Co_Number,$id){
    $sql = "INSERT INTO temp (Question, Marks, CO_Number)
        VALUES ('$question','$mark', '$Co_Number')";
    
    if ($conn->query($sql) === TRUE) {
            #echo "New record created successfully";
    } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    $sql = "DELETE FROM mastercopy WHERE `id` = $id";
    if ($conn->query($sql) === TRUE) {
        #echo "New record created successfully";
} else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$total_marks = 0;
while ($total_marks != 60) {
    $result = mysqli_query($conn,"SELECT * FROM `mastercopy` order by RAND() limit 1");
    $row = mysqli_fetch_array($result);
    $mark = $row["Marks"];
    $question =  $row["Question"];
    #echo $question."<br>";
    $Co_Number = $row["CO_Number"];
    #echo $mark."<br>";
    $id = $row["id"];

    if ($mark == 10) {
        Insert($conn,$question,$mark,$Co_Number,$id);
        $total_marks += 10;
    }
    else {
        $a = 10 - $mark;
        $total_marks += $mark;
        Insert($conn,$question,$mark,$Co_Number,$id);
            while (1) {
                $result1 = mysqli_query($conn,"SELECT DISTINCT * FROM `mastercopy` order by RAND() limit 1");
                $row1 = mysqli_fetch_array($result1);
                $mark1 = $row1["Marks"];
                $question1 =  $row1["Question"];
                #echo $question1."<br>";
                $Co_Number1 = $row1["CO_Number"];
                #echo $mark1."<br>";
                $id1 = $row1["id"];


                if($mark1!=$a) {
                    $result1 = mysqli_query($conn,"SELECT DISTINCT * FROM `mastercopy` order by RAND() limit 1");
                    $row1 = mysqli_fetch_array($result1);
                    $mark1 = $row1["Marks"];
                    $question1 =  $row1["Question"];
                    #echo $question1."<br>";
                    $Co_Number1 = $row1["CO_Number"];
                    #echo $mark1."<br>";
                    $id1 = $row1["id"];

                }
                else{
                    Insert($conn,$question1,$mark1,$Co_Number1,$id1); 
                    $total_marks += $a;
                    break;
                }
            }

    }
    
}
#yaha
#echo "yaha pe ek button bnayenge ki your paper has been generated or uspe click krne se new page mein jayega jo data uthayega database se and print krega with html and css";

include_once 'print.php';

#echo "table Deleted successfully....."."<br>";

?>