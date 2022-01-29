<?php
namespace Tod\Controllers;

class Contact
{
  public function __construct()
  {

  }
  public function index()
  {
    callView('Main.php','contact.php');
  }
}
