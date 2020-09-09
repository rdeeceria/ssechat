<?php
const NAME_FILE = 'json';
const TIME_OUT = 60;

date_default_timezone_set('Asia/Jakarta');
set_time_limit( TIME_OUT );

function event( $id, $type )
{
	ob_implicit_flush();
	
	switch ( $type ) 
	{
		case 'open':
		
			if ( file_exists(NAME_FILE) ) {
				
				echo "id: ". $id ."\nevent: ". $type ."\ndata: ". 'Stream Open' ."\n\n";
				ob_flush();flush();
				
			} else {
				
				echo "retry: ". 1000 ."\ndata: ". 'Create json and Stream Open' ."\n\n";
				ob_flush();flush();
				
				$file = fopen(NAME_FILE, 'a+');
				fclose( $file );
			}
			break;
		
		case 'chat':

			$file = file_get_contents(NAME_FILE);
			$modtime = filemtime(NAME_FILE);
			
			$decode = json_decode( $file, true );
			$result = json_encode( $decode );

			if ( $modtime == time() ) {	
			
				for( $i = 0; $i < touch(NAME_FILE); $i++ ) {
					echo "id: ". $id ."\nevent: ". $type ."\ndata: ". $result ."\n\n";
					ob_flush();flush();
				}
			}
			
			break;
		
		case 'timeout':
		
			echo "retry: ". 5000 ."\ndata: ". 'Timeout' ."\n\n";
			ob_flush();flush();

			break;
	}
	clearstatcache();
}
