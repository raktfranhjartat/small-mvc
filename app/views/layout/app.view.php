<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="manifest" href="/manifest.json">   -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- BOOTSTRAP CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- JQUERY JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.1.0"></script>
    <title><?= DOMAIN ?> - <?=$pageTitle?> </title>
</head>
<body data-page="<?=$pageTitle?>" class="d-flex flex-column h-100">

<!-- Flash messages -->
<?php component('ui/flash'); ?>

<!-- Menu -->
<?php component('sections/menu', ['pageTitle' => $pageTitle]); ?>

<!-- Main content -->
<main class="container py-4">
  <?php require $viewFile; ?>
</main>

<!-- Footer -->
<?php component('sections/footer', [
    'url' => 'https://github.com/raktfranhjartat/small-mvc',
    'title' => 'Small MVC on GitHub'
]); ?>

<!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/javascript/main.js"></script>

</body>
</html>