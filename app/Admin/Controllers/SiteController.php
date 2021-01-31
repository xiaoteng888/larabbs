<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Site;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SiteController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Site(), function (Grid $grid) {
            $grid->column('name');
            $grid->column('email');
            $grid->column('seo_description');
            $grid->column('seo_key');
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    /*protected function detail($id)
    {
        return Show::make($id, new Site(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('email');
            $show->field('seo_description');
            $show->field('seo_key');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }*/

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Site(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('email')->rules('required|email');
            $form->text('seo_description');
            $form->text('seo_key');
        });
    }
}
