<?php

namespace Epush\Shared\App\Service;

use Epush\Shared\App\Contract\ScanningServiceContract;

class ScanningService implements ScanningServiceContract
{
    public function scanModules(string $modulesDirectory, string $contextsDirectory) : array
    {
        $modulesPath = base_path($modulesDirectory);
        $files = scandir($modulesPath);

        $packages = array_values(array_filter($files, function ($file) use ($modulesPath) {
            return !in_array($file, ['.', '..', 'shared', 'sms'], true) && is_dir($modulesPath.'/'.$file);
        }));

        if (empty($packages)) { return []; }
        $data = [];

        foreach ($packages as $package) {
            $contextsPath = $modulesPath.'/'.$package.'/'.$contextsDirectory;
            $files = scandir($contextsPath);

            $contexts = array_values(array_filter($files, function ($file) use ($contextsPath) {
                return in_array(strtolower($file), ['http', 'graphql', 'grpc'], true) && is_dir($contextsPath.'/'.$file);
            }));

            if (empty($contexts)) { $data[$package] = []; continue; }

            foreach ($contexts as $context) {
                $handleGroupPath = $contextsPath.'/'.$context;

                switch (strtolower($context)) {
                    case 'http':
                        $handleGroupPath .= '/Controller';
                        break;
                    
                    case 'grpc':
                        $handleGroupPath .= '/Service';
                        break;
                    
                    case 'graphql':
                        $handleGroupPath .= '/Resolver';
                        break;
                }

                $files = scandir($handleGroupPath);
                $hendleGroups = array_values(array_filter($files, function ($file) use ($handleGroupPath, $context) {
                    return is_file($handleGroupPath.'/'.$file) && is_readable($handleGroupPath.'/'.$file) && $this->isValidHandleGroup($context, $file);
                }));

                if (empty($hendleGroups)) { $data[$package][$context] = []; continue; }

                foreach ($hendleGroups as $handleGroup) {
                    $handlerPath = $handleGroupPath.'/'.$handleGroup;

                    $handlers = $this->getHandleGroupHandlers($handlerPath);
                    if (empty($handlers)) { $data[$package][$context][$handleGroup] = []; continue; }
                    $data[$package][$context][substr($handleGroup, 0, -4)] = $handlers;
                }
            }
        }
        return $data;
    }

    private function getHandleGroupHandlers(string $filePath): array 
    {
        $code = file_get_contents($filePath);
        $tokens = token_get_all($code);
        $publicMethods = [];

        for ($i = 0; $i < count($tokens); $i++) {
            $token = $tokens[$i];

            if (is_array($token)) {
                $type = $token[0];
                $value = $token[1];

                if ($type == T_PUBLIC) {
                    if (isset($tokens[$i+2]) && isset($tokens[$i+4]) && 
                        is_array($tokens[$i+2]) && is_array($tokens[$i+4]) &&
                        $tokens[$i+2][0] == T_FUNCTION && $tokens[$i+4][0] == T_STRING) {
                        $functionName = $tokens[$i+4][1];
                        $publicMethods[] = $functionName;
                    }
                }
            }
        }
        return $publicMethods;
    }

    private function isValidHandleGroup(string $context, string $file) : bool
    {
        switch (strtolower($context)) {
            case 'http':
                return strpos($file, 'Controller.php') !== false;
            
            case 'grpc':
                return strpos($file, 'Service.php') !== false;
            
            case 'graphql':
                return strpos($file, 'Resolver.php') !== false;

            default:
                return false;
        }
    }
}