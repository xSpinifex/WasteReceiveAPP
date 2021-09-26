<div>
  <h3> EDYCJA Kontaktu</h3>
  <div>
<?php if (!empty($params ['contact'])): ?>

  <?php //dump($params);
     $contact = $params ['contact'] ?? null; 
  ?>

    <form class="note-form" action="/?module=contacts&action=edit" method="post">

    <input name="id" type="hidden" value="<?php echo $contact['id']; ?>" />
      <ul>
        
        <li>
          <label>Nazwa <span class="required">*</span></label>
          <input type="text" name="name" class="field-long"  required maxlength="250"
          value="<?php
          echo $contact['name']
          ?>"          />
        </li>
        <li>
          <label>NIP <span class="required">*</span></label>
          <input type="text" name="nip" class="field-long" required maxlength="10"
          value="<?php
          echo $contact['nip']
          ?>"/>
        </li>
        <li>
          <label>Adres <span class="required">*</span></label>
          <input type="text" name="address" class="field-long"required maxlength="150"
          value="<?php
          echo $contact['address']
          ?>"  />
        </li>
        <li>
          <label>Kod Pocztowy <span class="required">*</span></label>
          <input type="text" name="zip_code" class="field-long" required maxlength="6"
          value="<?php
          echo $contact['zip_code']
          ?>"/>
        </li>
        <li>
          <label>Miasto <span class="required">*</span></label>
          <input type="text" name="city" class="field-long" required maxlength="50"
          value="<?php
          echo $contact['city']
          ?>"/>
        </li>
        <li>
          <label>Numer BDO <span class="required">*</span></label>
          <input type="text" name="bdo_number" class="field-long" required maxlength="9"
          value="<?php
          echo $contact['bdo_number']
          ?>" />
        </li>
        <li>
          <label>Notatki</label>
          <textarea name="description" id="field5" class="field-long field-textarea"  maxlength="1000"
          value="<?php
          echo $contact['description']
          ?>"></textarea>
        </li>

        <li>
          <input type="submit" value="Submit" />
        </li>
      </ul>
    </form>

    <?php else: ?>
        <div> brak danych do wyswietlenia </div>
        <a href ="/"><button> Powrót do listy</button></a>
    <?php endif; ?>



  </div>
</div>