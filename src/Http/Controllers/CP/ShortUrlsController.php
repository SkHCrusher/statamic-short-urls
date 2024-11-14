<?php

namespace HallowTech\ShortUrls\Http\Controllers\CP;

use AshAllenDesign\ShortURL\Classes\Builder;
use AshAllenDesign\ShortURL\Models\ShortURL;
use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;

class ShortUrlsController extends CpController
{
    public function index(Request $request)
    {
        $shortUrls = ShortURL::orderBy('activated_at', 'DESC')->get();

        return view('short-urls::index', [
            'shortUrls' => $shortUrls,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'destination-url' => 'required|url',
        ]);

        $shortURLObject = app(Builder::class)->destinationUrl($validated['destination-url'])->make();
        $shortURL = $shortURLObject->default_short_url;

        return redirect(cp_route('utilities.short-urls'))->with('success', 'Short URL created.');
    }
}
