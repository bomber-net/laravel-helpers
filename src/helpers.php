<?php

if (!function_exists ('str_normalize'))
	{
		function str_normalize (string $str):float|bool|int|string|null
			{
				return match (strtolower ($str))
					{
					'null'=>null,
					'true'=>true,
					'false'=>false,
					default=>is_numeric ($str)?(is_intnum ($str)?(int)$str:(float)$str):$str,
					};
			}
	}

if (!function_exists ('is_intnum'))
	{
		function is_intnum (mixed $value):bool
			{
				$type=get_debug_type ($value);
				if ($type==='int') return true;
				$int=(int)$value;
				settype ($int,$type);
				return $int===$value;
			}
	}

if (!function_exists ('sign'))
	{
		function sign (int|float $number):int
			{
				return match (true)
					{
						$number<0=>-1,
						$number>0=>1,
						default=>0
					};
			}
	}
