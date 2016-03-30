<!DOCTYPE html>
  <html>
    <head>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Help I Need Travel</title>
    </head>

    <body class="grey lighten-2">
      <?php $result = $this->session->flashdata('result'); ?>
        <?php if(isset($result)){ ?>
          <script type="text/javascript">
            alert("<?php echo $this->session->flashdata('result'); ?>");
          </script>
        <?php } ?>
      <div class="parallax-container" style="height:100vh">
        <div class="parallax" ><img src="<?php echo base_url(); ?>assets/img/hint-parallax-bg-small-transparent.png"></div>
        <div class="row">
          <div class="col l12 s12">
            <div class="row">
              <div class="col l12 s12">
                <h1 class="center-align" style="font-family: 'Cuprum', sans-serif;color:#616161"><b>Help, I need Travel !</b></h1><br>
                <h4 class="center-align" style="font-family: 'Pacifico', sans-serif;color:#9e9e9e;margin-top:-3%"><b>We have what you need</b></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section red lighten-2">
        <div class="row">
          <div class="col l4 s12 offset-l4" >
            <div class="card hoverable"style="margin-top:-28.5%">
              <form action="Login/doLogin" method="post">
                <div class="card-content">
                  <!-- go to down button -->
                  <button onclick="scroll(loginCard)" onmouseover="setOpacity(1)" onmouseout="setOpacity(0.6)" class="btn-floating btn-large waves-effect waves-light grey lighten-2 right" type="button" id="downArrow" style="margin-top:-12%;margin-right:-12%;opacity:0.6">
                    <i class="material-icons black-text">keyboard_arrow_down</i>
                  </button>
                  <h4 class="center-align">Please, Come in</h4>
                </div>
                <div class="card-content">
                  <div class="row">
                    <div class="input-field col l12 s12">
                      <i class="material-icons prefix">email</i>
                      <input type="email" id="email" name="email" class="validate" required="">
                      <label for="email">Email</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l12 s12">
                      <i class="material-icons prefix">lock</i>
                      <input type="password" id="password" name="password" class="validate" required="">
                      <label for="password">Password</label>
                    </div>
                  </div>
                </div>
                <div class="card-action grey lighten-2">
                  <div class="row">
                    <!-- facebook login button -->
                    <a href="<?php echo htmlspecialchars($fbLoginUrl); ?>"class="tooltipped btn-floating btn-large waves-effect waves-light white-text right" data-position="bottom" data-delay="50" data-tooltip="When login with Facebook, your email will be stored in the database and cannot be used for public registration and login" type="button" style="background-color:#3b5998;margin-top:-12%">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </div>
                  <div class="row">
                    <div class="col l12 s12">
                      <button class="btn waves-effect waves-light teal lighten-2" type="submit" style="width:100%">Sign in
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                  <div class="row" id="loginCard">
                    <div class="col l12 s12">
                      <a href="#modalRegister" class="modal-trigger btn waves-effect waves-light red lighten-2 white-text" style="width:100%">Sign up
                        <i class="material-icons right">add</i>
                      </a>
                    </div>
                  </div>
                </div>
              </form>
              <div id="modalRegister" class="modal">
                <div class="modal-content">
                  <h4>Register</h4>
                  <div class="row">
                    <div class="input-field col l12 s12">
                      <i class="material-icons prefix">people</i>
                      <input id="registerName" type="text" class="validate" required="" tabindex="1">
                      <label for="registerName">Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col l6 s12">
                      <i class="material-icons prefix">email</i>
                      <input onkeyup="checkAvaibility()" id="registerEmail" type="email" class="validate" required="" tabindex="2">
                      <label for="registerEmail">Email</label>
                    </div>
                    <div class="input-field col l6 s12">
                      <i class="material-icons prefix">vpn_key</i>
                      <input id="registerPassword" type="password" class="validate" required="" tabindex="3" minlength="5" maxlength="20">
                      <label for="password">Password ( Min. 5 char )</label>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button onclick="registerUser()" class="modal-action modal-close btn waves-effect waves-light" id="buttonSubmit">Daftar
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/md5.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/hint.js"></script>

    </body>
  </html>
