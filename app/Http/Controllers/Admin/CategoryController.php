<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Constants\Resource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Post;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize(Resource::CATEGORY_INDEX);

        return view('admin.categories.index', [
            'categories' => Category::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize(Resource::CATEGORY_CREATE);

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->authorize(Resource::CATEGORY_CREATE);

        $data = $request->toArray();

        return redirect()->route('admin.categories.index', Category::create($data))
            ->with([
                'success' => __('categories.messages.created'),
            ])
            ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        $this->authorize(Resource::CATEGORY_UPDATE);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->toArray());

        return redirect()->route('admin.categories.index')
            ->with([
                'success' => __('categories.messages.updated'),
            ])
            ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize(Resource::CATEGORY_DELETE);

        if (Post::where('category_id', $category->category_id)->count()) {
            return redirect()->back()->withErrors(__('categories.messages.existing_posts'));
        }

        $category->delete();

        return redirect()->back()->with('success', __('categories.messages.deleted'));
    }
}
