<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

function stringContains($haystack, $needles, $ignoreCase = false): bool
{
    return Str::contains($haystack, $needles, $ignoreCase);
}

function stringStartsWith($haystack, $needles): bool
{
    return Str::startsWith($haystack, $needles);
}

function stringEndsWith($haystack, $needles): bool
{
    return Str::endsWith($haystack, $needles);
}

function getMessageTemplateKeys($template)
{
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

function splitMessage($message, $segmentLength)
{
    $segments = [];
    $length = strlen($message);

    for ($i = 0; $i < $length; $i += $segmentLength) {
        $segment = substr($message, $i, $segmentLength);
        $segments[] = $segment;
    }

    return $segments;
}


function decodeString($encryptedString)
{
    // $publicKey = env('APP_PUBLIC_KEY');
    // $secretKey = env('APP_SECRET_KEY');
    
    return urldecode(base64_decode($encryptedString));
}

function pluralString(string $singularString)
{
    return Str::plural($singularString);
}

function toUTCDateTimeString($dateTimeString)
{
    $timezone = app('request')->input('timezone');
    $timezone = $timezone ?? app('request')->route('timezone');

    if (empty($timezone)) {
        // $ip = '41.34.81.130';
        $ip = app('request')->ip();
        $response = Http::get("http://ip-api.com/json/{$ip}")->json();
        $timezone = $response['status'] === 'success' ? $response['timezone'] : 'UTC';
    }

    $date = new DateTime($dateTimeString, new DateTimeZone($timezone));
    $date->setTimezone(new DateTimeZone('UTC'));
    return $date->format('Y-m-d H:i:s');;
}

function diceCoefficient(string $word1, string $word2): float
{
    $bigrams1 = str_split($word1, 2);
    $bigrams2 = str_split($word2, 2);

    $intersection = array_intersect($bigrams1, $bigrams2);
    $coefficient = (2 * count($intersection)) / (count($bigrams1) + count($bigrams2));
    return $coefficient;
}

function splitTextIntoChunks($text, $n)
{
    $words = preg_split('/\s+/', $text);
    $chunks = [];

    for ($i = 0; $i < count($words); $i += $n) {
        $chunk = implode(' ', array_slice($words, $i, $n));
        $chunks[] = $chunk;
    }

    return $chunks;
}

function findSimilarWords($text, $blacklist, $percentage = 100)
{
    $result = [];
    $minWeight = ($percentage / 100);

    $words = preg_split('/\s+/', $text);
    foreach ($blacklist as $blacklistedWord) {
        foreach ($words as $word) {
            $weight = diceCoefficient($word, $blacklistedWord);

            if ($weight >= $minWeight) {
                $result[] = [
                    'text_word' => $word,
                    'blacklisted_word' => $blacklistedWord,
                    'weight' => $weight
                ];
            }
        }
    }

    $doubleWords = splitTextIntoChunks($text, 2);
    foreach ($blacklist as $blacklistedWord) {
        foreach ($doubleWords as $word) {
            $weight = diceCoefficient($word, $blacklistedWord);

            if ($weight >= $minWeight) {
                $result[] = [
                    'text_word' => $word,
                    'blacklisted_word' => $blacklistedWord,
                    'weight' => $weight
                ];
            }
        }
    }

    $tripleWords = splitTextIntoChunks($text, 3);
    foreach ($blacklist as $blacklistedWord) {
        foreach ($tripleWords as $word) {
            $weight = diceCoefficient($word, $blacklistedWord);

            if ($weight >= $minWeight) {
                $result[] = [
                    'text_word' => $word,
                    'blacklisted_word' => $blacklistedWord,
                    'weight' => $weight
                ];
            }
        }
    }

    usort($result, function ($a, $b) {
        return $b['weight'] - $a['weight'];
    });

    return $result;
}