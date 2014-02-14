<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />

  <?= javascript_include_tag() ?>
  <?= stylesheet_link_tag() ?>

  <script>
    $(document).ready(function () {
        $('#container').layout({
            closable: true
          , resizable: true
          , west__size: 180
          , north__size: 84 
          , north__resizable: false
          , north__spacing_open: 0
          , south__resizable: false
          , south__spacing_open: 0
        });
        $("#container > .ui-layout-north").layout({
            closable: false
          , west__size: 180
          , west__resizable: false
          , east__size: 180
          , west__spacing_open: 0
          , east__resizable: false
          , east__spacing_open: 0
        });
    });
  </script>
</head>

<body>
<div id="container">
  <div class="header-bg pane ui-layout-north">
    <div class="ui-layout-center" align="center" style="padding-top:30px;">
      <ul id='dock-menu' class='jqDockAuto' data-jqdock-align='bottom' data-jqdock-labels='true'>
        <li><a href='#' title='Favourites'><img src='assets/uploads.png' alt='' /></a></li>
        <li><a href='#' title='Pictures'><img src='assets/uploads.png' alt='' /></a></li>
        <li><a href='#' title='Music'><img src='assets/uploads.png' alt='' /></a></li>
        <li><a href='#' title='Videos'><img src='assets/uploads.png' alt='' /></a></li>
        <li><a href='#' title='Uploads'><img src='assets/uploads.png' alt='' /></a></li>
      </ul>
    </div>
    <div class="ui-layout-east" style="text-align:right;">
      <div style="margin: 50px 10px 5px 0px;">
       </div>
    </div>
  </div>
  <div class="pane ui-layout-west" id="nav-sidebar">
    <ul class="nav">
      <p>WEST!</p>
    </ul>
  </div>
  <div class="pane ui-layout-center">
    <div id="page">
      <iframe id="frame" src="user" width="100%" height="100%"></iframe>
    </div>
  </div>
  <div class="pane ui-layout-south">
    <div id="footer">
      Copyright &copy; <?php echo date('Y'); ?> by My Company. All Rights Reserved.
    </div><!-- footer -->
  </div>

<!--div id="dropdown-profile" class="dropdown dropdown-tip has-icons dropdown-anchor-right">
  <ul class="dropdown-menu">
    <li class="undo"><a href="#">Undo</a></li>
    <li class="redo"><a href="#">Redo</a></li>
    <li class="dropdown-divider"></li>
    <li class="cut"><a href="#">Cut</a></li>
    <li class="copy"><a href="#">Copy</a></li>
    <li class="paste"><a href="#">Paste</a></li>
    <li class="delete"><a href="#">Delete</a></li>
  </ul>
</div-->
</div>
</body>
</html>
