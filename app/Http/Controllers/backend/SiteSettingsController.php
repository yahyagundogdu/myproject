<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\SitemapGenerator;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.site-settings.index');
    }


    public function mapGenerator()
    {
        $test=Artisan::call('sitemap:generate');
        return back()->withInfo('Sitemap Başarıyla Oluşturuldu');
        // $generator=SitemapGenerator::create('https://uzmdrsemrayavuz.com')->writeToFile('public/sitemap.xml');
        // return $generator;
    }

    function cacheClear()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return back();
    }
}
