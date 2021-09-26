<div>
  <h3> Dodawanie Kontaktu</h3>
  <div>
    <form class="note-form" action="/?module=contacts&action=createContact" method="post">
      <ul>
        <li>
          <label>Nazwa <span class="required">*</span></label>
          <input type="text" name="name" class="field-long" required maxlength="250" />
        </li>
        <li>
          <label>NIP <span class="required">*</span></label>
          <input type="text" name="nip" class="field-long" required maxlength="10" />
        </li>
        <li>
          <label>Adres <span class="required">*</span></label>
          <input type="text" name="address" class="field-long" required maxlength="150"/>
        </li>
        <li>
          <label>Kod Pocztowy <span class="required">*</span></label>
          <input type="text" name="zip_code" class="field-long" required maxlength="6" minlength="6"/>
        </li>
        <li>
          <label>Miasto <span class="required">*</span></label>
          <input type="text" name="city" class="field-long" required maxlength="50"/>
        </li>
        <li>
          <label>Numer BDO <span class="required">*</span></label>
          <input type="text" name="bdo_number" class="field-long"required maxlength="9"/>
        </li>
        <li>
          <label>Notatki</label>
          <textarea name="description" id="field5" class="field-long field-textarea" maxlength="1000"></textarea>
        </li>
        <li>
          <input type="submit" value="Submit" />
        </li>
      </ul>
    </form>
  </div>
</div>