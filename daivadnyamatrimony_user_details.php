<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/daivadnya_user_details.css">
  <style>
   .breadcrumb
   {
    margin-top: -21px;
    background-color: lightgrey;
   }
   .breadcrumb > li + li:before {
    color: #111;
    content: "/ ";
    padding: 0 5px;
}
  </style>

  </head>
  <body style="background-color:#f3efef;;">
    <!--Getting all user details -->
    <?php
    session_start();
        $url2 = 'https://daivadnyamatrimony.herokuapp.com/user_detail_web/';
        $options2 = array(
          'http' => array(
          'header'  => array(
                      'PK: '.$_GET['pk'],
                    ),
            'method'  => 'GET',
          ),
        );
        $context2 = stream_context_create($options2);
        $output3 = file_get_contents($url2, false,$context2);
        // echo $output3;
        $arr3 = json_decode($output3,true);
    ?>

    <!--using del_user name(and in input field we are giving value as $_GET['pk'] to reffer a specific user value)for making user active and inactive-->
    <?php
      if(isset($_POST['edit_users'])){
        $url2 = 'https://daivadnyamatrimony.herokuapp.com/user_detail_web/';
        $options2 = array(
          'http' => array(
          'header'  => array(
                      'PK: '.$_POST['edit_user'],
                    ),
            'method'  => 'GET',
          ),
        );
        $context2 = stream_context_create($options2);
        $output3 = file_get_contents($url2, false,$context2);
        // echo $output3;
        $arr3 = json_decode($output3,true);
      }
    ?>

    <!--making user active-->
    <?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);   
      if(isset($_POST['disable_user']))
      {
          $url_a = 'https://daivadnyamatrimony.herokuapp.com/update_status/';
          $options_a = array(
            'http' => array(
            'header'  => array(
                        'PK: '.$_POST['edit_user'],
                        'STATUS: '.'active',                 
                      ),
              'method'  => 'GET',
            ),
          );
          $context_a = stream_context_create($options_a);
          $output_a = file_get_contents($url_a, false,$context_a);
          
          $arr_a = json_decode($output_a,true);
          echo "<script>location='daivadnya_database.php'</script>";
      }
    ?>

    <!--making user inactive-->
    <?php
      if(isset($_POST['enable_user']))
      {
          $url_a = 'https://daivadnyamatrimony.herokuapp.com/update_status/';
          $options_a = array(
            'http' => array(
            'header'  => array(
                        'PK: '.$_POST['edit_user'],
                        'STATUS: '.'inactive',                 
                      ),
              'method'  => 'GET',
            ),
          );
          $context_a = stream_context_create($options_a);
          $output_a = file_get_contents($url_a, false,$context_a);
          // echo $output_a;
          $arr_a = json_decode($output_a,true);
          echo "<script>location='daivadnya_database.php'</script>";
      }
    ?> 

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Daivadnya Matrimony Belgaum</a>
          <a href="daivadnya_login.php" style="margin-left: 900px;line-height:3;color:#fff;">LOGOUT</a>
        </div>
      </div>
    </nav>

    <ol class="breadcrumb">
      <li class=''><a href="daivadnya_database.php">Matrimony</a></li>
      <li class=''>Details</li>
    </ol>

		<h4 class="loan_application" style="margin-left:52%;"><b>User Details</b></h4><br>
      <div class="container">
        <div class="row">
          <div class="col-sm-2"></div>
            <div class="col-sm-8">

              <div class="card">
                <div class="card-body">
                  <div class="row" style="height:37px;"><h4></h4></div>

                    <div class="row">
                      <div class="col-sm-3">
                        <?php if($arr3['user']['profile_image_url'] == ""){?>
                        <img style="max-width:50%;margin-left:70px;" src="profile.png"></img>
                        <?php }else{ ?>
                        <img style="max-width:50%;margin-left:70px;" src="<?php echo $arr3['user']['profile_image_url']; ?>"></img>
                        <?php } ?>
                      </div><!--col-sm-3-->
                      <div class="col-sm-1"></div>
                      <div class="col-sm-8">
                        <div class="row"><span class="row_text">PERSONAL DETAILS</span></div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div>
                              <label for="email" style="" class="labeltext">Name</label>
                              <input value="<?php echo $arr3['user']['profile_details']['fullname']; ?>" type="text" class="text-line" id="name" placeholder="" name="name">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Contact Number</label>
                              <input value="<?php echo $arr3['user']['profile_details']['phone']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Qualification</label>
                              <input value="<?php echo $arr3['user']['profile_details']['qualification']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Employment</label>
                              <input value="<?php echo $arr3['user']['profile_details']['employment']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Date of Birth</label>
                              <input value="<?php echo $arr3['user']['profile_details']['dob']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Time</label>
                              <input value="<?php echo $arr3['user']['profile_details']['time']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Family Type</label>
                              <input value="<?php echo $arr3['user']['profile_details']['family_type']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                             <div>
                              <label for="email" class="labeltext">Rashi</label>
                              <input value="<?php echo $arr3['user']['profile_details']['rashi']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            
                            <div>
                              <label for="email" class="labeltext">Feet Height</label>
                              <input value="<?php echo $arr3['user']['profile_details']['feet_height']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            
                          </div><!--col-sm-4-->
                          <div class="col-sm-2"></div>
                          <div class="col-sm-4">
                            <div>
                              <label for="email" class="labeltext">Father Name</label>
                              <input value="<?php echo $arr3['user']['profile_details']['father_name']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Gender</label>
                              <input value="<?php echo $arr3['user']['profile_details']['gender']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Current Location</label>
                              <input value="<?php echo $arr3['user']['profile_details']['location']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Income</label>
                              <input value="<?php echo $arr3['user']['profile_details']['income']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Birthplace</label>
                              <input value="<?php echo $arr3['user']['profile_details']['birthplace']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                             <div>
                              <label for="email" class="labeltext">Age</label>
                              <input value="<?php echo $arr3['user']['profile_details']['age']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                             <div>
                              <label for="email" class="labeltext">Nakshatra</label>
                              <input value="<?php echo $arr3['user']['profile_details']['nakshatra']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Gotra</label>
                              <input value="<?php echo $arr3['user']['profile_details']['gotra']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                            <div>
                              <label for="email" class="labeltext">Inch Height</label>
                              <input value="<?php echo $arr3['user']['profile_details']['inch_height']; ?>" type="text" class="text-line" id="pwd" placeholder="" name="pwd">
                            </div>
                          <div>
                           <form method="post" action="daivadnyamatrimony_user_details.php" style="text-align:center" >
                           <input name="edit_user" style="width:50%" type="hidden" class="form-control"  value="<?php echo $_GET['pk'];?>"></input>

                           <?php ini_set('display_errors', 'On'); error_reporting(E_ALL); if($arr3['user']['profile_details']['status']=="active"){ ?>
                           <button class="btn ena_dis" onclick="return confirm('Are you sure to make user Inactive?')" type="submit" name="enable_user">Change Status</button>
                           <?php }else{ ?>
                           <button class="btn ena_dis" onclick="return confirm('Are you sure to make user Active?')" type="submit" name="disable_user">Change Status</button>
                           <?php } ?>
                            </form>
                          </div>
                          </div><!--col-sm-4-->
                          <div class="col-sm-2"></div>
                          </div><!--row of col-sm-8-->
                        </div><!--col-sm-8-->
                      </div><!--sub_main row-->

                    </div><!--card-body-->
                </div><!--card-->
              </div><!--col-sm-8-->
            <div class="col-sm-2"></div>
          </div><br><br><!--row--> 
        </div><!--container-->
  </body>
  </html>