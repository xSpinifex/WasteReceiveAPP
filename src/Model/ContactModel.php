<?php

declare(strict_types=1);

namespace App\Model;

use App\Exception\NotFoundException;
use App\Exception\StorageException;
use App\Model\AbstractModel;
use PDO;
use Throwable;

class ContactModel extends AbstractModel
{
  

  public function createContact(array $data): void
  {
    try {
      $name = $this->conn->quote($data['name']);
      $nip = $this->conn->quote($data['nip']);
      $address = $this->conn->quote($data['address']);
      $zip_code = $this->conn->quote($data['zip_code']);
      $city = $this->conn->quote($data['city']);
      $BDO_number = $this->conn->quote($data['bdo_number']);
      $description = $this->conn->quote($data['description']);
      $created = $this->conn->quote(date('Y-m-d H:i:s'));

      $query = "
        INSERT INTO contacts(name, nip, address, zip_code, city, bdo_number, created, description)
        VALUES($name, $nip, $address, $zip_code, $city, $BDO_number, $created, $description)
      ";
     // dump($query);
      
      $this->conn->exec($query);
      
    } catch (Throwable $e) {
      throw new StorageException('Nie udało się utworzyć nowego kontaktu', 400, $e);
    }
   
  }


  public function editContact(int $contactID, array $data): void
  {
    try {
      dump('jest w edit');
    
      //$id = $this->conn->quote($data['id']);
      $name = $this->conn->quote($data['name']);
      $nip = $this->conn->quote($data['nip']);
      $address = $this->conn->quote($data['address']);
      $zip_code = $this->conn->quote($data['zip_code']);
      $city = $this->conn->quote($data['city']);
      $bdo_number = $this->conn->quote($data['bdo_number']);
      
      $description = $this->conn->quote($data['description']);
      //$created = $this->conn->quote(date('Y-m-d H:i:s'));

  
      $query = "
        UPDATE contacts
        SET name=  $name,
        nip = $nip,
        address = $address,
        zip_code = $zip_code,
        city = $city,
        bdo_number = $bdo_number,
        description = $description
        WHERE
        id = $contactID
      ";
      dump($query);

      $this->conn->exec($query);
      
    } catch (Throwable $e) {
      throw new StorageException('Nie udało się edytowac notatki', 400, $e);
    }
   
  }

  public function deleteContact(int $contactID):void
  {
    try {
 
      $query = "
        DELETE FROM contacts       
        WHERE
        id = $contactID
        LIMIT 1
      ";
            
      $this->conn->exec($query);
      
    } catch (Throwable $e) {
      throw new StorageException('Nie udało się USUNĄĆ notatki', 400, $e);
    }


  }



public function getContact(int $id):array
{
  try{
    $query = "SELECT * FROM contacts where id = $id";
    $result  = $this->conn->query($query); 
    $contact = $result->fetch(PDO::FETCH_ASSOC);
        
  }catch(Throwable $e){
    throw new StorageException('Nie udało się pobrać kontaktu', 400, $e);

  }
  if (!$contact){
    throw new NotFoundException("nie ma takiego kontaktu o id $id");
    
  }

  return $contact;
}

public function searchContacts(int $pageNumber, int $PageSize, string $sortBy, string $sortOrder, string $phrase):array
{ 
  return $this->findBy($pageNumber, $PageSize, $sortBy, $sortOrder, $phrase);

}

public function getSearchCount(string $phrase):int 
{
  try {
    $phrase = $this ->conn ->quote('%'.$phrase.'%', PDO::PARAM_STR); //escape

    $query = "SELECT count(*) as cn from contacts WHERE name LIKE ($phrase)";
    $result  = $this->conn->query($query); 
    $result = $result->fetchAll(PDO::FETCH_ASSOC);
        
   if ($result === false) {
    throw new StorageException('Błąd przy próbie pobrania ilości wyszukiwanych kontaktów', 400);
  }
     return (int) $result [0]['cn'];
   // return 0;
  }
     catch(Throwable $e){
    throw new StorageException('Nie udało się pobrać danych o liczbei kontaktów', 400, $e);
  }

return 0;
}


public function getContacts(int $pageNumber, int $PageSize, string $sortBy, string $sortOrder): array
{

  return $this->findBy($pageNumber, $PageSize, $sortBy, $sortOrder, null);
}

public function getCount(): int 
{
    try {
      $query = "SELECT count(*) as cn from contacts";
      $result  = $this->conn->query($query); 
      $result = $result->fetchAll(PDO::FETCH_ASSOC);
          
     if ($result === false) {
      throw new StorageException('Błąd przy próbie pobrania ilości kontaktów', 400);
    }
       return (int) $result [0]['cn'];
     // return 0;
    }
       catch(Throwable $e){
      throw new StorageException('Nie udało się pobrać danych o liczbei kontaktów', 400, $e);

    }

}

  private function findBy(int $pageNumber, int $PageSize, string $sortBy, string $sortOrder, ?string $phrase):array
    {
      try {
        $limit = $PageSize;
        $offset = ($pageNumber-1)*$PageSize;
    
    
      if (!in_array($sortBy,['created', 'name'])){
        $sortBy = 'name';
      }
      if (!in_array($sortOrder,['asc', 'desc'])){
        $sortOrder = 'desc';
      }
    
      $wherePart='';
      if(!is_null($phrase)) {  //null zwraca false wiec mozna ($phrase)
      $phrase = $this ->conn ->quote('%'.$phrase.'%', PDO::PARAM_STR); //escape      
      $wherePart = "WHERE name LIKE ($phrase)";
      }
     


      $query = "SELECT id, name, nip, city, created FROM contacts
      $wherePart
      ORDER BY $sortBy $sortOrder
      LIMIT $offset, $limit"; //LIMIT - pobierz OD_ktoregoElementu, ileElemtow
    
      //pobieranie danych, obiekt PDO
      //conn to obiet PDO
      $result  = $this->conn->query($query); 
      // PDO::FETCH_ASSOC -> ustalamy pod jaką postać ma zwrócić dane (tylko kolumny asocjacyjne)
      // PDO::FETCH_ASSOC -> bez dublowania dla ID int 
    
        $contacts = $result->fetchAll(PDO::FETCH_ASSOC);
          // to samo co:
          // foreach($result as $row){}
          //  $contacts[] = $row;
          // }

    return $contacts;
    
    }catch(Throwable $e){
      throw new StorageException('Nie udało się pobrać kontaków', 400, $e);    
      }
    }

    public function getAllContactsName():array
    {
      try {
      $query = "SELECT id, name FROM contacts";
      $result  = $this->conn->query($query); 
      $contacts = $result->fetchAll(PDO::FETCH_ASSOC);
      return $contacts;

    }catch(Throwable $e){
      throw new StorageException('Nie udało się pobrać nazw kontaków', 400, $e);    
      }
    }
 
}
