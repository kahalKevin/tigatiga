<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AboutUs;
use App\Model\PrivacyPolicy;
use App\Model\TermOfUse;

class PageController extends Controller
{
    public function index($type)
    {
        switch ($type) {
            case 'privacy':
                $content = PrivacyPolicy::first()->_content ?? '';
                break;
            case 'term':
                $content = TermOfUse::first()->_content ?? '';
                break;
            case 'about':
                $content = AboutUs::first()->_content ?? '';
                break;
            default:
                $content = "";
                break;
        }

        return view('pages.index', compact('content'));
    }
}
