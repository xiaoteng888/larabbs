<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Role;
use App\Admin\Repositories\Permission;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Spatie\Permission\Models\Permission as ModelPermission;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Checkbox;

class RoleController extends AdminController
{
    

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Role::with('permissions'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('permissions')->display(function ($permissions){
                $res = array_map(function($permission){
                    return $permission['name'];
                },$permissions->toArray());
                $res = implode(',', $res);
                return "<p style='word-break:break-all;word-wrap:break-word;'>$res</p>";
            })->width('5%')->badge('danger');
            /*$model = new Role();
            $grid->model()->join('role_has_permissions', function ($join) use ($model) {
        $join->on('role_has_permissions.permission_id', 'id')
            ->where('role_id', '=', $model->id);
    });*/
            $grid->column('guard_name');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
            $grid->withBorder();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Role(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('guard_name');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(Role::with('permissions'), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->display('created_at');
            $form->display('updated_at');
            // 这里的数据会自动保存到关联模型中
            $form->tree('permissions')
                ->nodes(function () {
                    return (new ModelPermission())->allNodes();
                })
                ->customFormat(function ($v) {
                    if (!$v) return [];

                    // 这一步非常重要，需要把数据库中查出来的二维数组转化成一维数组
                    return array_column($v, 'id');
                });
        });
    }

    public function index(Content $content)
    {
        return $content->body($this->grid());
    }

    /*public function edit($id,Content $content)
    {   
        // 表单 name 属性
        $name = 'permission_id';
        $permissions = ModelPermission::select('id','name')->get()->toArray();
        // 选项
        $options = [];
        foreach($permissions as $v){
             $options[$v['id']] =  $v['name'];  
        }
        $checkbox = Checkbox::make($name, $options)
         ->inline()
         ->check([1, 2]); // 这里允许传递数组，默认选中多个选项
        return $content->body($this->form()->edit($id));
    }*/
}
