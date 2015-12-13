<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
	<title>Document</title>
  <script src="<?php echo base_url();?>public/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url();?>public/js/backend_index.js"></script>
  <script src="<?php echo base_url();?>public/bower_components/webcomponentsjs/webcomponents.js"></script>
  <script src="<?php echo base_url();?>public/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url();?>public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>public/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/css/backend_index.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-toast/paper-toast.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-input/paper-input.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-spinner/paper-spinner.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-button/paper-button.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-dialog/paper-dialog.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-icon-button/paper-icon-button.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/iron-icon/iron-icon.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/paper-styles/paper-styles.html"/>
  <link rel="import" href="<?php echo base_url();?>public/bower_components/iron-icons/iron-icons.html"/>
</head>
<body>
    <div class="sidebar">
        <ul>
           <div class="sidebar-head"><a  href='#' onclick=Location.reload()><i class="sidebar-icon fa fa-android fa-2x" ></i><span>職業夢想家</span></a></div>
           <li id="dashboard" class="sidebar-link "><a href='#' onclick=changepage(this);><i class="sidebar-icon fa fa-tachometer fa-2x"></i><span>儀表版</span></a></li>
           <li id="message"  class="sidebar-link " ><a href='#' onclick=changepage(this);><i class="sidebar-icon fa fa-paper-plane-o fa-2x"></i><span>訊息推播</span></a></li>
           <li id="version" class="sidebar-link " ><a href='#' onclick=changepage(this);><i class="sidebar-icon fa fa-pencil fa-2x"></i><span>版本控制</span></a></li>
           <li id="setting" class='sidebar-link ' ><a href='#' onclick=changepage(this);><i class="sidebar-icon fa fa-wrench fa-2x"></i><span>設定</span></a></li>
           <li class="sidebar-bottom" data-placement="right"><a href='backend/logout' ><i class="sidebar-icon fa fa-power-off fa-2x"></i><span>登出</span></a></li>
        </ul>
    </div>
<div class="headaction">
    <h1 class="page-header">儀表板</h1>
</div>
<div id="contain">
   <script>
   $(document).ready(function(){
    changepaged('#{action}');
   })
   </script>
</div>
</body>
</html>