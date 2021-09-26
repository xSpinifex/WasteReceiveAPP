<div>
  <h3> EDYCJA PRZYJĘCIA</h3>
  <div>
<?php if (!empty($params ['wasteReceive'])): ?>

  <?php //dump($params);
     $wasteReceive = $params ['wasteReceive'] ?? null; 
     $dateString = $wasteReceive['date'];
     $dateOk = substr($dateString, 0,10) .'T' . substr($dateString, 11,8);
   
  ?>

    <form class="note-form" action="/?module=waste&action=edit" method="post">

    <input name="id" type="hidden" value="<?php echo $wasteReceive['id']; ?>" />
      <ul>
        
<!-- ////////////////////// -->
        <li>
          <label>Data Przyjęcia <span class="required">*</span></label>
          <input type="datetime-local" name="datetime" class="field-long" value="<?php echo $dateOk?>" />

         

          
        </li>
        <li>
          <label>Kontrahent <span class="required">*</span></label>
            <select name="customer_id">
           
          <?php
            foreach($params['contacts'] ?? [] as $contact): ?>           
                <option name="" value="<?php echo $contact['id']; ?>"
                <?php if($contact['name'] === $wasteReceive['customer_id'] ){ //błędne, niespójne nazwy
                    echo "selected";
                } ?>
                ><?php echo $contact['name']; ?></option>  
          <?php endforeach ; ?>      
         
          </select>
        </li>
        <li>
          <label>Transportujący <span class="required">*</span></label>
            <select name="transporter_id">
           <?php
            foreach($params['contacts'] ?? [] as $contact): ?>           
                <option name="" value="<?php echo $contact['id']; ?>"
                    <?php if($contact['name'] === $wasteReceive['transporter_id'] ){
                        echo "selected";
                        } 
                    ?>
                ><?php echo $contact['name']; ?></option>  
          <?php endforeach ; ?>      
          </select>
        </li>

        <li>
          <label>Numer Rejestracyjny <span class="required">*</span></label>
          <input type="text" name="plateNumber" class="field-long" maxlength="15" 
          value="<?php echo $wasteReceive['plateNumber'];?>"" />
        </li>
        <li>
          <label>Waga samochodu Brutto <span class="required">*</span></label>
          <input type="number" min="0" step= "0.001" name="carWeightBrutto" class="field-long"
          value="<?php echo $wasteReceive['carWeightBrutto']; ?>"  />
        </li>
        
        <li>
          <label>Waga samochodu Netto <span class="required">*</span></label>
          <input type="number" min="0" step= "0.001" name="carWeightNetto"class="field-long" 
          value="<?php echo $wasteReceive['carWeightNetto']; ?>" />
        </li>
        <li>
          <label>Waga Odpadów</label>
          <input type="number" min="0" step= "0.001" name="wasteWeight"  readonly="" class="field-long readOnly" 
          value="<?php echo $wasteReceive['WasteWeight']; ?>" />
        </li>
        <li>
          <label>Kod Odpadów <span class="required">*</span></label>
          <input type="text" name="wasteType" class="field-long" maxlength="50"
          value="<?php echo $wasteReceive['wasteType']; ?>" />
        </li>
        <li>
          <label>Magazyn <span class="required">*</span></label>
          <input type="text" name="warehouse" class="field-long" maxlength="50"
          value="<?php echo $wasteReceive['warehouse']; ?>" />
        </li>
        <li>
          <label>Notatki</label>
          <textarea name="description" id="field5" class="field-long field-textarea" 
          maxlength="500"><?php echo $wasteReceive['description']; ?></textarea>
        </li>
        <li>
          <input type="submit" value="Wyślij" id="submit" />
        </li>

       <!-- //  /////////////////////// -->

      </ul>
    </form>

    <?php else: ?>
        <div> brak danych do wyswietlenia </div>
        <a href ="/"><button> Powrót do listy</button></a>
    <?php endif; ?>



  </div>
</div>
<script src="../../public/receiveCreate.js"></script>