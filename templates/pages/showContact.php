<div class ="show">
    <?php
  // dump($params);
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
  
    <a href ="/?module=contacts&action=edit&id=<?php echo $contact['id'] ?>"><button> Edytuj</button></a>
    <?php else: ?>
        <div> brak notatki do wyswietlenia </div>
    <?php endif; ?>

    <a href ="/?module=contacts&action=contactsList"><button> Powrót do listy</button></a>

</div>