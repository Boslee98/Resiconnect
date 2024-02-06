<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

if (!isset($_SESSION['id'])) {
    header("location: login.html");
} else {
    $userid = $_SESSION['id'];
    $username1 = isset($_SESSION['adname']) ? $_SESSION['adname'] : "";
    $alusername = isset($_SESSION['alname']) ? $_SESSION['alname'] : "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/forum_list.css" />
<title>Community</title>
<?php 
include_once "connect_database.php";
if (strchr("$userid", "AD") == true) {
    include_once "setting/adminforumlist_navigation.php";
} else {	
    include_once "setting/alumniforumlist_navigation.php";
}
?>
</head>

<body>
<br /><br /><br />
<div align="center">
    <table cellspacing="10" class="tb1">
        <th class="th1" >Community</th>
        <?php
        $sql = "SELECT * FROM forumdata";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class=td1><span class=sp3>#".$row["eforum_id"]."&nbsp;".$row["eforum_title"]."</span>";
            echo "<br /><br /><span class=sp2>".$row["eforum_content"]."</span>";
            echo "<br /><br /><span class=sp1>Tags: ".$row["eforum_tags"]." | Author: ".$row["eforum_author"]." | Time: ".$row["eforum_time"]."</span></td></tr>";
            
        }
        ?>
    </table><br /><br />
    <hr style="padding:1px" color="sienna">
    <div id="replyhere">
        <!-- Your reply form here -->
    </div>
    <br />
    <hr style="padding:1px" color="#050119">
    <br />
    <?php
    if (isset($_POST['replypost'])) {
        // Handle the reply form submission
    }
    ?>	
</div>
</body>
</html>
