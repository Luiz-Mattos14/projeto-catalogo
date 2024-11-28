<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/style/style.css?v=1">
    <script type="module" src="<?php echo BASE_URL; ?>assets/javascripts/main.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <title>Projeto - Catalogo</title>
</head>

<?php
$body = explode("\\", str_replace("controller", "", strtolower($newController)));
$template = $body[2];
?>

<body class="page-<?php echo $template ?>" data-page="page-<?php echo $template ?>">
  <?php include "./views/common/icons.php" ?>

   <main>
      <?php $this->loadViewInTemplate($viewName, $viewData); ?>
   </main>

</body>
</html>
