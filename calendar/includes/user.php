<?php 
require_once('database.php');

class User {

	private $id;
	private $username;
	private $password;
	private $first_name;
	private $last_name;
	private $type;

	function __construct($username, $password, $first_name, $last_name, $type) {
		$this->set_username($username);
		$this->set_password($password);
		$this->set_first_name($first_name);
		$this->set_last_name($last_name);
		$this->set_type($type);
	}

	public function get_id() {
		return $this->id;
	}

	public function set_id($id) {
		$this->id = $id;
	}

	public function get_username() {
		return $this->username;
	}

	public function set_username($username) {
		$this->username = $username;
	}

	public function get_password() {
		return $this->password;
	}

	public function set_password($password) {
		$this->password = $password;
	}

	public function get_first_name() {
		return $this->first_name;
	}

	public function set_first_name($first_name) {
		$this->first_name = $first_name;
	}

	public function get_last_name() {
		return $this->last_name;
	}

	public function set_last_name($last_name) {
		$this->last_name = $last_name;
	}

	public function get_type() {
		return $this->type;
	}

	public function set_type($type) {
		$this->type = $type;
	}

	public function get_full_name() {
		return $this->first_name . ' ' . $this->last_name;
	}

	public static function get_all() {
		global $connection;
		$sql = "SELECT * FROM users";
		$query = $connection->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public static function get_by_username($username) {
		global $connection;
		$sql = "SELECT * FROM users WHERE username=:username";
		$query = $connection->prepare($sql);
		$query->bindParam(":username", $username);
		$query->execute();
		$result = $query->fetch();
		return $result;
	}

	public static function get_by_id($id) {
		global $connection;
		$sql = "SELECT * FROM users WHERE id=:id";
		$query = $connection->prepare($sql);
		$query->bindParam(":id", $id);
		$query->execute();
		$result = $query->fetch();
		return $result;
	}
}

?>