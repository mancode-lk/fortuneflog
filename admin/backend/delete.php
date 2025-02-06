<?php

    include "conn.php";

    $=$_REQUEST[''];



    $deletePdf=getDataBack($conn,'tbl_files','f_id',$f_id,'f_thumb');
    unlink('../assets/img/pdf/'.$deletePdf);


    $sql="DELETE FROM tbl_files WHERE f_id='$f_id'";
    $rs=$conn->query($sql);

    if($rs>0){
        echo 200;
        exit();
    }else{
        echo $sql;
        exit();
    }

?>
