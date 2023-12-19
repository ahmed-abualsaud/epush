<?php

function andWhereTableArray($records, $conditions) {
    return array_filter($records, function ($record) use ($conditions) {
        foreach ($conditions as $key => $value) {
            if (!isset($record[$key]) || $record[$key] != $value) {
                return false;
            }
        }
        return true;
    });
}

function innerJoinTableArrays(array $a, array $b, string $on): array
{
    if (empty($a) || empty($b)) { return array_merge($a, $b); }

    $a = sortTableArrayByColumn($a, $on);
    $b = sortTableArrayByColumn($b, $on);

    return array_filter(array_map(function ($element1, $element2) use ($on) {
        if (! empty($element1) && ! empty($element2) && $element1[$on] == $element2[$on]) {
            return array_merge($element1, $element2);
        }
        return null;
    }, $a, $b));
}

function innerJoinTableArraysOnColumns(array $a, array $b, string $on1, string $on2): array
{
    if (empty($a) || empty($b)) { return array_merge($a, $b); }

    $a = sortTableArrayByColumn($a, $on1);
    $b = sortTableArrayByColumn($b, $on2);

    return array_filter(array_map(function ($element1, $element2) use ($on1, $on2) {
        if (! empty($element1) && ! empty($element2) && $element1[$on1] == $element2[$on2]) {
            return array_merge($element1, $element2);
        }
        return null;
    }, $a, $b));
}

function sortTableArrayByColumn($array, $column): array
{
    usort($array, function ($element1, $element2) use ($column) {
        if ($element1[$column] == $element2[$column]) {
            return 0;
        }
    
        if ($element1[$column] < $element2[$column]) {
            return -1;
        }
    
        if ($element1[$column] > $element2[$column]) {
            return 1;
        }
    });
    return $array;
}

function subAssociativeArray($keys, $array): array
{
    $subArray = [];
    foreach ($keys as $key) {
        if (isset($array[$key])) {
            $subArray[$key] = $array[$key];
        }
    }
    return $subArray;
}

function tableWith(array $tableArray, array $foreignTableArray, string $foreignKeyName, string $ownerKeyName = null, string $newKeyName = null): array
{
    $foreignTableLookup = array_column($foreignTableArray, null, $ownerKeyName ?? 'id');
    
    foreach ($tableArray as &$tableRow) {
        $foreignKeyValue = $tableRow[$foreignKeyName];
        if (isset($foreignTableLookup[$foreignKeyValue])) {
            $tableRow[$newKeyName ?? str_replace("_id", "", $foreignKeyName)] = $foreignTableLookup[$foreignKeyValue];
        }
    }
    
    return $tableArray;
}

function arrayFind(array $array, ?callable $callback, int $mode = 0): mixed 
{
    $result = array_values(array_filter($array, $callback, $mode));
    return empty($result) ? [] : $result[0];
}

function castVariable($variable, $type) {
    switch ($type) {
        case 'int':
        case 'integer':
            return (int) $variable;
        case 'float':
            return (float) $variable;
        case 'double':
            return (double) $variable;
        case 'string':
            return (string) $variable;
        case 'bool':
        case 'boolean':
                return (bool) $variable;
        case 'array':
            return (array) $variable;
        case 'json':
            return json_encode($variable);
        case 'object':
            return (object) $variable;
        case 'binary':
            return pack('H*', bin2hex($variable));
        default:
            return $variable;
    }
}

function castSettings($settings) {
    return castVariable($settings['value'], $settings['type']);
}

function getArrayKeys($array) {
    $keys = [];

    foreach ($array as $key => $value) {
        $keys[] = $key;

        if (is_array($value)) {
            $keys = array_merge($keys, getArrayKeys($value));
        }
    }

    return $keys;
}

function getSubArrayRecursively($array, $keys, &$results) 
{    
    foreach ($array as $key => $value) {
        if (is_array($value) || is_object($value)) {

            getSubArrayRecursively((array)$value, $keys, $results);
        } 
        elseif (in_array($key, $keys)) {
            $results[$key] = $value;
        }
    }
}

function searchSubArray($array, $keys) {
    $result = [];
    foreach ($keys as $key) {
        if (array_key_exists($key, $array)) {
            $result[$key] = $array[$key];
        }
    }
    return $result;
}
