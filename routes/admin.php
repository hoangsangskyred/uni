<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\LoginController;
use App\Models\Article;
use App\Models\ArticleCrawlObserve;
use Illuminate\Support\Facades\Route;
use Spatie\Crawler\Crawler;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// crawl a website
Route::get('/articles/crawl', [ArticleController::class, 'showCrawlForm'])->name('articles.showCrawlForm');
Route::post('/articles/crawl', [ArticleController::class, 'crawl'])->name('articles.crawl');
Route::get('/users/{user}/verify', [UserController::class, 'sendActivationCode'])->name('users.verify');
Route::resources([
    'article-categories' => ArticleCategoryController::class,
    'articles' => ArticleController::class,
    'project-categories' => ProjectCategoryController::class,
    'projects' => ProjectController::class,
    'about-us' => AboutUsController::class,
    'team-members' => TeamMemberController::class,
    'services' => ServiceController::class,
    'settings' => SettingController::class,
    'users' => UserController::class,
    'customers' => CustomerController::class,
    'image-us' => AboutUsImageController::class,
]);
Route::get('/search',[CustomerController::class,'search'])->name('customers.search');
Route::post('/profile/reset-password', [ProfileController::class, 'resetPassword'])->name('profile.resetPassword');

Route::group(['prefix' => 'lfm'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
