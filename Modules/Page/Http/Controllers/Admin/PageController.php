<?php

namespace Modules\Page\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Page\Entities\Page;
use Modules\Page\Entities\PageTranslation;
use Modules\Page\Http\Requests\PageUpdateRequest;

class PageController extends Controller
{


    public function index()
    {
        $pages = Page::select(['slug', 'id'])
            ->with(['translations' => fn ($query) => $query->select(['page_id', 'title'])])
            ->get()
            ->map(function ($page) {
                $page->title = $page->translations->first()->title;
                return $page;
            });
        return Inertia::render("Pages/Index", [
            'pages' => $pages,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Page $page)
    {
        $page->load('allTranslations');
        $page->translations = $page->allTranslations->keyBy('locale');

        return Inertia::render('Pages/Edit', [
            'page' => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
        $formattedPages = [];
        foreach ($request->only(['ar', 'en']) as $locale => $value) {
            $formattedPages[] = [
                'content' => $value['content'],
                'locale'     => $locale,
                'page_id'   => $page->id,
                'title' => '',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }
        PageTranslation::upsert($formattedPages, ['page_id', 'locale'], ['content']);

        return \success_update('');
    }
}