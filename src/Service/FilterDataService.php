<?php

namespace App\Service;

use App\Data\FilterData;
use App\Repository\AuthorRepository;
use App\Repository\GenderRepository;

/**
 *  Service qui permet de construire les données pour le filtre
 */
class FilterDataService
{
    /**
     * @param array $data
     * @return FilterData
     */
    public function dataBuilder (array $data): FilterData
    {
        $authorRepository = new AuthorRepository(new ConnectionDbService());
        $genderRepository = new GenderRepository(new ConnectionDbService());

        $filterData = new FilterData();

        if (isset($data['authors'])) {
            foreach ($data['authors'] as $authorId) {
                $filterData->authors[] = $authorRepository->read($authorId);
            }
        }
        if (isset($data['genders'])) {
            foreach ($data['genders'] as $genderId) {
                $filterData->genders[] = $genderRepository->read($genderId);
            }
        }

        return $filterData;
    }
}