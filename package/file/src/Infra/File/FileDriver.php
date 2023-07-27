<?php

namespace Epush\File\Infra\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDriver implements FileDriverContract 
{ 
    public function __construct( 
        
        private Request $request 
        
    ) {}

    public function localStore(string $fileAttributeName, string $folder): string
    {
        if ($this->request->hasFile($fileAttributeName)) {

            $path = $this->request->file($fileAttributeName)->store('public/'.$folder, 'local');
            return $this->localeStorageBaseUrl() . Storage::url($path);
        }

        return '';
    }

    public function localeStorageBaseUrl(): string
    {
        return url("/");
    }
}