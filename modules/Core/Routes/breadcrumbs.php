<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('edit', function (BreadcrumbTrail $trail) {
    $trail->push('Edit', '');
});
