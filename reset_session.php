<?php
session_start();
if(isset($_SESSION['USER']) && !empty($_SESSION['USER'])) {
   $_SESSION['USER']="";
   $_SESSION['CONTACT']="";
   echo 1;
}

