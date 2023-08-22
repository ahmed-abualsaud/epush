<?php

namespace Epush\Core\Country\Present\Http\Controller;

use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Put;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;
use Spatie\RouteAttributes\Attributes\Delete;

use Epush\Core\Country\Domain\DTO\CountryDto;
use Epush\Core\Country\Domain\DTO\AddCountryDto;
use Epush\Core\Country\Domain\DTO\ListCountriesDto;
use Epush\Core\Country\Domain\DTO\SearchCountryDto;
use Epush\Core\Country\Domain\DTO\UpdateCountryDto;

use Epush\Core\Country\Domain\UseCase\GetCountryUseCase;
use Epush\Core\Country\Domain\UseCase\AddCountryUseCase;
use Epush\Core\Country\Domain\UseCase\ListCountriesUseCase;
use Epush\Core\Country\Domain\UseCase\DeleteCountryUseCase;
use Epush\Core\Country\Domain\UseCase\SearchCountryUseCase;
use Epush\Core\Country\Domain\UseCase\UpdateCountryUseCase;

use Symfony\Component\HttpFoundation\Response;


#[Prefix('api/country')]
class CountryController
{
    #[Get('/')]
    public function listCountries(ListCountriesDto $listCountriesDto, ListCountriesUseCase $listCountriesUseCase): Response
    {
        return successJSONResponse($listCountriesUseCase->execute($listCountriesDto));
    }

    #[Post('/')]
    public function addCountry(AddCountryDto $addCountryDto, AddCountryUseCase $addCountryUseCase): Response
    {
        return successJSONResponse($addCountryUseCase->execute($addCountryDto));
    }

    #[Get('{country_id}')]
    public function getCountry(CountryDto $countryDto, GetCountryUseCase $getCountryUseCase): Response
    {
        return successJSONResponse($getCountryUseCase->execute($countryDto));
    }

    #[Put('{country_id}')]
    public function updateCountry(CountryDto $countryDto, UpdateCountryDto $updateCountryDto, UpdateCountryUseCase $updateCountryUseCase): Response
    {
        return successJSONResponse($updateCountryUseCase->execute($countryDto, $updateCountryDto));
    }

    #[Delete('{country_id}')]
    public function deleteCountry(CountryDto $countryDto, DeleteCountryUseCase $deleteCountryUseCase): Response
    {
        return successJSONResponse($deleteCountryUseCase->execute($countryDto));
    }

    #[Post('/search')]
    public function searchCountryColumn(SearchCountryDto $searchCountryDto, SearchCountryUseCase $searchCountryUseCase): Response
    {
        return successJSONResponse($searchCountryUseCase->execute($searchCountryDto));
    }
}