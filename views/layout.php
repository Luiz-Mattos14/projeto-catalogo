<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/style/style.css"> -->

    <title>Projeto - Catalogo</title>
</head>

<?php
$body = explode("\\", str_replace("controller", "", strtolower($newController)));
$template = $body[2];
?>

<body class="page-<?php echo $template ?>" data-page="page-<?php echo $template ?>">
   <main>
      <?php $this->loadViewInTemplate($viewName, $viewData); ?>
   </main>
</body>
</html>
