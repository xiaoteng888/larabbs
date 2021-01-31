<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Spatie\Permission\Models\Role;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(User::with('roles'), function (Grid $grid) {
            $grid->column('id')->width('5%')->sortable();
            $grid->column('name')->width('10%');
            $grid->column('email')->width('15%');
            $grid->column('email_verified_at')->width('20%');
            $grid->column('roles')->display(function($roles){
                $res = array_map(function($role){
                    return $role['name'];
                },$roles->toArray());
                $res = implode(',', $res);
                return "<p>$res</p>";
            })->width('10%')->badge('green');
            $grid->column('created_at')->width('20%');
            $grid->column('updated_at')->width('20%')->sortable();
        
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
        return Show::make($id, new User(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('email');
            $show->field('email_verified_at');
            $show->field('password');
            $show->field('remember_token');
            $show->field('avatar');
            $show->field('introduction');
            $show->field('notification_count');
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
        return Form::make(User::with('roles'), function (Form $form) {
            $form->display('id');
            $form->text('name')->rules('required');
            $form->text('email')->rules(function(Form $form){
                if(!$id = $form->model()->id){
                    return 'required|unique:users,email';
                }
                return 'required|unique:users,email,'.$form->model()->id;
            });
            $form->password('password')->rules(function (Form $form){
                if(!$id = $form->model()->id){
                    return 'required|min:6';
                }
                
            });
            
            // 这里的数据会自动保存到关联模型中
            $form->tree('roles')
                ->nodes(function () {
                    return (new Role())->allNodes();
                })
                ->customFormat(function ($v) {
                    if (!$v) return [];

                    // 这一步非常重要，需要把数据库中查出来的二维数组转化成一维数组
                    return array_column($v, 'id');
                });

            $form->saving(function (Form $form){
                if($form->password){
                    $form->password = bcrypt($form->password);
                }
                
            });

                $form->submitted(function(Form $form){

                    $posted_data = request()->all();
                    $ignore = ['password'];
                    if ( empty($posted_data['password']))
                    {
                        $ignore[] = 'password';

                    }else{
                        $form->password('password')->rules('min:6');
                    }

                    $form->ignore($ignore);
                });

        });
                
    }

    public function index(Content $content)
    {
        return $content->body($this->grid());
    }

    /*public function edit(Content $content)
    {
        return $content->body($this->form()->ignore());
    }*/
}
