<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AdminController extends Controller
{
    public  function index()
    {
        return view("admin.inc.index");
    }
    public  function adminCore()
    {
        return view("admin_core.content.test    ");
    }
}
