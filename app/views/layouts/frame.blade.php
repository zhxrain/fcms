<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />

  <?= javascript_include_tag() ?>
  <?= stylesheet_link_tag() ?>
  <?= stylesheet_link_tag('frame') ?>
</head>
<body>
  <div id="frame-container">
    @yield('content')
  </div>
</body>
