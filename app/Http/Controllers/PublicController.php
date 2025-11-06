<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\PublicContent;

class PublicController extends Controller
{
    public function funds()
    {
        $content = PublicContent::where('name', '=', 'funds')->get()->first();

        // dd($content);
        return view('public.funds', compact('content'));
    }

    public function fundDetail($id)
    {
        $fund = Fund::where('id', $id)->with(['fundClasses' => function ($query) {
            $query->where('active', 1)->orderBy('sort_order');
        }, 'riskLevel'])->get()->first();
        $content = PublicContent::where('name', '=', 'funds-disclaimer')->get()->first();

        // dd($fund);
        return view('public.fund_detail', compact('fund', 'content'));
    }

    public function legal()
    {
        $title = 'Legal and Proxy';
        $content = PublicContent::where('name', '=', 'legal')->get()->first();

        return view('public.blank', compact('content', 'title'));
    }

    public function terms()
    {
        $title = 'Terms and Conditions';
        $content = PublicContent::where('name', '=', 'terms')->get()->first();

        return view('public.blank', compact('content', 'title'));
    }

    public function privacy()
    {
        $title = 'Privacy Policy';
        $content = PublicContent::where('name', '=', 'privacy')->get()->first();

        return view('public.blank', compact('content', 'title'));
    }
}
