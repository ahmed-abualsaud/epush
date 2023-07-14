<?php

namespace Epush\Orchi\App\Service;

use Epush\Orchi\App\Contract\LookupServiceContract;

class LookupService implements LookupServiceContract
{
    public function servicesLookup(array $remoteAppServices): array
    {
        if (empty($remoteAppServices)) return [];

        $services = [];

        foreach ($remoteAppServices as $remoteAppService) {

            switch (strtolower($remoteAppService['lookup_type'])) {
                case 'http':
                    $services = array_merge($services, $this->httpLookup($remoteAppServices['ip_address'], $remoteAppServices['endpoint']));
                    break;
                
                case 'grpc':
                    $services = array_merge($services, $this->grpcLookup($remoteAppServices['ip_address'], $remoteAppServices['endpoint']));
                    break;

                case 'graphql':
                    $services = array_merge($services, $this->graphqlLookup($remoteAppServices['ip_address'], $remoteAppServices['endpoint']));
                    break;
            }
        }

        return $services;
    }

    // Microservice lookup functions
    private function httpLookup(string $ipAddress, string $endpoint): array
    {
        return [];
    }

    private function grpcLookup(string $ipAddress, string $endpoint): array
    {
        return [];
    }

    private function graphqlLookup(string $ipAddress, string $endpoint): array
    {
        return [];
    }
}