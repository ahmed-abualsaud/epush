<?php

use Illuminate\Support\Str;

function stringContains($haystack, $needles, $ignoreCase = false): bool
{
    return Str::contains($haystack, $needles, $ignoreCase);
}

function getMessageTemplateKeys($template) {
    $regex = '/{{(.*?)}}/';
    preg_match_all($regex, $template, $matches);
    
    if (empty($matches[0])) {
        return [];
    }
    
    $values = array_map(function ($match) {
        return strtolower(trim(str_replace(['{{', '}}'], '', $match)));
    }, $matches[0]);
    
    return $values;
}

function replaceTemplateKeys(string $string, array $attributes, string $defaultValue = '<span style="color: red">unknown</span>'): mixed
{
    return preg_replace_callback('/{{(.*?)}}/', function($matches) use ($attributes, $defaultValue) {
        $placeholder = trim($matches[1]);
        return $attributes[$placeholder] ?? $defaultValue;
    }, $string);
}


function decodeString($encryptedString) {
    // $publicKey = env('APP_PUBLIC_KEY');
    // $secretKey = env('APP_SECRET_KEY');
    
    return urldecode(base64_decode($encryptedString));
}

function pluralString(string $singularString)
{
    return Str::plural($singularString);
}