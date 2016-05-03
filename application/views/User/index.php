<!DOCTYPE html>
  <html>
  <head>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10,af-2.1.0,r-2.0.0/datatables.min.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hint</title>
  </head>

  <body class="grey lighten-2">
    <header>
      <div class="navbar-fixed">
        <nav>
          <div class="nav-wrapper" style="padding-left:20px;padding-right:20px">
            <a href="#" class="brand-logo"><img src="<?php echo base_url(); ?>assets/img/hint-icon-transparent.png" width="50" height="50" style="margin-top:10%"></a>
            <ul id="nav-mobile" class="right">
              <li>
                <?php if($this->session->userdata('facebook')!=null){ ?>
                  <a href="#" class="dropdown-button" data-beloworigin="true" data-activates="dropdownUser"><i class="material-icons left">account_circle</i><?php echo $this->session->userdata('facebook')['name'] ?><i class="material-icons right">arrow_drop_down</i></a>
                <?php }else if($this->session->userdata('twitter')!=null){?>
                  <a href="" class="dropdown-button" data-beloworigin="true" data-activates="dropdownUser"><i class="material-icons left">account_circle</i><?php echo $this->session->userdata('twitter')['name'] ?><i class="material-icons right">arrow_drop_down</i></a>
                <?php }else{ ?>
                  <a href="#" class="dropdown-button" data-beloworigin="true" data-activates="dropdownUser"><i class="material-icons left">account_circle</i><?php echo $this->session->userdata('loginSession')['name'] ?><i class="material-icons right">arrow_drop_down</i></a>
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
      </div>
      <ul id="staggered-test" class="collapsible side-nav fixed" data-collapsible="expandable" style="width:370px;margin-top:64px;">
        <li>
          <h5>Daftar Travel</h5>
        </li>
        <?php foreach($dataTravel as $row){ ?>
          <li>
            <div class="collapsible-header"><i class="material-icons">directions_car</i><?php echo $row->nama_perusahaan ?></div>
            <div class="collapsible-body"><p><?php echo $row->alamat ?><br><?php echo $row->wilayah ?></p></div>
          </li>
        <?php } ?>
      </ul>
    </header>
    <main style="padding-left:370px">
      <div class="row">
        <div class="col l12 s12" style="height:90vh;" id=map>
          <script>
            var map;
            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
              });
              var infoWindow = new google.maps.InfoWindow({map: map});
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                  };
                  infoWindow.setPosition(pos);
                  infoWindow.setContent('Location found.');
                  map.setCenter(pos);
                  map.setZoom(10);
                  var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: 'Lokasi Sekarang'
                  });
                }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());
                });
              } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
              }



            }
          </script>
        </div>
      </div>
    </main>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeZRA1aWG_u-9uFATrMBSXu7RNst6dMV8&callback=initMap"async defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/s/dt/jq-2.1.4,dt-1.10.10,af-2.1.0,r-2.0.0/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/hint.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.dataTable').DataTable({
          responsive : true,
          scrollCollapse: true,
          paging:false,
          scrollY:"300px"
      });
    });
    </script>
  </body>
</html>
