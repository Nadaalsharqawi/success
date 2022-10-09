<?php

namespace App\Services;

use App\Models\Provider;
use App\Repositories\ProviderRepository;

class ProviderService
{

    protected $repo;
    public function __construct(Provider $repo)
    {
        $this->repo = new ProviderRepository($repo);
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

    public function getProviders($id)
    {
        return $this->repo->getProviders($id);
    }

}
