<?php

// Diese Funktion schützt vor Cross-Site-Scripting (XSS). Sie escaped die Ausgabe von Variable
function e($text) {
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}