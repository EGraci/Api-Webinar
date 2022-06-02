<?php
include("config.php");
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    echo $db->cek_login($_GET['username'], $_GET['password']);
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // post
}else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents('php://input'), $_DELETE);
    // DELETE $_DELETE[]
}else if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents('php://input'), $_PUT);
    // PUT => $_PUT[] 
}
?>