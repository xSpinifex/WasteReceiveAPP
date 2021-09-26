<div class ="delete">
    <?php
  //  dump($params);
    $contact = $params ['contact'] ?? null; 

    ?>
    <?php if($contact): ?>

        <ul>
        <li>
            id:  <?php echo $contact['id'];  ?>
        </li>
        <li>
            Nazwa:  <?php echo $contact['name'];  ?>
        </li>
        <li>
            NIP:  <?php echo $contact['nip'];  ?>
        </li>
        <li>
        Adres:  <?php echo $contact['address'];  ?>
        </li>
        <li>
            Kod pocztowy:  <?php echo $contact['zip_code'];  ?>
        </li>
        <li>
            Miasto:  <?php echo $contact['city'];  ?>
        </li>
        <li>
            Numer BDO:  <?php echo $contact['bdo_number'];  ?>
        </li>

        <li>
            Utworzono:  <?php echo $contact['created'];  ?>
        </li>
        <li>
            Uwagi:  <?php echo $contact['description'];  ?>
        </li>
    </ul>
  <!-- zmiany dokonywane postem -->
  <form method="POST" action="/?module=contacts&action=delete">
        <input name="id" type="hidden" value="<?php echo $contact['id']; ?>"/>
        <input type="submit" value="USUŃ" />

</form>
    
    <?php else: ?>
        <div> brak kontaktu do wyswietlenia </div>
    <?php endif; ?>

    <a href ="/?module=contacts&action=contactsList"><button> Powrót do listy</button></a>

</div>