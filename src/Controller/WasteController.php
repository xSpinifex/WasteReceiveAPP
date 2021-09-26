<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Controller\AbstractController;
use App\Model\ContactModel;
use LengthException;

class WasteController extends AbstractController
{

  private const PAGE_SIZE = 10;

  public function wasteReceiveListAction(): void 
  {
    $page = 'wasteReceiveList';

    $pageNumber = (int) $this ->request->getParam('page', 1);
    $pageSize = (int) $this ->request->getParam('pagesize', self::PAGE_SIZE);
    $sortBy = $this ->request->getParam('sortby', 'name');
    $sortOrder = $this ->request->getParam('sortorder', 'desc');
    $phrase  = $this ->request->getParam('phrase', null);
      //dump($pageNumber);
           
       if (!in_array($pageSize,[1, 5, 10, 25])){
        $pageSize = self::PAGE_SIZE;
       }

       if ($phrase) {
        $receiveWasteCount = $this ->wasteReceiveModel->getSearchCount($phrase);
        $receivesWaste = $this -> wasteReceiveModel -> searchReceives($pageNumber, $pageSize, $sortBy, $sortOrder, $phrase);
       
       }else {
        $receiveWasteCount = $this ->wasteReceiveModel->getCount();
        $receivesWaste = $this -> wasteReceiveModel -> getReceives($pageNumber, $pageSize, $sortBy, $sortOrder);
       }

    //  dump($contactCount);
        $viewParams = [
            'page' => [
              'number' => $pageNumber,
              'size' => $pageSize,
              'pages' => (int) ceil($receiveWasteCount/$pageSize) // ceil zaokr. w góre
             
            ],
            'sort' => [
              'by' => $sortBy,
              'order' => $sortOrder
            ],
          'phrase' => $phrase,
           'receivesWaste' =>  $receivesWaste,
           'before' => $this->request->getParam('before'),
           'error' => $this->request->getParam('error')
        ];

    $this->view->render($page, $viewParams ?? []);
  }


  public function wasteReceiveCreateAction(): void 
  {
    $page = 'wasteReceiveCreate';
    if ($this->request->hasPost()) {     


        $wasteReceiveData = [
          'date' => $this->request->postParam('datetime'),
          'customer_id' => $this->request->postParam('customer_id'),
          'transporter_id' => $this->request->postParam('transporter_id'),
          'plateNumber' => $this->request->postParam('plateNumber'),
          'carWeightBrutto' => $this->request->postParam('carWeightBrutto'),
          'carWeightNetto' => $this->request->postParam('carWeightNetto'),
          'wasteWeight' => $this->request->postParam('wasteWeight'),
          'wasteType' => $this->request->postParam('wasteType'),
          'warehouse' => $this->request->postParam('warehouse'),
          'description' => $this->request->postParam('description')
        ];

        $this->wasteReceiveModel->createWasteReceive($wasteReceiveData);
        $this->redirect('/?module=waste&action=wasteReceiveList&', ['before' => 'created']);
             
      }
      // do viewParams muszę przekazać spis kontrahentów
      $contactNames = $this->contactModel->getAllContactsName();

      $viewParams = [           
       'contacts' =>  $contactNames,       
    ];

     // dump($viewParams);
     // dump(count($viewParams['contacts']));
     //uwaga do reafaktoryzacji -> powinienem tutaj rpzekazywać ID kontaktu i zapisywac ID w bazie
     // exit;
    $this->view->render($page, $viewParams ?? []);

  }


  public function showAction (): void 
  {
    $page = 'wasteReceiveShow';
     $wasteReceive = $this->getwasteReceive();
    $viewParams = [
        'wasteReceive' => $wasteReceive      
    ];    
    $this->view->render($page, $viewParams ?? []); // jeśli nie ma zmiennej viewParams = zwracamy pusta tbalice
  }

  
  public function deleteAction(): void 
  { 

    if($this->request->isPost()){
      $wasteReceiveID = (int) $this->request->postParam('id');
      $this->wasteReceiveModel->deleteWasteReceive($wasteReceiveID);

      $this->redirect('/?module=waste&action=wasteReceiveList&', ['before' => 'deleted']);
       // exit('delete');
    }

    $page = 'wasteReceiveDelete';
    $wasteReceive = $this->getwasteReceive();

    $viewParams = [
      'wasteReceive' => $wasteReceive       
   ];

    $this->view->render($page, $viewParams ?? []); 
 
  }

  public function editAction(): void 
  {

    if($this->request->isPost()){
      $wasteReceiveID = (int) $this->request->postParam('id');

      $wasteReceiveData = [
        'date' => $this->request->postParam('datetime'),
        'customer_id' => $this->request->postParam('customer_id'),
        'transporter_id' => $this->request->postParam('transporter_id'),
        'plateNumber' => $this->request->postParam('plateNumber'),
        'carWeightBrutto' => $this->request->postParam('carWeightBrutto'),
        'carWeightNetto' => $this->request->postParam('carWeightNetto'),
        'wasteWeight' => $this->request->postParam('wasteWeight'),
        'wasteType' => $this->request->postParam('wasteType'),
        'warehouse' => $this->request->postParam('warehouse'),
        'description' => $this->request->postParam('description')
      ];

      $this->wasteReceiveModel->editwasteReceive($wasteReceiveID,$wasteReceiveData);
      $this->redirect('/?module=waste&action=wasteReceiveList&', ['before' => 'edited']);
      exit('wyslano'); // sie nie wykona bo jest po rediect

    }else {
      $wasteReceiveID = $this->request->getParam('id');
  }

  $wasteReceive   = $this->getWasteReceive();
 // do viewParams muszę przekazać spis kontrahentów
 $contactNames = $this->contactModel->getAllContactsName();
    $page = 'wasteReceiveEdit';
    $viewParams = [
       'wasteReceive' => $wasteReceive, 
       'contacts' =>  $contactNames 
    ];

    $this->view->render($page, $viewParams ?? []); 
 
  }

  private function getwasteReceive(): array
    {
      $wasteReceiveID = (int) $this->request->getParam('id');  
      if (!$wasteReceiveID) {
        $this->redirect('/', ['error' => 'missingwasteReceiveId']);       
      }
          $wasteReceive = $this ->wasteReceiveModel->getwasteReceive((int)$wasteReceiveID);    
      return $wasteReceive;  
    }

}