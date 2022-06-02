<?php
include("config.php");
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['id'])){
        echo $db->get_event($_GET['id']);
    }else{
		$hasil = array();
        $i = 0;
        $query = $db->all_event();
		while($data = $query->fetch_assoc()){
			$hasil[$i] = $data;
			$i++;
        }
        echo json_encode($hasil);
    }
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['id_event']) && $_POST['id_peserta']){
        if($db->cek_daftar($_POST['id_event'], $_POST['id_peserta'])){
            echo "True";
        }else{
            $db->daftar_event($_POST['id_event'], $_POST['id_peserta']);
            echo "False";
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