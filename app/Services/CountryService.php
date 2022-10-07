<?php

namespace App\Services;

use App\Models\Country;
use App\Repositories\CountryRepository;

class CountryService
{

    protected $repo;
    public function __construct(Country $repo)
    {
        $this->repo = new CountryRepository($repo);
    }

    public function index()
    {
        return $this->repo->index();
    }

    public function show($id)
    {
        return $this->repo->show($id);
    }

    public function store($request)
    {

        return $this->repo->store($request);
    }

    public function update($id, $request)
    {
        return $this->repo->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }
}
