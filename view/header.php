<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html lang="<?= mb_strtolower($_SESSION['lang']);?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $render[$_SESSION['lang']]['_title_']; ?></title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="icon" href="icon/favicon.png"/>
  <link rel="stylesheet" href="css/style.css">
  <script>
  var err = JSON.parse('<?= json_encode($render) ?>');
  var lang = '<?= $_SESSION['lang'];?>';
  </script>
</head>
<body>

  <!-- BEGIN Header -->
  <header>
 </header>
 <!-- END Header -->

<!-- BEGIN Main -->
