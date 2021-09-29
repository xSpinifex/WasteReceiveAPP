<html lang="pl">

<head>
  <title>Przyjmowanie Odpadów</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/b0d34bd04d.js" crossorigin="anonymous"></script>

  <link href="../public/style.css" rel="stylesheet">

</head>

<body>
  <header>
    <div class="container-fluid p-4 bg-cadetblue mb-2">
      <h1><i class="fas fa-trash-alt pr-2"></i>Przyjęcia Odpadów</h1>
    </div>
  </header>

  <main class="container-fluid row">

    <nav class="col-4 col-lg-2 mt-4 flex-column">
      <a class="nav-link bg-light text-info border border-light" href="/">Home</a>
      <a class="nav-link bg-light text-info border border-light" href="/?module=contacts&action=contactsList">Kontakty</a>
      <a class="nav-link bg-light text-info border border-light" href="/?module=contacts&action=createContact">Nowy Kontakt</a>
      <a class="nav-link bg-light text-info border border-light" href="/?module=waste&action=wasteReceiveList">Przyjęcia</a>
      <a class="nav-link bg-light text-info border border-light" href="/?module=waste&action=wasteReceiveCreate">Nowe Przyjęcie</a>
    </nav>

    <section class="col-8 col-lg-10">
      <?php require_once("templates/pages/$page.php");
      ?>
    </section>

  </main>

  <footer class="">
    <div class="container-fluid p-4 bg-cadetblue mb-2 text-center">
      <p class="text-black-50">Przyjmowanie odpadów - projekt w PHP & bootstrap</p>
    </div>

  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>