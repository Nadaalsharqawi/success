<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\SettingRepository;

class SettingOldService
{
    protected $SettingRepository;
    public function __construct(Setting $SettingRep)
    {
        $this->SettingRepository = new SettingRepository($SettingRep);
    }

    public function store($request)
    {
        return $this->SettingRepository->store($request);
    }

    public function getSettingData($colum, $lang = null)
    {
        $data = $this->SettingRepository->getSettingData($colum, $lang);
        return $data;
    }
}
