<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('/', function (BreadcrumbTrail $trail): void {
    $trail->push('Index', route('/'));
});

Breadcrumbs::for('verproductos', function (BreadcrumbTrail $trail): void {
    $trail->push('Index', route('verproductos'));
});
/*
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Users', route('users.index'));
});

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('index', route('dashboard'));
});
*/
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('/', 'verproductos', 'detalproducto', 'carro', 'buscar');
    $trail->push('index', route('dashboard'));
    });