<?php

declare(strict_types=1);

namespace App\Controller;


use App\Request;
use App\Exception\ConfigurationException;
use App\Model\ContactModel;
use App\Model\WasteReceiveModel;
use App\Exception\NotFoundException;
use App\Exception\StorageException;
use App\View;

abstract class AbstractController
{

    protected const DEFAULT_ACTION = 'home';

    private static array $configuration = [];
  
    protected ContactModel $contactModel;
    protected WasteReceiveModel $wasteReceiveModel;
    protected Request $request;
    protected View $view;
  
    public static function initConfiguration(array $configuration): void
    {
      self::$configuration = $configuration;
    }
  
    public function __construct(Request $request)
    {
      if (empty(self::$configuration['db'])) {
        throw new ConfigurationException('Configuration error');
      }
      $this->contactModel = new ContactModel(self::$configuration['db']);
      $this->wasteReceiveModel = new WasteReceiveModel(self::$configuration['db']);
  
      $this->request = $request;
      $this->view = new View();
    }

    public function chooseModul():void{


    }


  public function run(): void
  {
   
    try{
      $action = $this->action() . 'Action';
      
      if (method_exists($this, $action))
      {
      $this->$action(); // odpala metode pod nazwą action
      } else {
       
        $action = self::DEFAULT_ACTION . 'Action';
      }

    }catch(StorageException $e){
      $this -> view-> render(
        'error',
        ['message' => $e -> getMessage()]
      );

    }catch(NotFoundException $e){
      $this->redirect('/', ['error' => 'contactNotFound']);     
    }
    
   // $this->$action();

    // switch ($this->action()) {
    //   case 'create':
    //    $this -> create();
    //     break;
    //   case 'show':
    //     $this -> show();
    //     break;
    //   default:
    //   $this -> list();
        
    //     break;
    // }

    
  }

  protected function redirect(string $to, array $params):void
  {
    $location = $to;
    if (count($params)) {
      $queryParams = [];
      foreach($params as $key => $value){
        $queryParams[] = urlencode($key) . '=' . urlencode($value);
      }
      $queryParams = implode('&',$queryParams);
      $location .= $queryParams;
    }
      
    header("Location: $location");
    exit;
  }


  private function action(): string
  {
   //  $action = $this -> request->getParam('action');
    //var_dump($action);
   // $data = $this->getRequestGet();
    return $this -> request->getParam('action', self::DEFAULT_ACTION);
  }

  // private function getRequestGet(): array
  // {
  //   return $this->request['get'] ?? [];
  // }

  // private function getRequestPost(): array
  // {
  //   return $this->request['post'] ?? [];
  // }

}