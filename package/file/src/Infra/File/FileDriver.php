<?php

namespace Epush\File\Infra\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDriver implements FileDriverContract 
{ 
    public function __construct( 
        
        private Request $request 
        
    ) {}

    public function localStore(string $fileAttributeName, string $folder, string $fileName = null): string
    {
        if ($this->request->hasFile($fileAttributeName)) {

            $uploadedFile = $this->request->file($fileAttributeName);
            $fileName = empty($fileName) ? $uploadedFile->getClientOriginalName() : $fileName.'.'.$uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs('public/'.$folder, $fileName, 'local');
            return $this->localeStorageBaseUrl() . Storage::url($path);
        }
    
        return '';
    }

    public function deleteLocalFile(string $fileName, string $folder = null): void
    {
        if ( empty($fileName) ) return;

        $path = empty($folder) ? 'public/'.basename($fileName) : 'public/'.$folder.'/'.basename($fileName);
        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
        }
    }

    public function localeStorageBaseUrl(): string
    {
        return url("/");
    }
}