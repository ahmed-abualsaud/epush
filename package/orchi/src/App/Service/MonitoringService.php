<?php

namespace Epush\Orchi\App\Service;

use Epush\Orchi\App\Contract\LookupServiceContract;
use Epush\Orchi\App\Contract\MonitoringServiceContract;
use Epush\Orchi\App\Contract\OrchiDatabaseServiceContract;
use Epush\Shared\App\Contract\ScanningServiceContract;

class MonitoringService implements MonitoringServiceContract
{
    public function __construct(

        private LookupServiceContract $lookupService,
        private ScanningServiceContract $scanningService,
        private OrchiDatabaseServiceContract $orchiDatabaseService

    ) {}

    public function sync(): void
    {
        $modulesDirectory = 'package';
        $contextsDirectory = 'src/Present';

        $localAppServices = $this->orchiDatabaseService->getLocalAppServices();
        $remoteAppServices = $this->orchiDatabaseService->getRemoteAppServices();

        $modules = $this->scanningService->scanModules($modulesDirectory, $contextsDirectory);
        $services = $this->lookupService->servicesLookup($remoteAppServices);

        $modulesName = array_keys($modules);
        $localServicesName = array_column($localAppServices, 'name');



        // I will use static scanning for a while !!



        // if $localAppServices == $modules
        // if (count($localServicesName) == count($modulesName) && array_diff($localServicesName, $modulesName) == []) {
        //     $this->orchiDatabaseService->appServiceRepository()->updateLocalServices(['online' => true]);

        //     foreach ($modules as $moduleName => $contexts) {
        //         return $contexts;
        //     }

        //     $contextsNames = array_keys($co
        // }


        

        // if $remoteAppServices == $services then update $same services with there contexts, handle groups and handlers

        // if $localservices == $modules then update $same services with there contexts, handle groups and handlers

        // if $localservices < $modules then update $same services and add the $difference services 
        // with there contexts, handle groups and handlers to the database


        // if $localservices > $modules then update $same services and check $difference array 
        // between them exists in the $services array and if there are services from $difference array exists 
        // in $services array then update there $context and if not make the service offline (also make it's contexts offline)






        // if (empty($appServices)) { return; }

        // foreach ($appServices as $name => $contexts) {
        //     ;
        // }
    }
}