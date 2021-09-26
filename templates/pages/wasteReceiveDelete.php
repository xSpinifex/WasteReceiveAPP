<div class ="delete">
    <?php
  //  dump($params);
    $wasteReceive = $params ['wasteReceive'] ?? null; 

    ?>
    <?php if($wasteReceive): ?>

        <ul>
        <li>
            id:  <?php echo $wasteReceive['id'];  ?>
        </li>
        <li>
            Data Przyjęcia:  <?php echo $wasteReceive['date'];  ?>
        </li>
        <li>
            Kontrahent:  <?php echo $wasteReceive['customer_id'];  ?>
        </li>
        <li>
        Transportujący:  <?php echo $wasteReceive['transporter_id'];  ?>
        </li>
        <li>
            Rejestracja:  <?php echo $wasteReceive['plateNumber'];  ?>
        </li>
        <li>
            Waga brutto:  <?php echo $wasteReceive['carWeightBrutto'];  ?>
        </li>
        <li>
            Waga netto:  <?php echo $wasteReceive['carWeightNetto'];  ?>
        </li>
        <li>
            Waga odpadów:  <?php echo $wasteReceive['WasteWeight'];  ?>
        </li>
        <li>
            Kod odpadów:  <?php echo $wasteReceive['wasteType'];  ?>
        </li>
        <li>
            Magazyn:  <?php echo $wasteReceive['warehouse'];  ?>
        </li>

        <li>
            Utworzono:  <?php echo $wasteReceive['created'];  ?>
        </li>
        <li>
            Uwagi:  <?php echo $wasteReceive['description'];  ?>
        </li>
    </ul>
  <!-- zmiany dokonywane postem -->
  <form method="POST" action="/?module=waste&action=delete">
        <input name="id" type="hidden" value="<?php echo $wasteReceive['id']; ?>"/>
        <input type="submit" value="USUŃ" />

</form>
    
    <?php else: ?>
        <div> brak przyjęcia do wyswietlenia </div>
    <?php endif; ?>

    <a href ="/?module=waste&action=wasteReceiveList"><button> Powrót do listy</button></a>

</div>