<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Fund;
use App\Models\News;
use App\Models\PublicContent;
use App\Models\Team;

class PublicController extends Controller
{
    public function home()
    {
        $content = PublicContent::where('name', 'like', 'home%')->get();

        return view('public.home', compact('content'));
    }

    public function about()
    {
        $team = Team::where('active', 1)->get();
        $content = PublicContent::where('name', 'like', 'about%')->get();

        // dd($team);
        return view('public.about', compact('team', 'content'));
    }

    public function funds()
    {
        $content = PublicContent::where('name', '=', 'funds')->get()->first();

        // dd($content);
        return view('public.funds', compact('content'));
    }

    public function advisors()
    {
        $content = PublicContent::where('name', 'like', 'advisors%')->get();
        $advisors = Advisor::where('active', 1)->get();

        return view('public.advisors', compact('content', 'advisors'));
    }

    public function invest()
    {
        $content = PublicContent::where('name', '=', 'invest')->get()->first();

        return view('public.invest', compact('content'));
    }

    public function news()
    {
        $content = PublicContent::where('name', '=', 'news')->get()->first();
        $news = News::where('active', 1)->orderBy('news_date', 'desc')->get();

        return view('public.news', compact('content', 'news'));
    }

    public function contact()
    {
        $advisors = Advisor::where('active', 1)->get();

        return view('public.contact', compact('advisors'));
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

    public function form()
    {
        $content = PublicContent::where('name', 'like', 'home%')->get();

        // dd($content);
        return view('public.form', compact('content'));
    }
}
