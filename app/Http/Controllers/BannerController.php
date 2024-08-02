<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Banner;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Image;
use App\Models\PageDetail;
use App\Models\Category;
use App\Models\CategoryGallery;

class BannerController extends Controller {

    public function index() {
        $banners = Banner::orderBy('active', 'desc')->orderBy('sort_order', 'asc')->get();
        return view('admin.banner.index', compact('banners'));
    }

    public function bannar_ajax_upload(Request $request) {


//        if (Gate::denies('trending-products.index', 'update')) {
//            abort(403);
//        }
        $Image_Id = request()->Image_Id;
        $id = explode('-', $Image_Id);
        $folderPath = public_path('uploads/' . $request->folder);
        $assets = url('uploads/' . $request->folder);
        $myName = '';
        if (isset($request->file_name)) {
            $myName = $request->file_name;
        }

        $imageParts = explode(";base64,", $request->image);
        $imageTypeAux = explode("image/", $imageParts[0]);
        $imageType = $imageTypeAux[1];
        $image_base64 = base64_decode($imageParts[1]);
        $uniqueId = uniqid();
        $fileName = $myName . $uniqueId . '.png';
        $file = $folderPath . '/' . $fileName;
        $p = $assets . '/' . $fileName;
        file_put_contents($file, $image_base64);
        if ($request->Image_src === 'large_image') {
            Banner::where('id', $id[1])->update(['large_image' => $fileName]);
        } else if ($request->Image_src === 'mobile_image') {
            Banner::where('id', $id[1])->update(['mobile_image' => $fileName]);
        } else {
            Banner::where('id', $id[1])->update(['mobile_secondary_image' => $fileName]);
        }
        return response()->json(['success' => 'success', 'file' => $fileName, 'path' => $p]);
    }

    public function store(Request $request) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        $data = $this->validatedBanner();
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $sort_order = Banner::max('sort_order');
            $sort_order = $sort_order + 1;

            $active = 1;

            $res = $this->resizeImagePost($request);
//            dd($res);

            $banner = Banner::create([
                        'active' => $active,
                        'image' => $res,
                        'sort_order' => $sort_order,
            ]);

//            $description = $user->displayName() . ' has added a new banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
            $outcome = 'New banner has been added successfully.';
            return redirect()->back()->with('outcome', $outcome);
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function sortData() {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        if (request()->all()) {
            if (request()->table == 'banners') {

                $data = request()->data;
                foreach ($data as $key => $cat) {
                    $entity = Banner::where('id', $cat)->update(['sort_order' => $key + 1]);
                }
            }
            if (request()->table == 'page_details') {
                $data = request()->data;
                foreach ($data as $key => $cat) {
                    $entity = PageDetail::where('id', $cat)->update(['sort_order' => $key + 1]);
                }
            }
            if (request()->table == 'gallery') {
                $data = request()->data;
                foreach ($data as $key => $cat) {
                    $entity = CategoryGallery::where('id', $cat)->update(['sort_order' => $key + 1]);
                }
            }
        }
        return ['status' => 1, 'message' => 'ordering changed successfully'];
    }

    public function changeStatus($table, $id, $status) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        $outcome = '';
        try {
            DB::beginTransaction();
            $status = (int) $status;
            if ($status == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $blockUnblockText = $status == 1 ? "unblocked" : "blocked";

            if ($table == "banners") {
                $updateBanner = Banner::where('id', $id)->update(['active' => $status]);
                $outcome = 'Banner ' . $blockUnblockText . " successfully.";
            }
            if ($table == "pages") {
                $updateBanner = Page::where('id', $id)->update(['active' => $status]);
                $outcome = 'Page ' . $blockUnblockText . " successfully.";
            }
            if ($table == "page_details") {
                $updateBanner = PageDetail::where('id', $id)->update(['active' => $status]);
                $outcome = 'Section ' . $blockUnblockText . " successfully.";
            }
            if ($table == "categories") {
                $updateBanner = Category::where('id', $id)->update(['active' => $status]);
                $outcome = 'Category ' . $blockUnblockText . " successfully.";
            }
            if ($table == "gallery") {
                $updateBanner = CategoryGallery::where('id', $id)->update(['active' => $status]);
                $outcome = 'Image ' . $blockUnblockText . " successfully.";
            }

//            $user = Auth::user();
//            $description = 'Banner ' . $blockUnblockText . ' by ' . $user->displayName() . '.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            $outcome = $e->getMessage();
        }

        return redirect()->back()->with('outcome', $outcome);
    }

    public function destroy(Banner $hierarchy, $id) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
//        dd('kjkh');
        $outcome = '';
        try {
            DB::beginTransaction();
            Banner::where('id', $id)->delete();
            $outcome = "Banner deleted successfully.";

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

    private function validatedBanner() {

        $data = request()->validate([
            'image' => ['required'],
        ]);
        return $data;
    }

    public function resizeImagePost(Request $request) {
        $image = $request->file('image');

        $input['imagename'] = time() . '.' . $image->extension();

//        $destinationPath = public_path('/images/thumbnails');

//        $img = Image::make($image->path());
//        $img->resize(1000, 1000, function ($constraint) {
//
//            $constraint->aspectRatio();
//        })->save($destinationPath . '/' . $input['imagename']);

        /*
         * Large Image
         */

        $destinationPath = public_path('/images/thumbnails');
//
        $image->move($destinationPath, $input['imagename']);

        return $input['imagename'];
    }

    public function ckeditorUpload(Request $request) {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images/ck-editor'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/ck-editor/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

}
