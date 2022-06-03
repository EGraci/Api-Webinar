<?php
include("config.php");
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['id'])){
        echo $db->get_event($_GET['id']);
    }else{
        $row = $db->all_event();
        $data = array();
        while ($tmp = $row->fetch_assoc()) {
            $data[] = $tmp;
        }
       echo json_encode($data);
		// echo $db->all_event();
    }
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['id_event']) && $_POST['id_peserta']){
        if($db->cek_daftar($_POST['id_event'], $_POST['id_peserta'])){
            echo "True";
        }else{
            echo $db->daftar_event($_POST['id_event'], $_POST['id_peserta']);
            // echo "False";
        }
    }
}else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents('php://input'), $_DELETE);
    // DELETE $_DELETE[]
}else if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents('php://input'), $_PUT);
    // PUT => $_PUT[] 
}
?>