<?php

namespace App\Services;

use App\Models\Membership;
use App\Repositories\MembershipRepository;
class MembershipService
{
    protected $repo;
    public function __construct(Membership $repo)
    {
        $this->repo = new MembershipRepository($repo);
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

    public function discount($request)
    {
        return $this->repo->discount($request);
    }
}
