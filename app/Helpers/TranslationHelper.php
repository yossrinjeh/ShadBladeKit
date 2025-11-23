<?php

if (!function_exists('__debug')) {
    /**
     * Debug translation helper that shows missing translation keys
     * 
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    function __debug($key, $replace = [], $locale = null)
    {
        $translation = __($key, $replace, $locale);
        
        // If translation equals the key, it means translation is missing
        if ($translation === $key && app()->environment(['local', 'development'])) {
            return "[MISSING: {$key}]";
        }
        
        return $translation;
    }
}

if (!function_exists('trans_debug')) {
    /**
     * Debug translation helper for trans() function
     * 
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    function trans_debug($key, $replace = [], $locale = null)
    {
        $translation = trans($key, $replace, $locale);
        
        // If translation equals the key, it means translation is missing
        if ($translation === $key && app()->environment(['local', 'development'])) {
            return "[MISSING: {$key}]";
        }
        
        return $translation;
    }
}