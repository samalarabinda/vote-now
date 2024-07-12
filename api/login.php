<?php 
session_start();
include("./connection.php");
$number=$_POST['mobile'];
$password=$_POST['password'];
$role=$_POST['role'];

$query="SELECT * FROM user WHERE mobile='$number' AND password='$password' AND role=$role";
$run_query=mysqli_query($connection,$query);
if(mysqli_num_rows($run_query)>0){
    $user_data=mysqli_fetch_assoc($run_query);
    $groups=mysqli_query($connection,"SELECT * FROM user WHERE role=2");
    $group_data=mysqli_fetch_all($groups,MYSQLI_ASSOC);
    $_SESSION['userdata']=$user_data;
    $_SESSION['groups_data']=$group_data;
     echo'
    <script>
    window.location="../frontend/dashboard.php";
    </script>
    ';
}else{
    echo'
    <script>
    window.location="../frontend";
    </script>
    ';
    }
mysqli_close($connection);



?>