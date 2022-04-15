<?php

use App\Http\Controllers\NotificationsController;
use App\Models\User;
use App\Mail\TopicCreated;
use Illuminate\Support\Facades\Route;
use App\Services\Notifications\Notification;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     $notification = resolve(Notification::class);
//     $notification->sendSms(User::find(1), 'new TopicCreated');

// });

Route::view('/', 'home');

Route::get('/notifications/send-email', [NotificationsController::class, 'email'])->name('notifications.form.email');
Route::post('/notifications/send-email', [NotificationsController::class, 'sendEmail'])->name('notifications.send.email');