<?php

/** Dump to YAML format
* @link https://www.adminer.org/plugins/#use
* @author Jonathan TISSEAU, https://86dev.fr
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDumpYaml {
	/** @access protected */
	var $database = false;

	function dumpFormat() {
		return array('yaml' => 'YAML');
	}

	function dumpTable($table, $style, $is_view = false) {
		if ($_POST["format"] == "yaml") {
			return true;
		}
	}

	function _database() {
		echo "\n";
	}

	function dumpData($table, $style, $query) {
		if ($_POST["format"] == "yaml") {
			if ($this->database) {
				echo "";
			} else {
				$this->database = true;
				echo "";
				register_shutdown_function(array($this, '_database'));
			}
			$connection = connection();
			$result = $connection->query($query, 1);
			if ($result) {
				$tab = '';
				if ($table) {
					echo $table.":\n";
					$tab = "\t";
				}
				while ($row = $result->fetch_assoc()) {
					$first = true;
					foreach ($row as $key => $val) {
						if ($first) {
							$first = false;
							echo "\n$tab- ";
						} else {
							echo "\n$tab  ";
						}
						echo $key.': ';

						if (is_bool($val)) {
							echo $val ? "true" : "false";
						} elseif (is_numeric($val)) {
							echo $val;
						} else {
							echo '"'.addcslashes($val, "/\r\n\"\\").'"';
						}
					}
				}
			}
			return true;
		}
	}

	function dumpHeaders($identifier, $multi_table = false) {
		if ($_POST["format"] == "yaml") {
			header("Content-Type: application/x-yaml; charset=utf-8");
			return "yaml";
		}
	}

}
