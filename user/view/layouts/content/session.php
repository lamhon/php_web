<?php
    include_once '../../lib/session.php';
    Session::checkUserSession();
?>

<?php
    if(isset($_GET['action']) && $_GET['action'] == 'logout'){
        Session::userDestroy();
    }
?>