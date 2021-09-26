<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\NotFoundException;
use App\Controller\AbstractController;

class ContactController extends AbstractController
{

  private const PAGE_SIZE = 10;

    public function contactsListAction(): void 
    {
      $page = 'contactsList';

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
          $contactCount = $this ->contactModel->getSearchCount($phrase);
          $contacts = $this -> contactModel -> searchContacts($pageNumber, $pageSize, $sortBy, $sortOrder, $phrase);
         
         }else {
          $contactCount = $this ->contactModel->getCount();
          $contacts = $this -> contactModel -> getContacts($pageNumber, $pageSize, $sortBy, $sortOrder);
         }
  
      //  dump($contactCount);
          $viewParams = [
              'page' => [
                'number' => $pageNumber,
                'size' => $pageSize,
                'pages' => (int) ceil($contactCount/$pageSize) // ceil zaokr. w góre
               
              ],
              'sort' => [
                'by' => $sortBy,
                'order' => $sortOrder
              ],
            'phrase' => $phrase,
             'contacts' =>  $contacts,
             'before' => $this->request->getParam('before'),
             'error' => $this->request->getParam('error')
          ];

      $this->view->render($page, $viewParams ?? []);

    }


    public function createContactAction(): void 
    {
      $page = 'createContact';

      //$data = $this->getRequestPost();
  
      //$this->request->postParam('title')
     
      if ($this->request->hasPost()) {
        

        $contactData = [
          'name' => $this->request->postParam('name'),
          'nip' => $this->request->postParam('nip'),
          'address' => $this->request->postParam('address'),
          'zip_code' => $this->request->postParam('zip_code'),
          'city' => $this->request->postParam('city'),
          'bdo_number' => $this->request->postParam('bdo_number'),
          'description' => $this->request->postParam('description')
        ];
        $this->contactModel->createContact($contactData);
        $this->redirect('/?module=contacts&action=contactsList&', ['before' => 'created']);
             
      }
      $this->view->render($page, $viewParams ?? []);
    }


    public function showAction (): void 
    {
  
      $page = 'showContact';
      // $data = $this->getRequestGet();     
  
      $contact = $this->getContact();
  
      $viewParams = [
          'contact' => $contact      
      ];
        
      $this->view->render($page, $viewParams ?? []); // jeśli nie ma zmiennej viewParams = zwracamy pusta tbalice
    }

    private function getContact(): array
    {
      $contactID = (int) $this->request->getParam('id');  
      if (!$contactID) {
        $this->redirect('/', ['error' => 'missingContactId']);       
      }
          $contact = $this ->contactModel->getContact((int)$contactID);    
      return $contact;  
    }

    public function deleteAction(): void 
    { 
  
      if($this->request->isPost()){
        $contactID = (int) $this->request->postParam('id');
        $this->contactModel->deleteContact($contactID);
  
        $this->redirect('/?module=contacts&action=contactsList&', ['before' => 'deleted']);
         // exit('delete');
      }
  
      $page = 'deleteContact';
      $contact = $this->getContact();
  
      $viewParams = [
        'contact' => $contact       
     ];
  
      $this->view->render($page, $viewParams ?? []); 
   
    }

    public function editAction(): void 
  {

    if($this->request->isPost()){
      $contactID = (int) $this->request->postParam('id');

      $contactData = [
      
        'name' => $this->request->postParam('name'),
          'nip' => $this->request->postParam('nip'),
          'address' => $this->request->postParam('address'),
          'zip_code' => $this->request->postParam('zip_code'),
          'city' => $this->request->postParam('city'),
          'bdo_number' => $this->request->postParam('bdo_number'),
          'description' => $this->request->postParam('description')

      ];

      $this->contactModel->editContact($contactID,$contactData);
      $this->redirect('/?module=contacts&action=contactsList&', ['before' => 'edited']);
      exit('wyslano'); // sie nie wykona bo jest po rediect

    }else {
      $contactID = $this->request->getParam('id');
  }
  $contact   = $this->getContact();

    $page = 'editContact';
    $viewParams = [
       'contact' => $contact       
    ];

    $this->view->render($page, $viewParams ?? []); 
 
  }

}