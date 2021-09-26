<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function homeAction(): void 
    {  
      $page = 'home';
      
      $this->view->render($page, $viewParams ?? []); 

    }
}