<?php
/**
 * Adminer Bootstrap-Like Design
 *
 * @author  Natan Felles, https://natanfelles.github.io <natanfelles@gmail.com>
 * @link    https://github.com/natanfelles/adminer-bootstrap-like
 * @link    https://www.adminer.org/plugins/#use
 * @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */

/**
 * Class AdminerBootstrapLike
 */
class AdminerBootstrapLike
{
	var $dev;
	/** @var Adminer */
	var $adminer = null;

	/**
	 * Class constructor
	 *
	 * @param boolean $dev Set TRUE to development mode
	 */
	public function __construct($dev = false)
	{
		$this->dev = $dev;
		$this->adminer = new Adminer();
	}

	function head()
	{
		?>

		<link rel="stylesheet" type="text/css" href="assets/styles<?php echo $this->dev ? '' : '.min' ?>.css">
		<script type="application/javascript" src="assets/scripts<?php echo $this->dev ? '' : '.min' ?>.js" <?php echo nonce() ?>></script>

		<?php
		return true;
	}

	function loginForm()
	{
		?>

		<div id="login-form">
			<?php (new Adminer())->loginForm() ?>
		</div>

		<?php
		return true;
	}

	function name()
	{
		return '<a href="./" id="h1">Adminer</a>'
		. '<div id="scroller"><a href="#"></a><a href="#"></a></div>';
	}

	/**
	 * Prints table list in menu
	 * @param array result of table_status('', true)
	 * @return null
	 */
	function tablesPrint($tables) {
		echo "<ul id='tables' class='test'>" . script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");
		foreach ($tables as $table => $status) {
			$name = $this->adminer->tableName($status);
			if ($name != "") {
				echo '<li>';

				echo (support("table") || support("indexes")
					? '<a href="' . h(ME) . 'table=' . urlencode($table) . '"'
						. bold(in_array($table, array($_GET["table"], $_GET["create"], $_GET["indexes"], $_GET["foreign"], $_GET["trigger"])), (is_view($status) ? "view" : "structure"))
						. " title='" . lang('Show structure') . "'>$name</a>"
					: "<span>$name</span>"
				);

				echo '<a href="' . h(ME) . 'select=' . urlencode($table) . '"' . bold($_GET["select"] == $table || $_GET["edit"] == $table, "select") . ' title="'.lang('select').'">' . $name . "</a> ";

				echo "\n";
			}
		}
		echo "</ul>\n";
		return false;
	}
}
