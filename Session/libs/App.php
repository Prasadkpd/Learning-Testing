<?php 

class App{
    private $_url = null;
    private $_controller = null;

    function __construct()
    {
       $this->_getURL(); 
    }

    private function _getURL()
    {
      $url = isset($_GET['url'])? $_GET['url'] : null;
      $url = rtrim($url,'/');//Remove final /
      $url = filter_var($url,FILTER_SANITIZE_URL);//Remve special character
      $this->url = explode('/',$url);//Split the url by /
      print_r($this->_url);

    }

}
?>