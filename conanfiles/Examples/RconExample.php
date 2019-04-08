<?php
	require __DIR__ . '/../SourceQuery/bootstrap.php';

	use xPaw\SourceQuery\SourceQuery;

	// For the sake of this example
	Header( 'Content-Type: text/plain' );
	Header( 'X-Content-Type-Options: nosniff' );

	// Edit this ->
	define( 'SQ_SERVER_ADDR', '31.214.226.118' );
	define( 'SQ_SERVER_PORT', 32330 );
	define( 'SQ_TIMEOUT',     1 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
	// Edit this <-

	$Query = new SourceQuery( );

	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );

		$Query->SetRconPassword( 'DeStorm1=1' );

		var_dump( $Query->Rcon( 'say hello' ) );
	}
	catch( Exception $e )
	{
		echo "2";
		echo $e->getMessage( );
	}
	finally
	{
		$Query->Disconnect( );
	}
