<?php
require 'vendor/autoload.php';
require_once "Funciones.php";

class RedSocial extends Funciones
{
	public $client='';
	function __construct()
	{
// Authenticate via OAuth para tumblr
	// $this->client = new Tumblr\API\Client(
 //  'gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz',
 //  '7PP9WfRZpscKoTokicfU2hln25pDV8OpdpduqJ3yjkwTiF10Uc',
 //  'TH3avsrQnDe1kUJClH770pYDX1APU4P4qCjfv8KJvViRZZkYMO',
 //  'ApjZiZhLKsZfRId1ugO294RRn7UqDgg4GYzVr3VDfiEaZRrQCV'
	// );

	// $this->client = new Tumblr\API\Client(
 //  'gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz',
 //  '7PP9WfRZpscKoTokicfU2hln25pDV8OpdpduqJ3yjkwTiF10Uc',
 //  'GMqwchJo3oed3kiN6PTGQY8d3odcgAPfUdhqCeUdmTzLsIQtdf',
 //  'ze08V3QbXnRdivaz6VtL4lfRgIH68eCbICkxn4o0d0vBCeDwJm'
	// );


		$this->client = new Tumblr\API\Client(
  'gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz',
  '7PP9WfRZpscKoTokicfU2hln25pDV8OpdpduqJ3yjkwTiF10Uc',
  'Rdpr9BLyztzHfvwZg186XKN4Gk4ACWb4moD6CWREWORij1NQW0',
  'baEy5lfoOhQYwuW2kstCAa2s12JpKc4Fv1wIbHv3H8lcPJDFid'
);

// 	Consumer Key gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz
// Consumer Secret 7PP9WfRZpscKoTokicfU2hln25pDV8OpdpduqJ3yjkwTiF10Uc
// Token GMqwchJo3oed3kiN6PTGQY8d3odcgAPfUdhqCeUdmTzLsIQtdf
// Token Secret ze08V3QbXnRdivaz6VtL4lfRgIH68eCbICkxn4o0d0vBCeDwJm
// API Key gM2N8xYg4gJ2NAGYoLGGoBzKHGg7GX4dOHtxpPIXob1GG5p4Tz

	}
}

