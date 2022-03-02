<?php

namespace CleanCode\Contact\Infrastructure\Controllers\Web;

use App\Http\Controllers\Controller;
use CleanCode\Contact\Domain\Contact as ContactDomain;
use Illuminate\Http\Request;
use CleanCode\Contact\Application\Create;
use Illuminate\Support\Facades\Validator;
use function response;

class Contact extends Controller
{
    public function index()
    {
        return view('contact.create');
    }
}
