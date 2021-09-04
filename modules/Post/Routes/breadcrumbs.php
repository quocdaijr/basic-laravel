<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('post.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Post', route('post.index'));
});

Breadcrumbs::for('post.create', function (BreadcrumbTrail $trail) {
    $trail->parent('post.index');
    $trail->push('Create', route('post.create'));
});

Breadcrumbs::for('post.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('post.index');
    $trail->parent('edit');
    $trail->push($model->name, route('post.edit', $model->id));
});

Breadcrumbs::for('post.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('post.index');
    $trail->push($model->name, route('post.show', $model->id));
});
