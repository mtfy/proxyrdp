<?php

namespace App\Helpers;

class Helpers
{
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