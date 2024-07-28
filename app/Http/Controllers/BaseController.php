<?php

namespace App\Http\Controllers;

use App\Services\Post\Service;

class BaseController extends Controller
{
public Service $service;

public function __construct(Service $service)
{
    $this->service = $service;
}
}
