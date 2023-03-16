<?php
    include 'config.php';
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
            <form class="stuform" action="manfunctions.php" method="post" enctype="multipart/form-data">
                <table cellspacing="20">
                    <tr>
                        <th colspan="2">
                            <center>New Student Form</center>
                        </th>
                    </tr>
                    <tr>
                        <td>Student ID:</td>
                        <td><input type="text" name="stuid" required="" /></td>
                    </tr>
                    <tr>
                        <td>Student Name:</td>
                        <td><input type="text" name="stuname" required="" /></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="stuemail" required="" /></td>
                    </tr>
                    <tr>
                        <td>Photo:</td>
                        <td><input type="file" name="profilepic" required /></td>
                    </tr>
                    <tr>
                        <td>
                            <button class="sbtn" name="submit" value="create">
                                Submit
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>