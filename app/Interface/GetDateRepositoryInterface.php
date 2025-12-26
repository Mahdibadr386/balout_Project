<?php

namespace App\Interface;

interface GetDateRepositoryInterface
{
    public function getTimes();


    public function getBranches();


    public function getCities();


    public function getDistricts(int $cityId);

}
