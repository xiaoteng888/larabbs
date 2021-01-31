<?php

namespace App\Admin\Repositories;

use App\Models\Site as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Site extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
