<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\NotFoundException;
use App\Exception\StorageException;
use App\Model\AbstractModel;
use PDO;
use Throwable;

class WasteReceiveModel extends AbstractModel
{
  
public function createWasteReceive(array $data): void
{

  try {

    $date = $this->conn->quote($data['date']);

    $customer_id = $this->conn->quote($data['customer_id']);
    $transporter_id = $this->conn->quote($data['transporter_id']);
    $plateNumber = $this->conn->quote($data['plateNumber']);
    $carWeightBrutto = $this->conn->quote($data['carWeightBrutto']);
    $carWeightNetto = $this->conn->quote($data['carWeightNetto']);
    $wasteWeight = $this->conn->quote($data['wasteWeight']);
    $wasteType = $this->conn->quote($data['wasteType']);
    $warehouse = $this->conn->quote($data['warehouse']);
    $description = $this->conn->quote($data['description']);
    $created = $this->conn->quote(date('Y-m-d H:i:s'));
  

    $query = "
      INSERT INTO wastereceive(date, customer_id, transporter_id, plateNumber, carWeightBrutto, carWeightNetto, WasteWeight, wasteType,
      warehouse, description, created)
      VALUES($date, $customer_id, $transporter_id, $plateNumber, $carWeightBrutto, $carWeightNetto, $wasteWeight, $wasteType,
      $warehouse, $description, $created)
    ";
      $this->conn->exec($query);

  } catch (Throwable $e) {
    throw new StorageException('Nie udało się utworzyć nowego przyjęcia', 400, $e);
  }
 
}


public function getSearchCount(string $phrase):int 
{
  try {
    $phrase = $this ->conn ->quote('%'.$phrase.'%', PDO::PARAM_STR); //escape

    $query = "SELECT count(*) as cn from wastereceive WHERE customer_id LIKE ($phrase) ";
    $result  = $this->conn->query($query); 
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
   if ($result === false) {
    throw new StorageException('Błąd przy próbie pobrania ilości wyszukiwanych przyjęć', 400);
  }
     return (int) $result [0]['cn'];
   // return 0;
  }
     catch(Throwable $e){
    throw new StorageException('Nie udało się pobrać danych o liczbie przyjęć', 400, $e);
  }

return 0;
}


public function searchReceives(int $pageNumber, int $PageSize, string $sortBy, string $sortOrder, string $phrase):array
{ 
  return $this->findBy($pageNumber, $PageSize, $sortBy, $sortOrder, $phrase);

}


public function getCount(): int 
{
    try {
      $query = "SELECT count(*) as cn from wastereceive";
      $result  = $this->conn->query($query); 
      $result = $result->fetchAll(PDO::FETCH_ASSOC);
          
     if ($result === false) {
      throw new StorageException('Błąd przy próbie pobrania ilości przyjęć', 400);
    }
       return (int) $result [0]['cn'];
     // return 0;
    }
       catch(Throwable $e){
      throw new StorageException('Nie udało się pobrać danych o liczbei przyjęć', 400, $e);

    }
  }
    
public function getReceives(int $pageNumber, int $PageSize, string $sortBy, string $sortOrder): array
{

  return $this->findBy($pageNumber, $PageSize, $sortBy, $sortOrder, null);
}

  private function findBy(int $pageNumber, int $PageSize, string $sortBy, string $sortOrder, ?string $phrase):array
  {

    try {
      $limit = $PageSize;
      $offset = ($pageNumber-1)*$PageSize;


    if (!in_array($sortBy,['date', 'wasteWeight'])){
      $sortBy = 'date';
    }
    if (!in_array($sortOrder,['asc', 'desc'])){
      $sortOrder = 'desc';
    }

    $wherePart='WHERE wastereceive.customer_id = c1.id and wastereceive.transporter_id = c2.id ';
    if(!is_null($phrase)) {  //null zwraca false wiec mozna ($phrase)
    $phrase = $this ->conn ->quote('%'.$phrase.'%', PDO::PARAM_STR); //escape      
    $wherePart = $wherePart . "and (c1.name LIKE ($phrase) or c2.name LIKE ($phrase) or wastereceive.wasteType LIKE ($phrase))";
    }
  
   // dump ($wherePart);
  //  exit;

// ZAPYTANIE DO PRZEROBIENIA W CELU POKAZYWANIA NAZW A NIE ID!
    $query = "SELECT wastereceive.id, wastereceive.date, c1.name as customer_id, c2.name as transporter_id, wastereceive.wasteType, wastereceive.WasteWeight 
    FROM wastereceive, contacts c1, contacts c2
    $wherePart
    ORDER BY $sortBy $sortOrder
    LIMIT $offset, $limit"; 

    $result  = $this->conn->query($query); 
      $receivesWaste = $result->fetchAll(PDO::FETCH_ASSOC);

  return $receivesWaste;

  }catch(Throwable $e){
    throw new StorageException('Nie udało się pobrać przyjęć', 400, $e);    
    }

 }

 
public function getwasteReceive(int $id):array
{
  try{
    //$query = "SELECT * FROM contacts where id = $id";

    $query = "SELECT wastereceive.id, wastereceive.date, c1.name as customer_id, c2.name as transporter_id, 
                      wastereceive.plateNumber, wastereceive.carWeightBrutto, wastereceive.carWeightNetto, wastereceive.warehouse, 
                      wastereceive.wasteType, wastereceive.WasteWeight, wastereceive.created, wastereceive.description 
    FROM wastereceive, contacts c1, contacts c2 
    WHERE wastereceive.id = $id 
          and wastereceive.customer_id = c1.id 
          and wastereceive.transporter_id = c2.id";

    $result  = $this->conn->query($query); 
    $wasteReceive = $result->fetch(PDO::FETCH_ASSOC);
        
  }catch(Throwable $e){
    throw new StorageException('Nie udało się pobrać przyjecia', 400, $e);

  }
  if (!$wasteReceive){
    throw new NotFoundException("nie ma takiego przyjecia o id $id");
    
  }

  return $wasteReceive;
}


public function deleteWasteReceive(int $WasteReceiveID):void
{
  try {

    $query = "
      DELETE FROM wastereceive       
      WHERE
      id = $WasteReceiveID
      LIMIT 1
    ";
          
    $this->conn->exec($query);
    
  } catch (Throwable $e) {
    throw new StorageException('Nie udało się USUNĄĆ notatki', 400, $e);
  }


  }

  
  public function editWasteReceive(int $wasteReceiveID, array $data): void
  {
    try {
      dump('jest w edit');
    
      //$id = $this->conn->quote($data['id']);
      $date = $this->conn->quote($data['date']);
      $customer_id = $this->conn->quote($data['customer_id']);
      $transporter_id = $this->conn->quote($data['transporter_id']);
      $plateNumber = $this->conn->quote($data['plateNumber']);
      $carWeightBrutto = $this->conn->quote($data['carWeightBrutto']);
      $carWeightNetto = $this->conn->quote($data['carWeightNetto']);
      $wasteWeight = $this->conn->quote($data['wasteWeight']);
      $wasteType = $this->conn->quote($data['wasteType']);
      $warehouse = $this->conn->quote($data['warehouse']);
     
      $description = $this->conn->quote($data['description']);

  
      $query = "
        UPDATE wastereceive
        SET date=  $date,
        customer_id=  $customer_id,
        transporter_id=  $transporter_id,
        plateNumber=  $plateNumber,
        carWeightBrutto=  $carWeightBrutto,
        carWeightNetto=  $carWeightNetto,
        wasteWeight=  $wasteWeight,
        wasteType=  $wasteType,
        warehouse=  $warehouse       
        WHERE
        id = $wasteReceiveID
      ";
      dump($query);

      $this->conn->exec($query);
      
    } catch (Throwable $e) {
      throw new StorageException('Nie udało się edytowac przyjęcia', 400, $e);
    }
   
  }

  
}