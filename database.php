<?php

$connection = @new MySqli('localhost', 'root', '', 'theater');
if(!empty($connection->connect_error)) {
	throw new Exception($connection->connect_error);
}
$connection->set_charset('utf8');