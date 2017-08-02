<?php
    
require_once __DIR__.'/../main/init.php';

use App\View\ReclaimView;
use App\Mail;

if(!isset($_POST["username"])) {
    $view = new ReclaimView();
    $view->display([]);
    die();
}
    
$username = $_POST["username"];

Mail::mailto($username, '', '', '');

?>