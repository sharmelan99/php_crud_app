<?php
    include 'config.php';
  
    extract($_REQUEST);
  
    //Create Start
    if(isset($submit) && $submit == 'create') {
        $fname = $_FILES['profilepic']['name'];
        $bb = explode('.',$fname);
        $ext = strtolower(end($bb));

        if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
            $dir = "$fname";
            $newfname = '.' . $ext;
            $profilepic_path = $dir . $newfname;
            move_uploaded_file($_FILES['profilepic']['tmp_name'], $profilepic_path);
            
            $query = "INSERT INTO stu(id, name, email, profilepic) values($stuid, '$stuname', '$stuemail', '$profilepic_path')";
            $result = mysqli_query($link, $query);
            if ($result) {
                header('location:create.php');
            } else {
                echo mysqli_error($link);
            }
        } else {
            echo 'You have choosen ' .$ext. 'Please choose png, jpg or jpeg file';
        }
        //Create End

        //Update Start
    } else if (isset ($submit) && $submit == 'update') {

        if ($_FILES['profilepic']['size'] == 0) {
            $query = "UPDATE stu set name = '$stuname', email = '$stuemail' where id = $stuid";
            $result = mysqli_query($link, $query);
            
            if ($result) {
                header('location:retrive.php');
            } else {
                echo mysqli_error($link);
            }
        } else {
            $fname = $_FILES['profilepic']['name'];
            $dd = explode('.', $fname);
            $ext = strtolower(end($dd));
        } 
        
        if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
            $dir = "$fname";
            $newfname = '.' . $ext;
            $profilepic_path = $dir . $newfname;

            move_uploaded_file($_FILES['profilepic']['tmp_name'], $profilepic_path);

            $query = "UPDATE stu set name = '$stuname', email = '$stuemail', profilepic = '$profilepic_path' where id = $stuid";
            $result = mysqli_query($link, $query);

            if ($result) {
                header ('location:retrive.php');
            } else {
                echo mysqli_error($link);
            }
        } else {
            echo 'You have choosen '.$ext. ' file. Please Choose png, jpg or jpeg file';
        }
        //Update end

        //Delete Start
    } else if (isset($submit) && $submit == 'delete') {
        $query = "SELECT profilepic from stu where id=$stuid";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        $profilepic_path = $row['profilepic'];
        
        if (file_exists($profilepic_path)) {
            unlink($profilepic_path);
        }

        $dquery = "DELETE from stu where id=$stuid";
        $result = mysqli_query($link, $dquery);

        if($result) {
            header('location:retrive.php');
        }
    //Delete End

    //Search Start
    } else if (isset($submit) && $submit == 'search') {
         $k = $_POST['keys'];
        $terms = explode(" ", $k);

        $i=0;

        $query = "SELECT * FROM stu WHERE";
        foreach ($terms as $each) {
            $i++;

            if ($i==1) {
                $query .= " name LIKE '%$each%' ";
            } else {
                $query .= " OR name LIKE '%$each%' ";
            }
            $qry = mysqli_query($link, $query);
            $result = mysqli_num_rows($qry);
        
            if ($result > 0) {
                
                while ( $row = $qry -> fetch_assoc()) {
                    $key = $row['name'];
                    $des = $row['email'];
                    $eid = $row['id'];

                    echo "<h2>$key</h2>";
                    echo "<p>$des</p>";
                    echo "<p>$eid</p>";
                    
                }

            } else {
                echo "No Results Found ". $_POST['keys'];
            }
        
        }
        //Search End

    }


?>