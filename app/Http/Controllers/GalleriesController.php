<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GalleriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories() {
        $banners = Category::paginate(10);
        return view('admin/categories/index', compact('banners'));
    }

    public function index($cId) {
        $banners = CategoryGallery::orderBy('sort_order')->where('category_id', $cId)->paginate(10);
        return view('admin/galleries/index', compact('banners', 'cId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($cId, Request $request) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        $data = request()->validate([
            'image' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $sort_order = CategoryGallery::where('category_id', $cId)->max('sort_order');
            $sort_order = $sort_order + 1;
//dd($request->all());
            $active = 1;
            $res = app('App\Http\Controllers\BannerController')->resizeImagePost($request);
            $banner = CategoryGallery::create([
                        'category_id' => $cId,
                        'active' => $active,
                        'image' => $res,
                        'description' => $request->description,
                        'sort_order' => $sort_order,
            ]);

//            $description = $user->displayName() . ' has added a new banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
            $outcome = 'New Image has been added successfully.';
            return redirect()->back()->with('outcome', $outcome);
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function categoriesStore(Request $request) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        $data = request()->validate([
            'category.title' => ['required'],
            'category.slug' => ['required'],
            'image' => ['required'],
            'category.description' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $active = 1;
            $page = $request->category;
            $page['active'] = $active;
//            dd($request->all());
            $res = app('App\Http\Controllers\BannerController')->resizeImagePost($request);

            $page['image'] = $res;

//            dd($page);
            $banner = Category::create($page);

//            $description = $user->displayName() . ' has added a new banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
            $outcome = 'New Category has been added successfully.';
            return redirect()->route('admin.categories.index')->with('outcome', $outcome);
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function categoriesUpdate(Request $request, $id) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        $data = request()->validate([
            'category.title' => ['required'],
            'category.slug' => ['required'],
            'category.description' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $active = 1;
            $page = $request->category;
            $page['active'] = $active;
//            dd($request->all());
            if ($request->hasFile('image')) {
                $res = app('App\Http\Controllers\BannerController')->resizeImagePost($request);
                $page['image'] = $res;
            }

            $banner = Category::find($id)->update($page);

//            $description = $user->displayName() . ' has added a new banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
            $outcome = 'New Category has been added successfully.';
            return redirect()->route('admin.categories.index')->with('outcome', $outcome);
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoriesCreate() {
        $category = new Category;
        return view('admin.categories.create', compact('category'));
    }

    public function categoriesEdit($id) {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('id', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $outcome = '';
        try {
            DB::beginTransaction();
            CategoryGallery::destroy($id);
            $outcome = "Image deleted successfully.";

            // save audit
//            $user = Auth::user();
//            $description = $user->displayName() . ' has deleted Banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->back()->with('outcome', $outcome);
    }

    public function destroyCategory($id) {
        $outcome = '';
        try {
            DB::beginTransaction();

            Category::destroy($id);
            $outcome = "Image deleted successfully.";


            // save audit
//            $user = Auth::user();
//            $description = $user->displayName() . ' has deleted Banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->back()->with('outcome', $outcome);
    }

}
