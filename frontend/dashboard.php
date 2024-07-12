<?php 
session_start();
if(!isset($_SESSION['userdata'])){
    header('location: ./');
}
$userdata=$_SESSION['userdata'];
if($_SESSION['groups_data']){
  $group_data=$_SESSION['groups_data'];
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dashboard</title>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap');
body{
  font-family: "Baskervville SC", serif;
  font-weight: 400;
  font-style: normal;
}
.voter_container{
  width:35%;
  background-color: white;
  box-shadow:0px 0px 10px black;
  max-height:400px;
  
}
.voter_container img {
      display: inline-block;
      vertical-align: middle; /* This ensures the image is vertically centered */
     
    }
.group_container{
  width:65%;
  background-color: white;
  box-shadow:0px 0px 10px black;
}
</style>
  </head>
  <body>
    <div class="container">
        <div class="heading_section d-flex justify-content-between mt-3 " >
            <button class="bg-primary rounded-3  fs-5 border-0"><a href="#"  class="text-decoration-none text-white">back</a></button>
            <h2>Online Voting System</h2>
            <button class="bg-danger rounded-2 fs-5 border-0"><a href="../api/logout.php"  class="text-decoration-none text-white">logout</a></button>
        </div>
        <hr>
        <div class="voter-group-container d-flex justify-content-between gap-4 px-3">
          <div class="voter_container rounded-3 p-4">
            <div class="img text-center mb-">
            <img src="../uploads/<?php echo $userdata['photo']?>" alt="" height="100px" width="100px" class="rounded-pill mb-3">
            </div>
            <p><span class="fs-4 fw-bold">Name:</span><?php echo $userdata['name']?></p>
            <p><span class="fs-4 fw-bold">Mobile:</span><?php echo $userdata['mobile']?></p>
            <p><span class="fs-4 fw-bold">Address:</span><?php echo $userdata['address']?></p>
            <p><span class="fs-4 fw-bold">status:</span><?php if($userdata['status']==0){
              echo "not-voted";
              }else{echo"<span class='text-success fw-bold fs-4'>voted</span>";}
                ?></p>
          </div>
          <div class="group_container rounded-3 p-4">
            <?php 
            if($_SESSION['groups_data']){
              for($i=0;$i<count( $group_data);$i++){
             ?>
            <div class="groups px-4">
              <div class="row">
                <div class="col-8">
                <p class="fs-4"><span class="fs-4 fw-bold">Group Name:</span><?php echo $group_data[$i]['name']?></p>
                <p class="fs-3"><span class="fs-4 fw-bold">Votes:</span><?php echo $group_data[$i]['votes']?></p>
                <form action="../api/vaotes.php" method="post">
                  <input type="hidden" name="g_votes" value="<?php echo $group_data[$i]['votes'] ?>">
                  <input type="hidden" name="g_id" value="<?php echo $group_data[$i]['id'] ?>">
                  <?php if($userdata['status']==0){?>
                  <input type="submit" name="votebtn" class="bg-success text-white border-0 p-2 rounded-3" value="vote">
                <?php }
                else{
                echo'  <input disabled type="submit" name="votebtn" class="bg-danger text-white border-0 p-2 rounded-3" value="vote">';
                }
                ?>
                  </form>
                </div>
                <div class="col-4 text-end">
                <img src="../uploads/<?php echo $group_data[$i]['photo']?>" alt="" height="100px" width="100px" class="rounded-pill mb-3">
                </div>
              </div>
              <hr>
            </div>
            
           <?php  }
            }?> 

          </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
