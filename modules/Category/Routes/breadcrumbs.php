<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard.index');
    $trail->push('Category', route('category.index'));
});

Breadcrumbs::for('category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('category.index');
    $trail->push('Create', route('category.create'));
});

Breadcrumbs::for('category.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category.index');
    $trail->push('Edit ' . $category->name, route('category.edit', $category->id));
});

Breadcrumbs::for('category.show', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('category.index');
    $trail->push($category->name, route('category.show', $category->id));
});
