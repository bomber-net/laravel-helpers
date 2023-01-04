<?php

if (!function_exists ('routes_path'))
	{
		function routes_path (string $path=''):string
			{
				return base_path ("routes/$path");
			}
	}

if (!function_exists ('logs_path'))
	{
		function logs_path (string $path=''):string
			{
				return storage_path ("logs/$path");
			}
	}
