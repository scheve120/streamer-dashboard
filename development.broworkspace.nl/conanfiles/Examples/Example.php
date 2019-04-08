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
	define( 'SQ_ENGINE',      SourceQuery::1 );
	// Edit this <-

	$Query = new SourceQuery( );

	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );

		print_r( $Query->GetInfo( ) );
		print_r( $Query->GetPlayers( ) );
		print_r( $Query->GetRules( ) );
	}
	catch( Exception $e )
	{
		echo "<br/> TEST 1";
		echo $e->getMessage( );
	}
	finally
	{
		$Query->Disconnect( );
	}
