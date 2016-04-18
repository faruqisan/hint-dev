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
      <main>
        <div class="container">
          <div class="row">
            <div class="col l12 s12">
              <?php //var_dump($dataTravel); ?>

              <table class="bordered highlight">
                <thead>
                  <tr>
                    <th>Nama Perusahaan</th>
                    <th>Alamat</th>
                    <th>No TDUP</th>
                    <th>Wilayah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($dataTravel as $row){ ?>
                    <tr>
                      <td><?php echo $row->nama_perusahaan ?></td>
                      <td><?php echo $row->alamat ?></td>
                      <td><?php echo $row->no_tdup ?></td>
                      <td><?php echo $row->wilayah ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/hint.js"></script>
    </body>
  </html>
