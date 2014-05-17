<?php
/* 
 * SMK Font Awesome
 *
 * Get font awesome class names in an array or json format. 
 *
 * -------------------------------------------------------------------------------------
 * @Author: Smartik
 * @Author URI: http://smartik.ws/
 * @Copyright: (c) 2014 Smartik. All rights reserved
 * -------------------------------------------------------------------------------------
 *
 * @Date:   2014-05-17 12:29:17
 * @Last Modified by:   Smartik
 * @Last Modified time: 2014-05-17 18:43:02
 *
 */
if( ! class_exists('Smk_FontAwesome') ){
	class Smk_FontAwesome{

		/**
		 * Font Awesome
		 *
		 * @param string $path font awesome css file path
		 * @param string $before prepend a string to class name
		 * @param string $after append a string to class name
		 * @param string $class_prefix change this if the class names does not start with `fa-`
		 * @return array
		 */
		public static function getArray($path, $class_prefix = 'fa-'){

			if( ! file_exists($path) )
				return false;//if path is incorect or file does not exist, stop.

			$css = file_get_contents($path);
			$pattern = '/\.('. $class_prefix .'(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';

			preg_match_all($pattern, $css, $matches, PREG_SET_ORDER);
			
			$icons = array();
			foreach ($matches as $match) {
				$icons[$match[1]] = $match[2];
			}
			return $icons;

		}

		################################################################################
		
		/**
		 * Sort array by key name
		 *
		 * @param array $array font awesome array. Create it using `getArray` method
		 * @return array
		 */
		public static function sortByName($array){
			
			if( ! is_array($array) )
				return false;//Do not proceed if is not array

			ksort( $array );
			return $array;

		}

		################################################################################
		
		/**
		 * Get only HTML class key(class) => value(class)
		 *
		 * @param array $array font awesome array. Create it using `getArray` method
		 * @return array
		 */
		public static function onlyClass($array){
			
			if( ! is_array($array) )
				return false;//Do not proceed if is not array

			$temp = array();
			foreach ($array as $class => $unicode) {
				$temp[$class] = $class;
			}
			return $temp;

		}

		################################################################################
		
		/**
		 * Get only the unicode key
		 *
		 * @param array $array font awesome array. Create it using `getArray` method
		 * @return array
		 */
		public static function onlyUnicode($array){
			
			if( ! is_array($array) )
				return false;//Do not proceed if is not array

			$temp = array();
			foreach ($array as $class => $unicode) {
				$temp[$unicode] = $unicode;
			}
			return $temp;

		}

		################################################################################
		
		/**
		 * Readable class name. Ex: fa-video-camera => Video Camera
		 *
		 * @param array $array font awesome array. Create it using `getArray` method
		 * @return array
		 */
		public static function readableName($array){
			
			if( ! is_array($array) )
				return false;//Do not proceed if is not array

			$temp = array();
			foreach ($array as $class => $unicode) {
				$temp[$class] = ucfirst( str_ireplace(array('fa-', '-'), array('', ' '), $class) );
			}
			return $temp;

		}

	}//class
}//class_exists