<?php
require_once 'DBconnect.php';

class getContent {

	private static function getData($sql_stmt) {
		// $db = Database::getDb();
		$instance = DBconnect::getInstance();
		$conn = $instance->getConnection();
		$sql = $sql_stmt;
		$pdostm = $conn->prepare($sql);
		$pdostm->execute();

		//fetch all result
		$Result = $pdostm->fetchAll(PDO::FETCH_OBJ);
		return $Result;
	}

	//get pdo connection
	public static function getAllContent($tablename) {

		$sql = "SELECT * FROM " . $tablename;
		return self::getData($sql);
	}

	private static function getSubContent($tablename, $menu) {

		$sql = "SELECT * FROM " . $tablename . " where menu = '" . $menu . "'";
		return self::getData($sql);
	}

	public static function displayHeaderMenu() {
		$MenuList = self::getAllContent('MenuList');
		if (count($MenuList) > 0) {
			foreach ($MenuList as $MenuItem) {
				$submenu = self::getSubContent('submenulist', $MenuItem->Menu);
				if (count($submenu) > 0) {
					echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle text-white mx-2" href="#!" id="' . $MenuItem->Menu . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' . $MenuItem->Menu . '</a>';
					echo '<div class="dropdown-menu bg-dark" aria-labelledby="' . $MenuItem->Menu . '">';
					foreach ($submenu as $submenuitem) {
						echo '<a class="dropdown-item text-saffron" href="' . $submenuitem->href . '">' . $submenuitem->submenu . '</a>';
					}
					echo '</div> </li>';
				} else {
					echo '<li class="nav-item"><a class="nav-link text-white mx-2" href="#">' . $MenuItem->Menu . '</a></li>';
				}
			}
		}

	}
}
?>