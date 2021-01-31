<?php

namespace App\Admin\Repositories;

use Spatie\Permission\Models\Permission as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Permission extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    
    protected $eloquentClass = Model::class;

    // 通过这个方法可以指定表单页查询的字段，默认"*"
    /*public function getFormColumns()
    {
        return [$this->getKeyName(), 'name', 'id'];
    }*/
}
