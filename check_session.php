<?php
session_start();
if(isset($_SESSION['USER']) && !empty($_SESSION['USER'])) {
   echo 1;
}

