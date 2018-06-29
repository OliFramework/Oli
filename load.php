<?php
/** Define Initial Timestamp */
if(!defined('INITTIME')) define('INITTIME', $initTimestamp = microtime(true));

/** Define Global Paths */
if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');

/** Get Oli Source Files Path */
$oliPath = file_exists(ABSPATH . '.olipath') ? file_get_contents(ABSPATH . '.olipath') : null;
if(!$oliPath OR !file_exists($oliPath . 'includes/')) {
	if(file_exists(ABSPATH . 'includes/')) $oliPath = ABSPATH;
	else $oliPath = null;
}

/** Define Oli Source Files Path (if files not found) */
if($oliPath == null) {
	if(!empty($_POST['olipath'])) {
		$_POST['olipath'] = substr($_POST['olipath'], -1) != '/' ? $_POST['olipath'] . '/' : $_POST['olipath'];
		if(file_exists($_POST['olipath'] . 'includes/')) {
			$handle = fopen(ABSPATH . '.olipath', 'w');
			fwrite($handle, $oliPath = $_POST['olipath']);
			fclose($handle);
		}
	}
	
	if($oliPath == null) {
?>

<h1>Oli Basic Configuration —</h1>
<p><b>Hey, looks like the framework core files could not found</b>. You need to either..</p>
<ul>
	<li>Add the core folders and files in your website directory.</li>
	<li>Define manually the path leading to them in the form below.</li>
</ul>

<h2>Define OliPath —</h2>
<form action="#" method="post">
	<?php if(!empty($_POST) AND $_POST['olipath']) { ?><p>[!] Looks like an error occurred.. Are you sure the path you entered led to Oli core folders and files?</p><?php } ?>
	<p>Please type in the absolute path of the directory containing the Oli core folders (like <i>includes/</i>) and files.</p>
	<input type="text" name="olipath" placeholder="/var/www/OliSources/" />
	<button type="submit">Submit the path</button>
</form>

<?php exit;
	}
}

/** Define Oli Paths */
if(!defined('OLIPATH')) define('OLIPATH', $oliPath ?: ABSPATH);
unset($oliPath);

if(!defined('ADDONSPATH')) define('ADDONSPATH', OLIPATH . 'addons/');
if(!defined('INCLUDESPATH')) define('INCLUDESPATH', OLIPATH . 'includes/');
if(!defined('CONTENTPATH')) define('CONTENTPATH', ABSPATH . 'content/');

/** Include OliCore & Addons */
if(file_exists(INCLUDESPATH . 'loader.php')) require_once INCLUDESPATH . 'loader.php';
else trigger_error('The framework <b>loader.php</b> file countn\'t be found! (in "' . INCLUDESPATH . 'loader.php")', E_USER_ERROR);

/** Load OliCore & Addons */
$_Oli = new \Oli\OliCore(INITTIME);
// if(!empty($config['user-config']['addons'])) {
	// foreach($config['user-config']['addons'] as $eachAddon) {
		// if(!empty($eachAddon['name']) AND !empty($eachAddon['var']) AND !empty($eachAddon['class']) AND !isset(${$eachAddon['var']})) {
			// $className = (!empty($eachAddon['namespace']) ? str_replace('/', '\\', $eachAddon['namespace']) . '\\' : '\\') . $eachAddon['class'];
			// ${$eachAddon['var']} = new $className;
			// $_Oli->addAddon($eachAddon['name'], $eachAddon['var']);
			// $_Oli->addAddonInfos($eachAddon['name'], $eachAddon);
		// }
	// }
// }

/** Load Addons */
// if(!empty($_Oli->config['addons'])) {
	// foreach($_Oli->config['addons'] as $eachAddonInfosName => $eachAddonInfos) {
		// if(!empty($eachAddonInfosName) AND !empty($eachAddonInfos['var']) AND !empty($eachAddonInfos['class']) AND !isset(${$eachAddonInfos['var']})) {
			// $className = (!empty($eachAddonInfos['namespace']) ? str_replace('/', '\\', $eachAddonInfos['namespace']) . '\\' : '\\') . $eachAddonInfos['class'];
			// ${$eachAddonInfos['var']} = new $className;
			// $_Oli->addAddon($eachAddonInfosName, $eachAddonInfos['var']);
			// $_Oli->addAddonInfos($eachAddonInfosName, $eachAddonInfos);
			
			// if(file_exists(CONTENTPATH . $eachAddonInfosName . '.json')) ${$eachAddonInfos['var']}->loadConfig(json_decode(file_get_contents(CONTENTPATH . $eachAddonInfosName . '.json'), true));
			// else {
				// $handle = fopen(CONTENTPATH . $eachAddonInfosName . '.json', 'w');
				// fclose($handle);
			// }
		// }
	// }
// }

/** Load Configs */
// if(!empty($config['user-config'])) {
	// foreach($config['user-config'] as $eachKey => $eachConfig) {
		// if($eachKey == 'Oli') {
			// if(file_exists(ABSPATH . 'mysql.json')) $_Oli->loadConfig(array('mysql' => json_decode(file_get_contents(ABSPATH . 'mysql.json'), true)));
			// $_Oli->loadConfig($eachConfig);
		// }
		// else ${$_Oli->getAddonVar($eachKey)}->loadConfig($eachConfig);
	// }
// }

/** Load Additional Config */
if(file_exists(ABSPATH . 'config.php')) include ABSPATH . 'config.php';
?>