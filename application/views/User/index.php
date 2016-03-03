<!DOCTYPE html>
  <html>
    <head>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Hint</title>
    </head>

    <body class="grey lighten-2">
      <header>
        <nav>
          <div class="nav-wrapper" style="padding-left:20px;padding-right:20px">
            <a href="#" class="brand-logo"><img src="<?php echo base_url(); ?>assets/img/hint-icon-transparent.png" width="50" height="50" style="margin-top:10%"></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li>
                <?php if($this->session->userdata('facebook')!=null){ ?>
                  <a href="#" class="dropdown-button" data-beloworigin="true" data-activates="dropdownUser"><i class="material-icons left">verified_user</i><?php echo $this->session->userdata('facebook')['name'] ?><i class="material-icons right">arrow_drop_down</i></a>
                <?php }else{ ?>
                  <a href="#" class="dropdown-button" data-beloworigin="true" data-activates="dropdownUser"><i class="material-icons left">verified_user</i><?php echo $this->session->userdata('loginSession')['name'] ?><i class="material-icons right">arrow_drop_down</i></a>
                <?php } ?>
                <ul id="dropdownUser" class="dropdown-content">
                  <li>
                    <a class="" href="<?php echo site_url('Login/doLogout'); ?>"><i class="material-icons left">power_settings_new</i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/hint.js"></script>
    </body>
  </html>
