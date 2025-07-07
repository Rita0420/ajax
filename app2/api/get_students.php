<?php
include_once "db.php";

$classroom=$_GET['classroom']??'101';

$students=$Stu->all(['classroom'=>$classroom]);

foreach($students as $key => $student){
    //為了在前端顯示中文的班級名稱所以在陣列新增classname
    $students[$key]['classname']=$ref[$student['classroom']];
}


header('Content-Type:application/json;');

echo json_encode($students);