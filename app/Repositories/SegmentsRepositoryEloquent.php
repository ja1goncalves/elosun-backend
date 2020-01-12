<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SegmentsRepository;
use App\Entities\Segments;
use App\Validators\SegmentsValidator;

/**
 * Class SegmentsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SegmentsRepositoryEloquent extends BaseRepository implements SegmentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Segments::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
