<?php

class TokenServer
{
	private static $authKeys;

	public static function setKeys()
	{

		/* This has to be taken from the user database
        * Format:- base64 encoding of username:password
        */

		TokenServer::$authKeys = array(
			'YVc5ekxWbFhOV3RqYlRsd1drTXhhMDlFYUdoWmJVWnJUV3BWZDA5WFZURmFWMWswVFZSVmVFNHlSVFJO', //ios
			'WVc1a2NtOXBaQzFrT0RoaFltRmtNalV3T1dVMVpXWTRNVFV4TjJFNE16ZzVOakZqT1dNMk9BPT0', //android
			'ZDJWaUlIUmxjM1F0WWpKU2JHTnBRblpqYVVKcldsZE9kbHBIVm5sSlIyeDE' //web testing
		);
	}

	public static function getKeys()
	{
		TokenServer::setKeys();
		return TokenServer::$authKeys;
	}
}
