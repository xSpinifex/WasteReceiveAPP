<html lang="pl">

<head>
  <title>Przyjmowanie Odpadów</title>
  <meta charset="utf-8">
  <!-- //<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"> -->
  <script src="https://kit.fontawesome.com/b0d34bd04d.js" crossorigin="anonymous"></script>
  <link href="/public/style.css" rel="stylesheet">


</head>

<body class="body">
  <div class="wrapper">
    <div class="header">
      <h1><i class="fas fa-trash-alt"></i>   Przyjęcia Odpadów</h1>
      
    </div>

    <div class="container">
      <div class="menu">
        <ul>
          <li><a href="/">Home Page</a></li>
          <li><a href="/?module=contacts&action=contactsList">Kontakty</a></li>
          <li><a href="/?module=contacts&action=createContact">Nowy Kontakt</a></li>   <!--   -->
          <li><a href="/?module=waste&action=wasteReceiveList">Przyjęcia</a></li>
          <li><a href="/?module=waste&action=wasteReceiveCreate">Nowe Przyjęcie</a></li>
        </ul>
      </div>

      <div class="page">
      
        <?php  require_once("templates/pages/$page.php"); 
       
        ?>
      </div>
    </div>

    <div class="footer">
      <p>Przyjmowanie odpadów - projekt w PHP</p>
    </div>
  </div>
</body>

</html>