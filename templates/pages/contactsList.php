<h3> Kontakty </h3>
<div class="list">
  <section>
  <div class="message">
    <?php
    if (!empty($params['error'])) {
      switch ($params['error']) {
        case 'contactNotFound':
          echo 'Brak takiego kontaktu';
          break;

        case 'missingContactId':
            echo 'Niepoprawny identyfikator kontaktu';
          break;          
      }
    }
    ?>
  </div>
  <div class="message">
    <?php
    if (!empty($params['before'])) {
      switch ($params['before']) {
        case 'created':
          echo 'Kontakt został utworzony !!!';
          break;
        case 'edited':
          echo 'Kontakt został edytowany !!!';
          break;
        case 'deleted':
          echo 'Kontakt został usuniety !!!';
          break;
      }
    }
    ?>
  </div>
    <?php
      $sort = $params ['sort'] ?? [];
      $by = $sort['by'] ?? 'name';
      $order = $sort['order'] ?? 'asc';

      $page = $params ['page'] ?? [];
      $size = $page ['size'] ?? 10;
      $number = $page ['number'] ?? 1;
      $pages = $page['pages'] ?? 1;

      $phrase = $params['phrase'] ?? null;
      
    ?>

  <div>
      <form class ="settings-form" method="GET" action="/?module=contacts&action=contactsList&" module="contacts">
    <div>
      <label>Wyszukaj:<input type="text" name="phrase" value="<?php echo $phrase?>"/></label>
    </div>
<!-- nie wiem jak inaczej przekazać te parametry???-->
<input type="hidden" name="action" value="contactsList"/>
<input type="hidden" name="module" value="contacts"/>
<!--  -->
    <div>  
    <div>Sortuj po: </div>
        <label> Nazwie <input name ="sortby" type="radio" value="name" 
            <?php echo $by ==='name' ? 'checked' : '' ?>
        /> </label>
        <label> Dacie dodania: <input name ="sortby" type="radio" value="created" 
          <?php echo $by ==='created' ? 'checked' : '' ?>
        /> </label>
  </div>
  <div>
      <div>Kierunek sortowania</div>
        <label> Rosnąco: <input name ="sortorder" type="radio" value="asc" 
          <?php echo $order ==='asc' ? 'checked' : '' ?>
        /> </label>
        <label> Malejąco: <input name ="sortorder" type="radio" value="desc" 
        <?php echo $order ==='desc' ? 'checked' : '' ?>
        /> </label>
        </div>
        <div>
        <div> Rozmiar paczki </div>
        <label> 1 <input name ="pagesize" type="radio" value="1" <?php echo $size === 1 ? 'checked' : '' ?> /> </label>
        <label> 5 <input name ="pagesize" type="radio" value="5" <?php echo $size === 5 ? 'checked' : '' ?> /> </label>
        <label> 10 <input name ="pagesize" type="radio" value="10" <?php echo $size === 10 ? 'checked' : '' ?> /> </label>
        <label> 25 <input name ="pagesize" type="radio" value="25" <?php echo $size === 25 ? 'checked' : '' ?> /> </label>
        </div>

        <input type="submit" value="Sortuj" />
        
    </form>
    
  </div>
  

    <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>NIP</th>
            <th>miasto</th>
            <th>stworzono</th>
            <th>Opcje</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <?php
            foreach($params['contacts'] ?? [] as $contact): ?>
              <tr>
                <td>
                  <?php echo  $contact['id']; ?>
                </td>
                <td>
                  <?php echo $contact['name']; ?>
                </td>
                <td>
                  <?php echo $contact['nip']; ?>
                </td>
                <td>
                  <?php echo $contact['city']; ?>
                </td>
                <td>
                  <?php echo $contact['created']; ?>
                </td>
                <td>
                  <a href="/?module=contacts&action=show&id=<?php echo(int) $contact['id']; ?>"><button> Pokaż</button></a>
                  <a href="/?module=contacts&action=delete&id=<?php echo(int) $contact['id']; ?>"><button> Usuń</button></a>
                </td>
              </tr>
          <?php endforeach ; ?>
        </tbody>
      </table>
    </div>
    


    <?php
      $paginationUrl = "/?module=contacts&action=contactsList&sortby=$by&sortorder=$order&pagesize=$size&phrase=$phrase"
    ?>
    <ul class="pagination">
      
        <?php if(!($number-1 <= 0)): ?>
          <li>        
              <a href="<?php echo $paginationUrl ?>&page=<?php echo $number-1 ?>">                    
                  <button> << </button>
              </a>                  
          </li>
        <?php endif; ?>
          
            <?php for ($i=1; $i <= $pages; $i++): ?>
                <li>
                  <a href="<?php echo $paginationUrl ?>&page=<?php echo $i ?>">                    
                    <button> <?php echo $i ?> </button>
                  </a>                  
                </li>
            <?php endfor; ?>

        <?php if(!($number+1 > $pages)): ?>
          <li>        
              <a href="<?php echo $paginationUrl ?>&page=<?php echo $number+1?>">                    
                  <button> >> </button>
              </a>                  
          </li>
        <?php endif; ?>

    </ul>


  </section>
</div>