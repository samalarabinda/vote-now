<?php 
include("./connection.php");
$name =$_POST['name'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$cpassword=$_POST['confirmpassword'];
$address=$_POST['address'];
$image=$_FILES['file']['name'];
$image_temp=$_FILES['file']['tmp_name'];
$role=$_POST['role'];
if($password==$cpassword){
    move_uploaded_file($image_temp,"../uploads/$image");
    $query="INSERT INTO user (name,mobile,password,address,photo,role,status,votes) VALUES ('$name',$mobile,'$password',
    '$address','$image',$role,0,0) ";
    $run_query=mysqli_query($connection,$query);
    if($run_query){
        echo'
        <script>
        alert("Registaration succesfully");
        window.location="../frontend/index.htm";
        </script>
        ';
    }else{
        echo'
        <script>
        alert("You Have Failed to Register");
        window.location="../frontend/register.htm";
        </script>
        '; 
    }
}else{
    echo'
    <script>
    alert("Passwords are not Matching");
    window.location="../frontend/register.htm";
    </script>
    ';
}
?>