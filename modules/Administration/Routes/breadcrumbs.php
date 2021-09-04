<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('administration.user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('User', route('administration.user.index'));
});

Breadcrumbs::for('administration.user.create', function (BreadcrumbTrail $trail) {
    $trail->parent('administration.user.index');
    $trail->push('Create', route('administration.user.create'));
});

Breadcrumbs::for('administration.user.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('administration.user.index');
    $trail->parent('edit');
    $trail->push($model->username, route('administration.user.edit', $model->id));
});

Breadcrumbs::for('administration.user.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('administration.user.index');
    $trail->push($model->username, route('administration.user.show', $model->id));
});

Breadcrumbs::for('administration.role.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Role', route('administration.role.index'));
});

Breadcrumbs::for('administration.role.create', function (BreadcrumbTrail $trail) {
    $trail->parent('administration.role.index');
    $trail->push('Create', route('administration.role.create'));
});

Breadcrumbs::for('administration.role.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('administration.role.index');
    $trail->parent('edit');
    $trail->push($model->name, route('administration.role.edit', $model->id));
});

Breadcrumbs::for('administration.role.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('administration.role.index');
    $trail->push($model->name, route('administration.role.show', $model->id));
});

Breadcrumbs::for('administration.permission.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Permission', route('administration.permission.index'));
});

Breadcrumbs::for('administration.permission.create', function (BreadcrumbTrail $trail) {
    $trail->parent('administration.permission.index');
    $trail->push('Create', route('administration.permission.create'));
});

Breadcrumbs::for('administration.permission.edit', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('administration.permission.index');
    $trail->parent('edit');
    $trail->push($model->name, route('administration.permission.edit', $model->id));
});

Breadcrumbs::for('administration.permission.show', function (BreadcrumbTrail $trail, $model) {
    $trail->parent('administration.permission.index');
    $trail->push($model->name, route('administration.permission.show', $model->id));
});
