<?php

namespace Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Dingo\Api\Routing\Helpers;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests, Helpers;
}
