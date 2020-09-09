<?php
include 'server.php';
$input = file_get_contents('php://input');

if ( $input != null ) {
	
	$decode = json_decode( $input, true );
	$message = array_merge( array( 'time' => time() ), $decode );
	file_put_contents(NAME_FILE, json_encode( $message ));
};
?>