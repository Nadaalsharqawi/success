<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\Service;
use App\Helpers\FileHelper;
use App\Http\Traits\CrudTrait;
use App\Http\Traits\MainTrait;
use App\Http\Traits\ResponseTraits;
use Illuminate\Database\Eloquent\Model;

class AdsRepository
{
    use CrudTrait, ResponseTraits, MainTrait;

    protected $country;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->indexTrait($this->model);
    }

    public function show($id)
    {
        return $this->showTrait($this->model, $id);
    }

    public function store($request)
    {
        $data = $request->except('_method', '_token', 'country_id', 'service_id', 'image');
        $countries = Country::whereIn('id', $request->country_id)->get();
        $services = Service::whereIn('id', $request->service_id)->pluck('id');
        foreach ($countries as $country) {
            foreach ($services as $serv) {
                if ($country->services->where('id', $serv)->first() == null) {
                    $sr = Service::find($serv);
                    session()->flash('failed', $country->name . trans("admin.has_no_service") . $sr->name);
                    return redirect()->back();
                }
            }
        }
        if ($request->hasFile('image')) {
            $image_path = FileHelper::upload_file('membership', $request->image);
            $data['image'] = $image_path;
        }
        return $this->storeTrait($this->model, $data);
    }

    public function update($id, $request)
    {
        $data = $request->except('_method', '_token', 'country_id');
        return $this->updateTrait($this->model, $id, $data);
    }

    public function destroy($id)
    {
        return $this->destroyTrait($this->model, $id);
    }
}
