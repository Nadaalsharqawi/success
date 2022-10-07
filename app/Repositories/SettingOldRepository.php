<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use Illuminate\Database\Eloquent\Model;

class SettingOldRepository
{
    use CrudTrait, ResponseTraits, MainTrait;

    protected $country;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        $data = $request->except('_method', '_token');
        return $this->storeTrait($this->model, $data);
    }
    public function getSettingData($colum, $lang = null)
    {
        if ($lang != null) {
            $data = Setting::get($colum . '_' . $lang);
        } else {
            $data = Setting::get($colum);
        }
        return $data;
    }
}
