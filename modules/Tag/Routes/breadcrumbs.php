<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('tag.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Tag', route('tag.index'));
});

Breadcrumbs::for('tag.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tag.index');
    $trail->push('Create', route('tag.create'));
});

Breadcrumbs::for('tag.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('tag.index');
    $trail->parent('edit');
    $trail->push($model->name, route('tag.edit', $model->id));
});

Breadcrumbs::for('tag.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('tag.index');
    $trail->push($model->name, route('tag.show', $model->id));
});
