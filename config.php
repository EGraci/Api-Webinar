<?php
class database{
	function db() {
		static $conn;
		if ($conn===NULL){ 
			$conn = mysqli_connect ("localhost", "root", "", "db_project_pendaftaran");
		}
		return $conn;
	}
	function cek_login($user, $pass){
		$pass = md5($pass);
		$conn = $this->db();
		$data = $conn->query("select id_peserta, nama_lengkap from master_peserta where email = '$user' and password = '$pass'");
		$data = $data->fetch_assoc();
		return json_encode($data);
	}
	function all_event(){
		$date = date("Y-m-d");
		$time = date("h:i:s");
		$conn = $this->db();
		$data = $conn->query("select * from vw_event");
		return $data;
	}
	function get_event($id){
		$conn = $this->db();
		$data = $conn->query("select id_event, judul, deskripsi, pembicara, jam_mulai, jam_selesai,  CONCAT(
			'http://webinar.ukdc.ac.id/avatar/flyer/',
			`db_project_pendaftaran`.`master_event`.`avatar_event`
		) AS `gambar`from master_event WHERE id_event = '$id'");
		$data = $data->fetch_assoc();
		return json_encode($data);
	}
	function cek_daftar($id_event, $id_peserta){
		$conn = $this->db();
		$data = $conn->query("SELECT * FROM peserta_event WHERE id_peserta = '$id_peserta' AND id_event = '$id_event'");
		if($data->num_rows == 0){
			return false;
		}else{
			return true;
		}
	}
	function daftar_event($id_event, $id_peserta){
		$conn = $this->db();
		$data = $conn->query("INSERT INTO peserta_event(absen, id_event, id_peserta, id_peserta_event) VALUES ('0','$id_event','$id_peserta','$id_event.$id_event'");
	}
} 

$db  = new database();