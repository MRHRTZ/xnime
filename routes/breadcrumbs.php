<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('beranda', function (BreadcrumbTrail $trail) {
    $trail->push('Beranda', route('beranda'));
});

Breadcrumbs::for('search', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Search Results', route('search'));
});

Breadcrumbs::for('schedule', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Jadwal Rilis', route('schedule'));
});

Breadcrumbs::for('bookmark', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Bookmark', route('bookmark'));
});

Breadcrumbs::for('anime', function (BreadcrumbTrail $trail) {
    $trail->parent('beranda');
    $trail->push('Anime', route('anime'));
});

Breadcrumbs::for('detail-anime', function (BreadcrumbTrail $trail, $anime) {
    $trail->parent('anime');
    $trail->push($anime->title, route('detail-anime', ['id'=>$anime->id]));
});

Breadcrumbs::for('episodes', function (BreadcrumbTrail $trail, $anime, $episode_id) {
    $trail->parent('detail-anime', $anime);
    $trail->push("Watch", route('episodes', ['anime_id'=>$anime->id, 'episode_id'=>$episode_id]));
});