<?php

use Illuminate\Support\Facades\Route;


use Modules\Chatbot\Controllers\ChatbotController;

Route::post('/chat', [ChatbotController::class, 'chat']);
