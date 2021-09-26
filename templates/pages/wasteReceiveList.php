<h3> Przyjęcia Odpadów </h3>
<div class="list">
  <section>
  <div class="message">
    <?php
    if (!empty($params['error'])) {
      switch ($params['error']) {
        case 'receiveNotFound':
          echo 'Brak takiego przyjęcia';
          break;

        case 'missingreceiveId':
            echo 'Niepoprawny identyfikator przyjęcia';
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
          echo 'Przyjęcie zostało utworzone !!!';
          break;
        case 'edited':
          echo 'Przyjęcie zostało edytowane !!!';
          break;
        case 'deleted':
          echo 'Przyjęcie zostało usuniete !!!';
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
      <form class ="settings-form" method="GET" action="/?module=waste&action=wasteReceiveList&" module="contacts">
    <div>
      <label>Wyszukaj:<input type="text" name="phrase" value="<?php echo $phrase?>"/></label>
    </div>
<!-- nie wiem jak inaczej przekazać te parametry???-->
<input type="hidden" name="action" value="wasteReceiveList"/>
<input type="hidden" name="module" value="waste"/>
<!--  -->
    <div>  
    <div>Sortuj po: </div>
        <label> Masie <input name ="sortby" type="radio" value="wasteWeight" 
            <?php echo $by ==='wasteWeight' ? 'checked' : '' ?>
        /> </label>
        <label> Dacie przyjęcia: <input name ="sortby" type="radio" value="date" 
          <?php echo $by ==='date' ? 'checked' : '' ?>
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
            <th>Data</th>
            <th>Kontrahent</th>
            <th>Transportujący</th>
            <th>Kod Opadu</th>
            <th>Waga</th>
            <th>Opcje</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
          <?php
            foreach($params['receivesWaste'] ?? [] as $receiveWaste): ?>
              <tr>
                <td>
                  <?php echo  $receiveWaste['id']; ?>
                </td>
                <td>
                  <?php echo $receiveWaste['date']; ?>
                </td>
                <td>
                  <?php echo $receiveWaste['customer_id']; ?>
                </td>
                <td>
                  <?php echo $receiveWaste['transporter_id']; ?>
                </td>
                <td>
                  <?php echo $receiveWaste['wasteType']; ?>
                </td>
                <td>
                  <?php echo $receiveWaste['WasteWeight']; ?>
                </td>
                <td>
                  <a href="/?module=waste&action=show&id=<?php echo(int) $receiveWaste['id']; ?>"><button> Pokaż</button></a>
                  <a href="/?module=waste&action=delete&id=<?php echo(int) $receiveWaste['id']; ?>"><button> Usuń</button></a>
                </td>
              </tr>
          <?php endforeach ; ?>
        </tbody>
      </table>
    </div>
    


    <?php
      $paginationUrl = "/?module=waste&action=wasteReceiveList&sortby=$by&sortorder=$order&pagesize=$size&phrase=$phrase"
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