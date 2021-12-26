<?php 


function insertItem($table,$array){
    global $connect;
    $keys = implode(",",array_keys($array));
    $values = implode("','",array_values($array));

    $sql = "insert into $table ($keys) values ('$values')";

    $query = mysqli_query($connect,$sql);
    
    if($query){
        echo "<script>window.open('index.php','_self')</script>";
    }


}


function showItem($table){
    global $connect;
    $array = [];
    $sql = "select * from $table";

    $query = mysqli_query($connect,$sql);

    while($row = mysqli_fetch_array($query)){
        $array[] = $row;
    }

    return $array;
}

function updateActivity($table,$id,$status){
    global $connect;
    $sql = "UPDATE $table SET active=$status where $table.id='$id'";

    $query = mysqli_query($connect,$sql);

    if($query){
        echo "<script>window.open('index.php','_self')</script>";
    }
}


?>