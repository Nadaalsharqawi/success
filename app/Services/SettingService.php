<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\SettingRepository;
class SettingService
{

    protected $repo;
    public function __construct(Setting $repo)
    {
        $this->repo = new SettingRepository($repo);
    }

    public function index()
    {
        return $this->repo->index();
    }

    public function show($id)
    {
        return $this->repo->show($id);
    }

    public function store($request){
        return $this->repo->store($request);
    }

    public function update($id, $request){
        return $this->repo->update($id,$request);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }

}
