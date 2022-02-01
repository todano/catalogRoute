<?php
namespace Tod\Controllers;

class Main
{
  public function __construct()
  {

  }
  public function index()
  {
    global $con;
   $sql = "SELECT *
           FROM `catalog`
           LIMIT 3";
   $query = $con->prepare($sql);
   $query->execute();
   $movies = $query->fetchALL(\PDO::FETCH_ASSOC);
   $items = ['movies' => $movies];
   callView('Main.php','movies.php', $items);
  }
  public function products()
  {
    global $con;
   $sql = "SELECT *
           FROM `catalog`
          ";
   $query = $con->prepare($sql);
   $query->execute();
   $movies = $query->fetchALL(\PDO::FETCH_ASSOC);
   $items = ['movies' => $movies];
   callView('Main.php','movies.php', $items);
  }
}
