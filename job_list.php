<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

if (!isset($_SESSION['id'])) {
    header("location: login.html");
    exit;
} else {
    $userid = $_SESSION['id'];
    $username1 = isset($_SESSION['adname']) ? $_SESSION['adname'] : "";
    $alusername = isset($_SESSION['alname']) ? $_SESSION['alname'] : "";
}

include_once "connect_database.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/forum_list.css" />
<title>Community Services</title>
<?php
if (strchr("$userid", "AD") == true) {
    include_once "setting/adminjoblist_navigation.php";
} else {
    include_once "setting/aluminijoblist_navigation.php";
}
?>
</head>

<body>
<br /><br /><br />
<div align="center">
<div>
<form action="" method="post">
<select name="domainId" id="domainId">
    <option value="">Select Category</option>
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
<button type="submit" name="submit">Submit</button>
</form>
</div>

<table cellspacing="10" class="tb1">
<th class="th1" >Community Services</th>
<?php
if (isset($_POST['domainId']) && isset($_POST['submit'])) {
    $domainId = ($_POST['domainId']);
    $query = "SELECT jobsdata.*, domain.domainname, jobsimage.image_path FROM jobsdata 
              JOIN domain ON domain.id = jobsdata.job_tags
              LEFT JOIN jobsimage ON jobsdata.job_id = jobsimage.job_id
              WHERE job_tags = '$domainId'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class=td1><span class=sp3>#".$row["job_id"]."&nbsp;".$row["job_title"]."</span>";
            echo "<br /><br /><span class=sp2>".$row["job_content"]."</span>";
            echo "<br /><br /><span class=sp1>Tags: ".$row["domainname"]." | Author: ".$row["job_author"]." | Time: ".$row["job_time"]."</span>";

            // Display the image if available
            if (!empty($row["image_path"])) {
                echo '<br /><br /><img src="' . $row["image_path"] . '" alt="Job Image" />';
            }

            echo "</td></tr>";
            echo "<tr><td class=td3><br /> | <a class=a1>😊</a> | <td></tr>";
        }
    }
} else {
    $sql = "SELECT jobsdata.*, domain.domainname, jobsimage.image_path FROM jobsdata 
            JOIN domain ON domain.id = jobsdata.job_tags 
            LEFT JOIN jobsimage ON jobsdata.job_id = jobsimage.job_id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class=td1><span class=sp3>#".$row["job_id"]."&nbsp;".$row["job_title"]."</span>";
        echo "<br /><br /><span class=sp2>".$row["job_content"]."</span>";
        echo "<br /><br /><span class=sp1>Tags: ".$row["domainname"]." | Author: ".$row["job_author"]." | Time: ".$row["job_time"]."</span>";

        // Display the image if available
        if (!empty($row["image_path"])) {
            echo '<br /><br /><img src="' . $row["image_path"] . '" alt="Job Image" />';
        }

        echo "</td></tr>";
        echo "<tr><td class=td3><br /> | <a class=a1>😊</a> | <td></tr>";
    }
}
?>
</table><br /><br />
<hr style="padding:1px" color="sienna">
<div id="replyhere">
</div>
<br />
<hr style="padding:1px" color="#050119">
<br />
<?php
if (isset($_POST['replypost'])) {
    $fid = $_REQUEST['id'];
    $freply = $_REQUEST['replymessage'];
    $userid = $_SESSION['id'];
    date_default_timezone_set("Asia/Kolkata");
    $ftime = date("Y/m/d h:i:sa");
    if ($fid == "" || $freply == "") {
        echo "<script>alert('Incomplete information. No reply made. Please ensure no field is left blank.);</script>";
    } else {
        $sql2 = "SELECT pi_name FROM alumniinfo WHERE pi_register = '".$userid."'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $fname = $row2['pi_name'];
                $sql3 = "SELECT eforum_title FROM forumdata WHERE eforum_id = $fid";
                $result3 = $conn->query($sql3);
                while ($row3 = $result3->fetch_assoc()) {
                    $ftopic = $row3['eforum_title'];
                }
                $sql4 = "INSERT INTO forum_reply (forum_topic, forum_message, forum_reply_name, forum_reply_time)
                 VALUES ('".$ftopic."','".$freply."', '".$fname."', '".$ftime."')";
                $result4 = $conn->query($sql4);
                if ($result4 == true) {
                    echo "<script>alert('Reply successfull.');</script>";
                    echo "<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            $getauthor1 = "SELECT ad_fullname FROM adminmember WHERE ad_id = '$userid'";
            $result1 = $conn->query($getauthor1);
            while ($row = $result1->fetch_assoc()) {
                $fname = $row["ad_fullname"];
                $sql3 = "SELECT eforum_title FROM forumdata WHERE eforum_id = $fid";
                $result3 = $conn->query($sql3);
                while ($row3 = $result3->fetch_assoc()) {
                    $ftopic = $row3['eforum_title'];
                }
                $sql4 = "INSERT INTO forum_reply (forum_topic, forum_message, forum_reply_name, forum_reply_time)
                 VALUES ('".$ftopic."','".$freply."', '".$fname."', '".$ftime."')";
                $result4 = $conn->query($sql4);
                if ($result4 == true) {
                    echo "<script>alert('Reply successfull.');</script>";
                    echo "<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
}
?>
</body>
</html>
