<?php

namespace App\Helpers;

class Helpers
{

	/**
	 * A method for generating cryptographically secure
	 * random strings using six different pre-defined
	 * patterns;
	 * 
	 *	- "alnum"		=> alphabetical and numeric
	*	- "alpha"		=> alphabets only
	*	- "numeric"		=> digits only
	*	- "nozero"		=> random number without zeros, only 1-9
	*	- "hexdec"		=> a hexadecimal string, a-f + 0-9
	*
	* Credits:
	* 		-	Slightly modified from the original function, https://gist.github.com/raveren/5555297
	* 		-	Based on Kohana's Text::random() method and this answer: http://stackoverflow.com/a/13733588/179104
	* 
	* @author Motify
	* @param  string  $type
	* @param  integer $length
	* @return string
	*/
	public static function generateRandomString($pattern = 'alnum', $length = 13) : string
	{
		switch ($pattern)
		{
			case 'alnum':
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'alpha':
				$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'hexdec':
				$pool = '0123456789abcdef';
				break;
			case 'numeric':
				$pool = '0123456789';
				break;
			case 'nozero':
				$pool = '123456789';
				break;
			case 'distinct':
				$pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
				break;
			default:
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';;
				break;
		}


		$crypto_rand_secure = function ( $min, $max ) {
			$range = $max - $min;
			if ( $range < 0 ) return $min; // not so random...
			$log    = log( $range, 2 );
			$bytes  = (int) ( $log / 8 ) + 1; // length in bytes
			$bits   = (int) $log + 1; // length in bits
			$filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
			do {
				$rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
				$rnd = $rnd & $filter; // discard irrelevant bits
			} while ( $rnd >= $range );
			return $min + $rnd;
		};

		$token = '';
		$max   = strlen( $pool );
		for ($i = 0; $i < $length; $i++)
			$token .= $pool[$crypto_rand_secure( 0, $max )];
		
		return $token;
	}

    public static function displaySensitiveString(string $str)
    {
        $length = \mb_strlen($str, 'utf-8');
		
		if ($length === 1)
			return 'x';
		
		if ($length < 8)
			return \mb_substr($str, 0, 1, 'utf-8') . \str_repeat('x', $length - 1);

		
		return \mb_substr($str, 0, $length / 3, 'utf-8') . \str_repeat('x', $length / 3) . \mb_substr($str, (($length / 3 ) * 2), $length, 'utf-8');
    }

	public static function getStringBetween(string $str, string $start, string $end) : string
	{
		$str = ' ' . $str;
		$ini = strpos($str, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($str, $end, $ini) - $ini;
		return substr($str, $ini, $len);
	}
}