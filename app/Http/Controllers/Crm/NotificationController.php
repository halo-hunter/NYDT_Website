<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Crm\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {

        echo Notification::where('assigned_to', auth()->id())->where('seen', 0)->count();

    }
}
