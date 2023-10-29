<?php
class ModelExtensionModuleMyModule extends Model {
	public function uninstall() {

	}
	
	public function install() {
		try{
			$query = $this->db->query("Your SQL");
		}
		catch(Exception $e) {
		}
	}
}