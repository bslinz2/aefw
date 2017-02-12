<?php

$applicationName = 'Lehrabschlussprüfung';
$showErrorMessages = true;

// Fehlermeldungen anzeigen
if ($showErrorMessages) {
	error_reporting(-1);
	ini_set('display_errors', 'On');
}

// Zusammenbau der Pfade
$basePath = __DIR__ . '/../';
$applicationPath = $basePath . 'application/';
$pagesPath = $basePath . 'pages/';
$errorPagePath = $pagesPath . '_error.php';
$menuPagePath = $pagesPath . '_menu.php';

// Laden der für die Application benötigten Dateien 
require_once $applicationPath . 'helper.php';
require_once $applicationPath . 'config.php';
require_once $applicationPath . 'database.php';

// Derzeitigen Seiten Schlüssel extrahieren. Als Standard Seite wird 'pages/index.php' verwendet.
$currentPageKey = 'index';
if (isset($_GET['page']) && !empty($_GET['page'])) {
	$currentPageKey = $_GET['page'];
}
$currentPagePath = $pagesPath . $currentPageKey . '.php';

// Hier wird die eigentliche Seite gerendert
try {
	// Die ob_* Methoden sind in diesem Fall dafür zuständig, dass der eigentlich ausgegebene Content in eine Variable umgeleitet wird. Somit kann man vor dem Rendern des Contents z.B dynamisch einen html-Titel im Header setzten.
	ob_start();
	// Nachsehen, ob die genwünschte View existiert
	if (file_exists($currentPagePath)) {
		include $currentPagePath;
	} else {
		// Wenn die View nicht existiert, wird die error View eingebunden
		include $errorPagePath;
	}
	//
	$content = ob_get_clean();
} catch(Exception $exeption) {
	// Der Ausgabebufferspeicher wird hier geleert, damit keine unfertig ausgeführte View vor der Fehlermeldung gerendert wird. 
	ob_get_clean();
	ob_start();
	include $errorPagePath;
	$content = ob_get_clean();
}

// Zusammenbau des html-Titel
$layoutPageTitle = $applicationName;
// Wenn in der View die Variable $pageTitle nicht gesetzt worden ist, dann erscheint nur der Applikations-Name im Titel
if (isset($pageTitle)) {
	$layoutPageTitle = $pageTitle . ' - ' . $layoutPageTitle;
}

// Einbinden des html-Layouts
$layout = $pagesPath . '_layout.php';
include $layout;

