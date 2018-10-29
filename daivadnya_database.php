<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/daivadnya_database.css">
</head>
<body>
    <?php
      session_start();
        $url2 = 'https://daivadnyamatrimony.herokuapp.com/get_all_profiles/';
        $options2 = array(
          'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'GET',
          ),
        );
        $context2 = stream_context_create($options2);
        $output2 = file_get_contents($url2, false,$context2);
        /*echo $output2;*/
        $arr2 = json_decode($output2,true);
        // echo $arr2['profiles'][1]['profile_details']['fullname'];
    ?>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Daivadnya Matrimony Belgaum</a>
          <a href="daivadnya_login.php" style="margin-left: 900px;line-height:3;color:#fff;">LOGOUT</a>
        </div>
      </div>
    </nav>
        

    <h4 style="text-align:center">Profile Details</h4>
    <div class="container" style="margin-top:5%">
      <div class="row" >
        <div class="col-sm-3">
          <div class="input-group add-on" style="width: 260px;margin-top: 20px;">
            <input class="form-control" placeholder="Search" id="myInput" type="text" >
              <div class="input-group-btn">
                <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
          </div>
        </div><!--col-sm-3-->
        <div class="col-sm-2">
          <label for="">From:</label>
          <input style="width:180px" class="form-control" placeholder="" name="" id="" type="date">
        </div><!--col-sm-2-->
        <div class="col-sm-2">
          <label for="">To:</label>
          <input style="width:180px" class="form-control" placeholder="" name="" id="" type="date">
        </div><br>
        <div class="col-sm-5" style="text-align:right"></div>
      </div><!--row-->
      <table class="table table-bordered table-striped" style="margin-top:5%;box-shadow:0 0px 0px rgba(0,0,0,0.16), 0 1px 1px rgba(0,0,0,0.23);">
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Profile image</th>
            <th>Fullname</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Age</th>
            <th>Status</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody id="myTable">
          <?php for($x=0;$x<count($arr2['profiles']);$x++){
              $dateTime = new DateTime($arr2['profiles'][$x]['profile_details'][0]['created']);?>
          <tr>
            <td style="white-space: nowrap;"><?php echo $dateTime->format('d-m-Y');?></td>
            <td style="white-space: nowrap;"><?php echo $dateTime->format('h:m:s');?></td> 
            <td style="width:95px;">
              <?php if($arr2['profiles'][$x]['image_url']['url'] == ""){ ?>
                <img style="max-width:55%;max-height:10%;" src="profile.png"></img><br>
                <?php }else{ ?>  
                <img style="max-width:55%;max-height:10%;" src="<?php echo $arr2['profiles'][$x]['image_url']['url']; ?>"></img>
              <?php } ?>
            </td> 
            <td><?php echo $arr2['profiles'][$x]['profile_details'][0]['fullname']; ?></td>
            <td><?php echo $arr2['profiles'][$x]['profile_details'][0]['gender']; ?></td>
            <td><?php echo $arr2['profiles'][$x]['profile_details'][0]['phone']; ?></td>
            <td><?php echo $arr2['profiles'][$x]['profile_details'][0]['location']; ?></td>
            <td><?php echo $arr2['profiles'][$x]['profile_details'][0]['age']; ?></td>
              <?php  
                if($arr2['profiles'][$x]['profile_details'][0]['status']=="active"){ ?>
                  <!-- <label class="switch" >
                    <input type="checkbox" name="active_toggle_status" checked readonly>
                    <span class="slider round"></span>
                  </label> -->
                  <td style="color:green;"><?php echo $arr2['profiles'][$x]['profile_details'][0]['status']; ?></td>
                <?php }else{ ?>
                  <!-- <label class="switch">
                    <input type="checkbox" name="inactive_toggle_status" readonly>
                    <span class="slider round"></span>
                  </label> -->
                   <td style="color:red;"><?php echo $arr2['profiles'][$x]['profile_details'][0]['status']; ?></td>
                <?php }?>
            <td>
             <button onclick="window.location.href='./daivadnyamatrimony_user_details.php?pk=<?php echo $arr2['profiles'][$x]['profile_details'][0]['user'];?>'" type="button" class="btn">Details</button>
            </td>
          </tr>
          <?php }?>  <!--closing for loop-->
        </tbody>
      </table>
    </div><!--container-->
  
    <script>
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
    </script>
  </body>
  </html>