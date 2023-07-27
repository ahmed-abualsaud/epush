<?php

namespace Epush\Shared\Infra\Database;

trait BlindCreate
{
    public function blindCreate(array $data)
    {
        if (empty($data)) { return []; }

        $dataKeys = array_keys($data);
        $dataKeysLength = count($dataKeys);

        $softDeletedBefore = $this->withTrashed()->whereNotNull('deleted_at')->where(function($query) use ($data, $dataKeys, $dataKeysLength) {
            $query = $query->where($dataKeys[0], $data[$dataKeys[0]]);
            for ($i=1; $i < $dataKeysLength; $i++) { 
                $query = $query->orWhere($dataKeys[$i], $data[$dataKeys[$i]]);
            }
        })->first();

        if (empty($softDeletedBefore)) {
            return $this->create($data)->toArray();
        }

        $data['deleted_at'] = null;
        $this->withTrashed()->where("id", $softDeletedBefore->id)->update($data);
        return $this->where("id", $softDeletedBefore->id)->first()->toArray();
    }
}