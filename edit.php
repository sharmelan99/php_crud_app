<?php
    include 'config.php';

    extract($_REQUEST);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student List</title> 
        <link href="crudstyle.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="left">
                <?php
                    require 'menu.php';
                ?>
            </div>
            <div class="right">
                <?php
                    $query = "SELECT * from stu where id=$stuid";
                    $result = mysqli_query($link, $query);

                    if (mysqli_num_rows($result) > 0) {
                ?>
                <form class="stuform" action="manfunctions.php" method="post" enctype="multipart/form-data">
                    <table cellspacing="20">
                        <tr>
                            <th colspan="2"><center>New Student Form</center></th>
                        </tr>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>Student ID</td>
                            <td><input type="text" name="stuid" required="" value="<?= $row['id'] ?>" readonly="" /></td>
                        </tr>
                        <tr>
                            <td>Student Name</td>
                            <td><input type="text" name="stuname" required="" value="<?= $row['name'] ?>" /></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="stuemail" required="" value="<?= $row['email'] ?>" /></td>
                        </tr>
                         <tr>
                            <td>Photo</td>
                            <td><img src="<?= $row['profilepic'] ?>" alt="Profile Picture" width="200" height="200" /></td>
                        </tr>
                        <tr>
                            <td>Change</td>
                            <td><input type="file" name="profilepic" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button class="sbtn" name="submit" value="update">Update</button></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </form>
                <?php
                    } else {
                        echo "Record Not Found";
                    }
                ?>
            </div>
        </div>
    </body>
</html>