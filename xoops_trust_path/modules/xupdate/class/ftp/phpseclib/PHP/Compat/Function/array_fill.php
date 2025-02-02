<?php
// $Id: array_fill.php,v 1.1 2007/07/02 04:19:55 terrafrost Exp $

/**
 * Replace array_fill()
 *
 * @param $start_index
 * @param $num
 * @param $value
 *
 * @return array|bool
 * @category    PHP
 * @package     PHP_Compat
 * @license     https://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright   2004-2007 Aidan Lister <aidan@php.net>, Arpad Ray <arpad@php.net>
 * @link        https://php.net/function.array_fill
 * @author      Jim Wigginton <terrafrost@php.net>
 * @version     $Revision: 1.1 $
 * @since       PHP 4.2.0
 */
function php_compat_array_fill( $start_index, $num, $value ) {
	if ( $num <= 0 ) {
		user_error( 'array_fill(): Number of elements must be positive', E_USER_WARNING );

		return false;
	}

	$temp = [];

	$end_index = $start_index + $num;
	for ( $i = (int) $start_index; $i < $end_index; $i ++ ) {
		$temp[ $i ] = $value;
	}

	return $temp;
}

// Define
if ( ! function_exists( 'array_fill' ) ) {
	function array_fill( $start_index, $num, $value ) {
		return php_compat_array_fill( $start_index, $num, $value );
	}
}
