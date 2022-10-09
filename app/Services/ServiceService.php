<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\ServiceRepository;

class ServiceService
{

    protected $repo;
    public function __construct(Service $repo)
    {
        $this->repo = new ServiceRepository($repo);
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

    public function getServices($id)
    {
        return $this->repo->getServices($id);
    }

}
