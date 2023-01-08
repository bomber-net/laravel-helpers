<?php

use Illuminate\Support\Arr;

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

if (!function_exists ('hexbin'))
	{
		function hexbin (string $hex):?string
			{
				static $convert=
					[
						'0'=>'0000','1'=>'0001','2'=>'0010','3'=>'0011',
						'4'=>'0100','5'=>'0101','6'=>'0110','7'=>'0111',
						'8'=>'1000','9'=>'1001','a'=>'1010','b'=>'1011',
						'c'=>'1100','d'=>'1101','e'=>'1110','f'=>'1111',
					];
				$hex=strtolower ($hex);
				$bin='';
				foreach (str_split ($hex) as $char)
					{
						if (!($char=$convert[$char]??null)) return null;
						$bin.=$char;
					}
				return $bin;
			}
	}

if (class_exists ('\Illuminate\Support\Facades\Vite'))
	{
		if (!function_exists ('vite_assets'))
			{
				function vite_assets (string $buildDirectory='bulid'):array
					{
						$vite=Illuminate\Support\Facades\Vite::useBuildDirectory ($buildDirectory);
						$vite->toHtml ();
						return Arr::first ((new ReflectionClass ($vite))->getProperty ('manifests')->getValue ());
					}
			}
		
		if (!function_exists ('vite_entries'))
			{
				function vite_entries (string $buildDirectory='bulid'):array
					{
						return array_filter (vite_assets ($buildDirectory),fn (array $asset)=>$asset['isEntry']??false);
					}
			}
	}
