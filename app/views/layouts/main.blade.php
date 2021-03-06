<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />

  <?= javascript_include_tag() ?>
  <?= stylesheet_link_tag() ?>

  <script>
    $(document).ready(function () {
      $('ul.menubar li').click(function(e)
      {
        $('ul.menubar li').removeClass();
        $("#frame").attr("src", $(this).attr('uri'));
        $(this).attr('class', 'pure-menu-selected');
      });

      $('.nav').find('li').first().addClass('active');

      $(".nav").navgoco({
        accordion: true,
        onClickBefore: function(e, submenu) {
          console.log('Clicked on '+ (submenu === false ? 'leaf' : 'branch') + ' `'+$(this).text()+'`');
        },
        onClickAfter: function(e, submenu) {
          e.preventDefault();
          $('.nav').find('li').removeClass('active');
          var li =  $(this).parent();
          var lis = li.parents('li');
          li.addClass('active');
          lis.addClass('active');

          var uri = li.attr('uri');
          var item_id = li.attr('item_id');
          if(uri){
            $("#frame").attr("src", uri);
            if(item_id)
              $("#submenu").attr("src", "submenu/"+item_id);
          }
        },
        onToggleBefore: function(submenu, opening) {
          var idx = submenu.attr('data-index');
          var message = opening ? 'opening' : 'closing';
          console.log('I am ' + message + ' menu ' + idx + ' just after this.');
        },
        onToggleAfter: function(submenu, opened) {
          var idx = submenu.attr('data-index');
          var message = opened ? 'opened' : 'closed';
          console.log('I ' + message + ' menu ' + idx + ' just before this.');
        }
      });

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

      $("#container > .ui-layout-center").layout({
          closable: false
        , north__size: 36
        , north__resizable: false
        , north__spacing_open: 0
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
        @if(Auth::check())
          <span class="profile-btn" data-dropdown="#dropdown-profile">{{ $current_user->username }}</span>(<a href="user/logout">注销</a>)
        @endif
      </div>
    </div>
  </div>
  <div class="pane ui-layout-west" id="nav-sidebar">
    <ul class="nav">
    <?php
      $depth=0;
      foreach($menu_items as $n=>$item)
      {
        if($item->submenu_flag==1)
        {
          continue;
        }
        if($item->depth==$depth)
        {
          echo "</li>\n";
        }
        else if($item->depth>$depth)
        {
          echo "<ul>\n";
        }
        else
        {
          echo "</li>\n";

          for($i=$depth-$item->depth;$i;$i--)
          {
            echo "</ul>\n";
            echo "</li>\n";
          }
        }

        echo "<li uri=\"".$item->uri."\""."item_id=\"".$item->id."\">";
        echo "<a href=\"#\">";
        echo $item->name;
        echo "</a>\n";
        $depth=$item->depth;
      }

      for($i=$depth;$i;$i--)
      {
        echo "</ul>\n";
        echo "</li>\n";
      }
    ?>
    </ul>
  </div>
  <div class="pane ui-layout-center">
    <div class="ui-layout-north" style="text-align:left; overflow:hidden;">
      <iframe id="submenu" src="submenu/{{ $second_item->id }}" width ="100%" height="100%"></iframe>
    </div>
    <div class="ui-layout-center" align="center">
      <div id='page'>
        <iframe id="frame" src="user" width="100%" height="100%"></iframe>
      </div>
    </div>
  </div>
  <div class="pane ui-layout-south">
    <div id="footer">
      Copyright &copy; <?php echo date('Y'); ?> by My Company. All Rights Reserved.
    </div><!-- footer -->
  </div>

<div id="dropdown-profile" class="dropdown dropdown-tip has-icons dropdown-anchor-right">
  <ul class="dropdown-menu">
    <li class="undo"><a href="#">Undo</a></li>
    <li class="redo"><a href="#">Redo</a></li>
    <li class="dropdown-divider"></li>
    <li class="cut"><a href="#">Cut</a></li>
    <li class="copy"><a href="#">Copy</a></li>
    <li class="paste"><a href="#">Paste</a></li>
    <li class="delete"><a href="#">Delete</a></li>
  </ul>
</div>
</div>
</body>
</html>
