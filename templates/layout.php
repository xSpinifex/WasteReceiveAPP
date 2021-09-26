<html lang="pl">

<head>
  <title>Przyjmowanie Odpadów</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <script src="https://kit.fontawesome.com/b0d34bd04d.js" crossorigin="anonymous"></script>

  <link href="/public/style.css" rel="stylesheet">


</head>

<body class="body">
  <div class="wrapper">
    <div class="header">
      <h1><i class="fas fa-trash-alt"></i> Przyjęcia Odpadów</h1>

    </div>

    <div class="container">
      <div class="menu">
        <ul>
          <li><a href="/">Home Page</a></li>
          <li><a href="/?module=contacts&action=contactsList">Kontakty</a></li>
          <li><a href="/?module=contacts&action=createContact">Nowy Kontakt</a></li> <!--   -->
          <li><a href="/?module=waste&action=wasteReceiveList">Przyjęcia</a></li>
          <li><a href="/?module=waste&action=wasteReceiveCreate">Nowe Przyjęcie</a></li>
        </ul>
      </div>

      <div class="page">

        <?php require_once("templates/pages/$page.php");

        ?>
      </div>
    </div>

    <div class="footer">
      <p>Przyjmowanie odpadów - projekt w PHP</p>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>