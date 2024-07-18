<?php

namespace App\Http\Controllers;

use App\Models\Post;

class ContactsController extends Controller
{
    public function index(): string
    {
        return view('contacts');
    }

}
