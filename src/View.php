<?php

declare(strict_types=1);

namespace App;

class View
{
  public function render(string $page, array $params): void
  {
    $params = $this->escape($params);
    require_once("templates/layout.php");
  }

    private function escape(array $params): array
    {
        $clearParams =[];
        foreach($params as $key => $param){ // $nazwaParametru => $parametr

            switch(true){
              case is_array($param):
                $clearParams[$key] = $this->escape($param);
              break;
              case is_int($param):
                $clearParams[$key] = $param;
              break;
              case $param: // null zwróci false
                $clearParams[$key] = htmlentities($param);
              break;
              default:
                $clearParams[$key] = $param;
              break;
            }
        //   if (is_array($param)) {
        //     $clearParams[$key] = $this->escape($param);
        //   } else if (is_int($param)){
        //     $clearParams[$key] = $param;
        //   }else if ($param){ // null zwróci false
        //     $clearParams[$key] = htmlentities($param);
        //   }else
        //   $clearParams[$key] = $param;
        // }
       
        }
     
        return $clearParams;
     }

}