<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("location: login.html");
    exit;
} else {
    $userid = $_SESSION['id'];
    include_once "connect_database.php";
    if (strchr("$userid", "AD") == true) {
        $username1 = $_SESSION['adname'];
        include_once "setting/adminaddjob_navigation.php";
    } else {
        $alusername = $_SESSION['alname'];
        include_once "setting/alumniaddjob_navigation.php";
    }
}

$successMessage = ""; // Initialize the success message

if (isset($_POST['addJobPost'])) {
    $ftitle = $_REQUEST['title'];
    $ftags = $_REQUEST['tags'];
    $fmessage = $_REQUEST['message'];
    date_default_timezone_set("Asia/Kolkata");
    $ftime = date("Y/m/d h:i:sa");

    if ($ftitle == '' || $ftags == '' || $fmessage == '') {
        $successMessage = "<br /><br /><br /><p class=p1>*****Incomplete information. No topic created.*****</p>";
    } else {
        $getauthor = "SELECT pi_name FROM alumniinfo WHERE pi_register='$userid'";
        $result = $conn->query($getauthor);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fauthor = $row["pi_name"];
                if ($fauthor == "") {
                    $successMessage = "<br /><br /><p class=p1>*****No topic created.*****<br /> *****Please complete personal information before joining e-forum.*****</p>";
                } else {
                    $sql = "INSERT INTO jobsdata (job_author, job_title, job_content, job_time, job_tags) 
                    VALUES('$fauthor', '$ftitle', '$fmessage', '$ftime', '$ftags')";
                    if ($conn->query($sql) === TRUE) {
                        $jobId = $conn->insert_id;

                        // Check if an image is uploaded
                        if ($_FILES['image']['size'] > 0) {
                            // Define the path to save the image
                            $imagePath = "image_uploads/job_image_" . $jobId . ".jpg";

                            // Check if the file is an image and move it to the desired folder
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                                // Image path updated

                                // Store image path in the database
                                $insertImagePath = "INSERT INTO jobsimage (job_id, image_path) VALUES ('$jobId', '$imagePath')";
                                if ($conn->query($insertImagePath) === TRUE) {
                                    $successMessage = "<p class=p1>*****Job successfully created.*****</p>";
                                } else {
                                    $successMessage = "Error storing image path in the database: " . $conn->error;
                                }
                            } else {
                                $successMessage = "<br /><br /><br /><p class=p1>*****Error uploading the image.*****</p>";
                            }
                        } else {
                            $successMessage = "<p class=p1>*****Job successfully created.*****</p>";
                        }
                    } else {
                        $successMessage = "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
        } else {
            $getauthor1 = "SELECT ad_fullname FROM adminmember WHERE ad_id='$userid'";
            $result1 = $conn->query($getauthor1);
            while ($row = $result1->fetch_assoc()) {
                $fauthor = $row["ad_fullname"];
                $sql = "INSERT INTO jobsdata (job_author, job_title, job_content, job_time, job_tags) 
                VALUES('$fauthor', '$ftitle', '$fmessage', '$ftime', '$ftags')";
                if ($conn->query($sql) === TRUE) {
                    $jobId = $conn->insert_id;

                    // Check if an image is uploaded
                    if ($_FILES['image']['size'] > 0) {
                        // Define the path to save the image
                        $imagePath = "image_uploads/job_image_" . $jobId . ".jpg";

                        // Check if the file is an image and move it to the desired folder
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                            // Image path updated

                            // Store image path in the database
                            $insertImagePath = "INSERT INTO jobsimage (job_id, image_path) VALUES ('$jobId', '$imagePath')";
                            if ($conn->query($insertImagePath) === TRUE) {
                                $successMessage = "<p class=p1>*****Job successfully created.*****</p>";
                            } else {
                                $successMessage = "Error storing image path in the database: " . $conn->error;
                            }
                        } else {
                            $successMessage = "<br /><br /><br /><p class=p1>*****Error uploading the image.*****</p>";
                        }
                    } else {
                        $successMessage = "<p class=p1>*****Job successfully created.*****</p>";
                    }
                } else {
                    $successMessage = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Community Services - Add Post</title>
<link rel="stylesheet" href="css/add_job_post.css" />
</head>
<body>
    <br /><br /><br />
    <h2>New Listing</h2>
    <br />
    <form action="add_job_post.php" method="post" enctype="multipart/form-data">
        <table align="center" cellspacing="30">
            <tr>
                <th align="left">Title: </th>
                <td><input size="59" type="text" value="" name="title" /></td>
            </tr>
            <tr>
                <th align="left">Category: </th>
                <td>
                    <select name="tags" id="tags">
                        <option value="">Select Domain</option>
                        <?php
                        $query = "SELECT id, domainname FROM domain";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($optionData = $result->fetch_assoc()) {
                                $option = $optionData['domainname'];
                                $id = $optionData['id'];
                        ?>
                                <option value="<?php echo $id; ?>"><?php echo $option; ?> </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th align="left">Content: </th>
                <td><textarea name="message" cols="60" rows="6" size="60"></textarea></td>
            </tr>
            <tr>
                <th align="left">Upload Image: </th>
                <td><input type="file" name="image" accept="image/*" /></td>
            </tr>
            <tr>
                <td colspan=2 align="right"><button class="addforumbt" type="submit" name="addJobPost">Add Post</button></td>
            </tr>
        </table>
    </form>
    <?php echo $successMessage; // Display the success message ?>
</body>
</html>
