<?php

use Illuminate\Support\Str;

function stringContains($haystack, $needles, $ignoreCase = false): bool
{
    return Str::contains($haystack, $needles, $ignoreCase);
}

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
        if ($element1[$on] == $element2[$on]) {
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
        if ($element1[$on1] == $element2[$on2]) {
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

function arrayFind(array $array, ?callable $callback, int $mode = 0): array 
{
    $result = array_values(array_filter($array, $callback, $mode));
    return empty($result) ? [] : $result[0];
}
