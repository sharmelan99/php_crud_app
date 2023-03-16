<?php
    $link = mysqli_connect('localhost', 'root', 'root', 'student');

    if(!$link){
        die ('Connection Error'.mysqli_connect_error());
    }
?>