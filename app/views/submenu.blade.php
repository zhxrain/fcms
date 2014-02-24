<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />

  <?= javascript_include_tag('jquery') ?>
  <?= stylesheet_link_tag('pure-min') ?>
  <?= stylesheet_link_tag('submenu') ?>

  <script>
    $(document).ready(function () {
        $("li").first().attr('class', 'pure-menu-selected');
        $('li').click(function(e)
        {
          $('li').removeClass();
          $("#frame",window.parent.document).attr("src", $(this).attr('uri'));
          $(this).attr('class', 'pure-menu-selected');
        });
    });
  </script>

</head>
<body>
  <div id="submenu-container">
    <div class="pure-menu pure-menu-open pure-menu-horizontal" id="menubar">
      <ul>
        @foreach($menu_items as $menu_item)
          <li uri="{{ $menu_item->uri }}"><a>{{ $menu_item->name }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</body>
