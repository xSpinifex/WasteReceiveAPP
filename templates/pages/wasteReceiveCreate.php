<div>
  <h3>Przyjęcie Odpadów!</h3>
  <div>
    <form class="note-form" onsubmit="return createReceiveChecker()" action="/?module=waste&action=wasteReceiveCreate" method="POST">
      <ul>
        <li>
          <label>Data Przyjęcia <span class="required">*</span></label>
          <input type="datetime-local" name="datetime" class="field-long" value="<?php echo date("Y-m-d H:i:s"); ?>" />

        </li>
        <li>
          <label>Kontrahent <span class="required">*</span></label>
          <select name="customer_id">
            <option hidden disabled selected value> -- select an option -- </option>
            <?php
            foreach ($params['contacts'] ?? [] as $contact) : ?>
              <option name="" value="<?php echo $contact['id']; ?>"><?php echo $contact['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </li>
        <li>
          <label>Transportujący <span class="required">*</span></label>
          <select name="transporter_id">
            <option hidden disabled selected value> -- select an option -- </option>
            <?php
            foreach ($params['contacts'] ?? [] as $contact) : ?>
              <option name="" value="<?php echo $contact['id']; ?>"><?php echo $contact['name']; ?></option>
            <?php endforeach; ?>
          </select>
        </li>

        <li>
          <label>Numer Rejestracyjny <span class="required">*</span></label>
          <input type="text" name="plateNumber" class="field-long" maxlength="15" />
        </li>
        <li>
          <label>Waga samochodu Brutto <span class="required">*</span></label>
          <input type="number" value="0" min="0" step="0.001" name="carWeightBrutto" class="field-long" />
        </li>
        <li>
        <li>
          <label>Waga samochodu Netto <span class="required">*</span></label>
          <input type="number" value="0" min="0" step="0.001" name="carWeightNetto" class="field-long" />
        </li>
        <li>
          <label>Waga Odpadów</label>
          <input type="number" value="0" min="0" step="0.001" name="wasteWeight" readonly="" class="field-long readOnly" />
        </li>
        <li>
          <label>Kod Odpadów <span class="required">*</span></label>
          <input type="text" name="wasteType" class="field-long" maxlength="50" />
        </li>
        <li>
          <label>Magazyn <span class="required">*</span></label>
          <input type="text" name="warehouse" class="field-long" maxlength="50" />
        </li>
        <li>
          <label>Notatki</label>
          <textarea name="description" id="field5" class="field-long field-textarea" maxlength="500"></textarea>
        </li>
        <li>
          <input type="submit" value="Wyślij" id="submit" />
        </li>
      </ul>
    </form>
  </div>
</div>

<!-- <script src="../../public/receiveCreate.js"></script> -->

<script src="../../public/jquery-3.6.0.min.js"></script>
<script src="../../public/receiveCreatejQuery.js"></script>