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
    $links = Link::orderBy('created_at', 'desc')->simplePaginate(4);
    return view('index', [
        'links' => $links,
        'lists' => LinkList::all()
    ]);
});

Route::get('/{slug}', function ($slug) {
    $list = LinkList::where('slug', $slug)->first();
    if (!$list) {
        abort(404);
    }
 
    return view('index', [
        'list' => $list,
        'links' => $list->links()->orderBy('created_at', 'desc')->simplePaginate(4),
        'lists' => LinkList::all()
    ]);
})->name('link-list');