<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MOU Management System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('asset/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('asset/ionicons-2.0.1/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('asset/dist/css/AdminLTE.min.css')?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('asset/dist/css/skins/_all-skins.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('asset/plugins/datatables/dataTables.bootstrap.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap/css/datepicker3.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('asset/bootstrap/css/kki.css')?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>OU</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MOU Application</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account: style can be found in dropdown.less -->
          <li style="display: inline-table;">
            <a href="#" >
              Welcome, 
              <?php echo $this->session->userdata('username')?>
            </a>
            
            
          </li>
          <li>
          	<a href="<?php echo site_url('login/logout');?>" style="color: #f95"><strong>SIGN OUT</strong></a>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
		<?php if(isset($menu['moudonatur'])){ ?>
        <li <?php if($menuaktif == "moudonatur"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('moudonatur');?>">
            <i class="fa fa-files-o"></i> <span>MoU Donatur</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['moueksekutor'])){ ?>
        <li <?php if($menuaktif == "moueksekutor"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('moueksekutor');?>">
            <i class="fa fa-files-o"></i> <span>MoU Eksekutor</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['pembayarandonatur'])){ ?>
        <li <?php if($menuaktif == "pembayarandonatur"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('pembayarandonatur');?>">
            <i class="fa fa-files-o"></i> <span>Pembayaran Donatur</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['pembayarandonatur'])){ ?>
        <li <?php if($menuaktif == "pembayarandonatur"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('selisih');?>">
            <i class="fa fa-files-o"></i> <span>Rekap Selisih</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['pembayaraneksekutor'])){ ?>
        <li <?php if($menuaktif == "pembayaraneksekutor"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('pembayaraneksekutor');?>">
            <i class="fa fa-files-o"></i> <span>Pembayaran Eksekutor</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['donatur'])){ ?>
        <li <?php if($menuaktif == "donatur"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('donatur');?>">
            <i class="fa fa-university"></i> <span>Donatur</span>            
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['eksekutor'])){ ?>
        <li <?php if($menuaktif == "eksekutor"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('eksekutor');?>">
            <i class="fa fa-legal"></i> <span>Eksekutor</span>            
          </a>
        </li>
        <?php } ?>
		
		<?php if(isset($menu['role'])){ ?>
		<li <?php if($menuaktif == "role"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('role');?>">
            <i class="fa fa-files-o"></i> <span>Role</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['user'])){ ?>
        <li <?php if($menuaktif == "user"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('user');?>">
            <i class="fa fa-files-o"></i> <span>User</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['provinsi'])){ ?>
        <li <?php if($menuaktif == "provinsi"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('provinsi');?>">
            <i class="fa fa-map-marker"></i> <span>Provinsi</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['kota'])){ ?>
        <li <?php if($menuaktif == "kota"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('kota');?>">
            <i class="fa fa-map-marker"></i> <span>Kota</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['kecamatan'])){ ?>
        <li <?php if($menuaktif == "kecamatan"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('kecamatan');?>">
            <i class="fa fa-map-marker"></i> <span>Kecamatan</span>
          </a>
        </li>
        <?php } ?>
        
        <?php if(isset($menu['jenisproyek'])){ ?>
        <li <?php if($menuaktif == "jenisproyek"): ?>class="active" <?php endif;?>>
          <a href="<?php echo site_url('jenisproyek');?>">
            <i class="fa fa-files-o"></i> <span>Jenis Proyek</span>
          </a>
        </li>
        <?php } ?>
        
        <!-- <li class="treeview <?php if($menuaktif == "dokumen"): ?>active <?php endif;?>">
          <a href="#">
            <i class="fa fa-map-marker"></i> <span>Dokumen</span>            
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('dokumen/DocMOUEks');?>"><i class="fa fa-circle-o"></i> Dokumen MOU Eksekutor</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
=======
        
>>>>>>> remotes/origin/master
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>