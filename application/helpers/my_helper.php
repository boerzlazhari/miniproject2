<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        } else {
            return $output;
        }
    }
}

if (!function_exists('die_dump')) {
    function die_dump ($var, $label = 'Dump', $echo = TRUE)
    {
        die(dump ($var, $label, $echo));
    }
}

if (!function_exists('create_folder')) {
    function create_folder ($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
}

if(!function_exists('object_to_array'))
{
    function object_to_array($d)
    {
        if (is_object($d))
        {
            $d = get_object_vars($d);
        }
        if (is_array($d))
        {
            return array_map(__FUNCTION__, $d);
        }
        else
        {
            return $d;
        }
    }
}

