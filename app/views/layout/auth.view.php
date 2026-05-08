<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="manifest" href="/manifest.json">   -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- BOOTSTRAP CSS  -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- JQUERY JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.1.0"></script>
    <title><?=$pageTitle?> - <?= DOMAIN ?></title>
</head>
<body data-page="<?=$pageTitle?>" class="d-flex flex-column h-100">

<?php component('ui/flash'); ?>
    
<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
  <div class="container-fluid px-4">

    <!-- Logo -->
    <a class="navbar-brand logo fw-semibold d-flex align-items-center " href="/">
      Budget
    </a>

  </div>
</nav>

<main class="container py-4">
  <div class="hero mb-4">
    <h1 class="h3 text-center mb-0"><?=$pageTitle?></h1>
  </div>
  <div class="content">
  <?php require $viewFile; ?>
  </div>
</main>

<!-- Footer -->
  <div class="footer mt-auto py-3 w-100">
    <div class="text-center">
      © <?php echo date("Y"); ?> <a href="https://budget.kpb.nu">Budget.kpb.nu</a>
    </div>

<!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/javascript/main.js"></script>

</body>
</html>