<?php

use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\ContactUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('articles',[ArticlesController::class,'index']);
Route::get('articles/{article:slug}',[ArticlesController::class,'show']);

Route::get('projects',[ProjectsController::class,'index']);
Route::get('projects/{project:slug}',[ProjectsController::class,'show']);

Route::get('settings',[SettingsController::class,'index']);

Route::post('contact-us',[ContactUsController::class,'store']);