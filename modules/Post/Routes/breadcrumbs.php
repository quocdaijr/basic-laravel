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

Breadcrumbs::for('post.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('post.index');
    $trail->push('Edit ' . $user->name, route('post.edit', $user->id));
});

Breadcrumbs::for('post.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('post.index');
    $trail->push($user->name, route('post.show', $user->id));
});
