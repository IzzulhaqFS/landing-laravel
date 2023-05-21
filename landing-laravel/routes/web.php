<?php

use App\Models\Link;
use Illuminate\Support\Facades\Route;
use App\Models\LinkList;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $links = Link::all()->sortDesc();
    return view('index', [
        'links' => $links,
        'lists' => LinkList::all()
    ]);
});
