<?php


namespace App\Services;


use App\Services\Traits\CrudMethods;
use Illuminate\Foundation\ProviderRepository;

class ProviderService
{
    use CrudMethods;

    /**
     * @var ProviderRepository
     */
    protected $repository;

    /**
     * ClientsController constructor.
     *
     * @param ProviderRepository $repository
     */
    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
    }
}
