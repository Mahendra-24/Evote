<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>jQuery dsCountDown Examples</title>
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel='stylesheet' href='dscountdown.css' type='text/css' media='all' />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <!-- <script type="text/javascript" src="dscountdown.js"></script> -->
  <script type="text/javascript" src="dscountdown.min.js"></script>
  <script>
    jQuery(document).ready(function($) {



      $('.demo2').dsCountDown({
        endDate: new Date("December 1, 2020 23:59:00"),
        theme: 'black'
      });


    });
  </script>
</head>

<body>






  <h4>Black Theme</h4>
  <div class="demo2"></div>




</body>

</html>