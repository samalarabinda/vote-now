<?php 
include("./connection.php");
session_start();
$group_votes=$_POST['g_votes'];
echo $group_votes;
$totalvotes=$group_votes+1;
echo $totalvotes;
$group_id=$_POST['g_id'];
$sql_group=mysqli_query($connection,"UPDATE user SET votes=$totalvotes WHERE id=$group_id" );
$voter_id=$_SESSION['userdata']['id'];
$sql_voter=mysqli_query($connection,"UPDATE user SET status=1 WHERE id=$voter_id");
if($sql_group and $sql_voter){
    $sql_group_result=mysqli_query($connection,"SELECT * FROM user WHERE role=2");
    $voter_status=mysqli_query($connection,"SELECT * FROM user WHERE id=$voter_id");
    $voter=mysqli_fetch_assoc($voter_status);
    $groups_data=mysqli_fetch_all($sql_group_result,MYSQLI_ASSOC);
    $_SESSION['userdata']= $voter;
    $_SESSION['groups_data']=$groups_data;
    echo '<script>
    alert("votting successfully");
    window.location="../frontend/dashboard.php";
    </script>';
}
else{
    echo '<script>
    alert("votting not completed");
    window.location="../frontend/dashboard.php";
    </script>';
}

// header('location: ../frontend/dashboard.php');

?>