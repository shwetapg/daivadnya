<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/daivadnya_login.css">
</head>
<body>
    <?php
      session_start();
        if(isset($_POST['login'])){
        $url2 = 'https://daivadnyamatrimony.herokuapp.com/login/';
        $options2 = array(
          'http' => array(
            'header'  => array(
                          'USERNAME: '.$_POST['username'],
                          'PASSWORD: '.$_POST['pwd'],
                        ),
            'method'  => 'GET',
          ),
        );
        $context2 = stream_context_create($options2);
        $output2 = file_get_contents($url2, false,$context2);
        /*echo $output2;*/
        $arr2 = json_decode($output2,true);

        if($arr2['status']==200){
          $_SESSION['login_mmi_dealer'] = 1;
          $_SESSION['dealer_token'] = $arr2['dealer_details']['token'];
          echo "<script>location='daivadnya_database.php'</script>";
        }elseif($arr2['status']==400){
          echo "<script>alert('Invalid Credentials');</script>";
        }
        }
    ?>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Daivadnya Matrimony Belgaum</a>
        </div>
      </div>
    </nav>
    <h4 style="text-align:center">Login Panel</h4>
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h4 class="heading"><span style="margin-left:20px;">Daivadnya Matrimony Belgaum</span></h4>
              <div class="container">
               <form action="./daivadnya_login.php" method="post">
                 <div class="form-group">
                  <label>Username:</label>
                   <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                 </div>
                 <div class="form-group">
                  <label>Password:</label>
                   <input type="password" class="form-control" id="pwd" placeholder="Password" name="pwd">
                 </div>
                 <button name="login" type="submit" class="btn" style="margin-left:102px;">Login</button><br>
               </form>
              </div><!--container-->
            </div><!--card-body-->
          </div><!--card-->
        </div><!--col-sm-4-->
        <div class="col-sm-4"></div>
      </div><!--row-->
  </body>
  </html>
