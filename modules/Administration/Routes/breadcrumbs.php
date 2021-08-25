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

Breadcrumbs::for('administration.user.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('administration.user.index');
    $trail->push('Edit ' . $user->name, route('administration.user.edit', $user->id));
});

Breadcrumbs::for('administration.user.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('administration.user.index');
    $trail->push($user->name, route('administration.user.show', $user->id));
});

Breadcrumbs::for('administration.role.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Role', route('administration.role.index'));
});

Breadcrumbs::for('administration.role.create', function (BreadcrumbTrail $trail) {
    $trail->parent('administration.role.index');
    $trail->push('Create', route('administration.role.create'));
});

Breadcrumbs::for('administration.role.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('administration.role.index');
    $trail->push('Edit ' . $role->name, route('administration.role.edit', $role->id));
});

Breadcrumbs::for('administration.role.show', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('administration.role.index');
    $trail->push($role->name, route('administration.role.show', $role->id));
});
