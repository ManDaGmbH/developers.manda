<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use PDF;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\PrintFile;
use Illuminate\Support\Facades\File;

class PagesController extends Controller {

    //

    public function dashboard() {
        return view('pages/dashboard');
    }

    public function prints() {
        $images = DB::table('print_files')->get();
//dd($records);
//        $oMerger = PDFMerger::init();
//
//        $oMerger->addPDF(public_path('print/download.pdf'), 'all');
//        $oMerger->addPDF(public_path('print/my.pdf'), 'all');
//        $oMerger->merge();
//        $oMerger->save('public/print/merged_result.pdf');


        return view('pages/prints', compact('images'));
    }

    public function index($id = null) {
        if ($id) {
            $page = Page::find($id);
            return view('pages/edit', compact('page'));
        }
        $banners = Page::paginate(10);
        return view('pages/index', compact('banners'));
    }

    public function pageDetails($pageId) {
        $banners = PageDetail::orderBy('sort_order')->where('page_id', $pageId)->paginate(10);
        return view('page_details/index', compact('banners', 'pageId'));
    }

    public function store(Request $request) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
//        dd(request()->all());
        $data = request()->validate([
            'page.title' => ['required'],
            'page.slug' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $active = 1;
            $page = $request->page;
            $page['active'] = $active;
            if ($request->id) {

                $banner = Page::find($request->id)->update($page);
                $outcome = 'Page has been Updated successfully.';
            } else {
                $banner = Page::create($page);
                $outcome = 'New Page has been added successfully.';
            }

//            $description = $user->displayName() . ' has added a new banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
            return redirect('backend/pages')->with('outcome', $outcome);
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function pageDetailCreate($pageId) {
        $page = new Page;

        return view('page_details/create', compact('pageId', 'page'));
    }

    public function pageDetailEdit($pageId) {
        $page = PageDetail::find($pageId);
        return view('page_details/edit', compact('pageId', 'page'));
    }

    public function pageDetailStore($pageId, Request $request) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
//        dd(request()->all());
        $data = request()->validate([
            'title' => ['required'],
            'section' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $sort_order = PageDetail::where('page_id', $pageId)->max('sort_order');
            $sort_order = $sort_order + 1;

            $active = 1;

            $banner = PageDetail::create([
                        'page_id' => $pageId,
                        'title' => $request->title,
                        'section' => $request->section,
                        'active' => $active,
                        'sort_order' => $sort_order,
            ]);

//            $description = $user->displayName() . ' has added a new banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
            $outcome = 'New section has been added successfully.';
            return redirect()->route('admin.page.details', $pageId)->with('outcome', $outcome);
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function pageDetailUpdate($pageId, Request $request) {
//        dd($pageId);
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
//        dd(request()->all());
        $data = request()->validate([
            'title' => ['required'],
            'section' => ['required'],
        ]);
//        dd($request->all());
        try {
            DB::beginTransaction();
            $user = Auth::user();



            $banner = PageDetail::find($pageId);
            $red = $banner->page_id;
            $banner->update([
                'title' => $request->title,
                'section' => $request->section,
            ]);

//            $description = $user->displayName() . ' has added a new banner.';
//            $user->auditTrails()->create(['description' => $description, 'menu_id' => 7]);
            DB::commit();
            $outcome = 'Section has been updated successfully.';
            return redirect()->route('admin.page.details', $red)->with('outcome', $outcome);
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function destroy($id) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        $outcome = '';
        try {
            DB::beginTransaction();
            $page = Page::find($id);
//            $page->pageDetails->delete();
            $page->delete();
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

    public function pageDetailDestroy($id) {
//        if (Gate::denies('banner.index', 'update')) {
//            abort(403);
//        }
        $outcome = '';
        try {
            DB::beginTransaction();
            $page = PageDetail::find($id);
//            $page->pageDetails->delete();
            $page->delete();
            $outcome = "Section deleted successfully.";

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

    public function ContactsDestroy($id) {
        $outcome = '';
        try {
            DB::beginTransaction();
            $page = \App\Models\Contact::find($id);
//            $page->pageDetails->delete();
            $page->delete();
            $outcome = "Contact message deleted successfully.";

            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }

        return redirect()->back()->with('outcome', $outcome);
    }

    public function contacts() {

        $contacts = \App\Models\Contact::orderBy('id', 'desc')->paginate(10);

        return view('pages/contacts', compact('contacts'));
    }

    public function uploadFile(Request $request) {
//        dd($request->file('fileUpload'));
//        $request->validate([
//            'fileUpload' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
//        ]);
        // Handle the file upload
        if ($request->file('fileUpload')) {
            $file = $request->file('fileUpload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
//            dd($filePath);
            DB::table('print_files')->insert([
                'name' => $filePath,
            ]);

            return back()->with('success1', 'File uploaded successfully.')->with('file', $fileName);
        }

        return back()->withErrors(['fileUpload' => 'File upload failed.']);
    }

    public function convertPDF() {
        $images = DB::table('print_files')->get();
        $divideFiles = array('images' => [], 'pdf' => []);
        foreach ($images as $image):
            $extension = pathinfo($image->name, PATHINFO_EXTENSION);
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $divideFiles['images'][] = 'storage/' . $image->name;
            } elseif ($extension === 'pdf') {
                $divideFiles['pdf'][] = 'storage/' . $image->name;
            } else {
                // File is neither an image nor a PDF
            }
        endforeach;

        $pdf1 = PDF::loadView('pdf.document', $divideFiles);
        $pdf1Path = public_path('/storage/uploads/first_document.pdf');
        $pdf1->save($pdf1Path);


        //Merging Code starts here
        $pdf_list = $divideFiles['pdf'];


        $oMerger = PDFMerger::init();
        $oMerger->addPDF($pdf1Path, 'all');
        foreach ($pdf_list as $pdf):
            $oMerger->addPDF(public_path($pdf), 'all');
        endforeach;
        $oMerger->merge();
        $oMerger->save(public_path('/storage/uploads/first_document.pdf'));

        Session::flash('success', 'PDFs merged and saved successfully.' . ' <a href="' . asset('storage/uploads/first_document.pdf') . '" download="">Download PDF</a>');
        return redirect()->back();
    }

    public function clearPDF() {
        $printFiles = PrintFile::all();
        foreach ($printFiles as $printFile) {
            if (file_exists(public_path('storage/' . $printFile->name))) {
                unlink(public_path('storage/' . $printFile->name));
            }

            // Delete the record
            $printFile->delete();
        }
        Session::flash('success1', 'All data have been cleared and the related files are deleted.');
        return redirect()->back();
    }

    private function findFileByName($directory, $name) {
        // Scan the directory for files
        $files = File::allFiles($directory);
//        dd($files);
        // Iterate over the files to find one that matches the base name
        $allfiles = [];
        foreach ($files as $file) {
            if (str_starts_with(pathinfo($file, PATHINFO_FILENAME), $name)) {
//                return $file;
                $allfiles[] = $file;
            }
        }

        return $allfiles;
    }

    public function convertPDF2($randNumber) {
        $divideFiles = array('images' => [], 'pdf' => []);
        $decodeRandNumber = base64_decode($randNumber);
        for ($i = 1; $i < 10; $i++):
            $randNumber = $decodeRandNumber . '-' . $i;
            $directory = storage_path('app/public/uploads');
            $file = $this->findFileByName($directory, $randNumber);
//            dump($randNumber);
            if ($file) {
                $extension = File::extension($file);
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $divideFiles['images'][] = 'storage/uploads/' . $randNumber . '.' . $extension;
                } elseif ($extension === 'pdf') {
                    $divideFiles['pdf'][] = 'storage/uploads/' . $randNumber . '.' . $extension;
                } else {
                    // File is neither an image nor a PDF
                }
            } else {
                break;
            }
        endfor;

        $pdf1 = PDF::loadView('pdf.document', $divideFiles);
        $pdf1Path = public_path('/storage/uploads/first_' . $randNumber . '.pdf');

        $pdf1->save($pdf1Path);

        //Merging Code starts here
        $pdf_list = $divideFiles['pdf'];


        $oMerger = PDFMerger::init();
        $oMerger->addPDF($pdf1Path, 'all');
        foreach ($pdf_list as $pdf):
//            dd($pdf);
            $oMerger->addPDF(public_path($pdf), 'all');
        endforeach;
        $oMerger->merge();
        $oMerger->save(public_path('/storage/uploads/first_' . $randNumber . '.pdf'));

        Session::flash('success', 'PDFs merged and saved successfully. <a href="' . asset('storage/uploads/first_' . $randNumber . '.pdf') . '" download="">Download PDF</a>');
        return redirect()->back()->with('downoad_file', $randNumber);
    }

    public function sendResponse(array $data = [], int $status = 200, string $message = '', array $headers = []) {
        // Define the structure of the response
        $response = [
            'success' => $status >= 200 && $status < 300, // Success if status is 2xx
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
//        dd($response);

        // Return the JSON response
        return response()->json($response, $status, $headers);
    }

    public function apiStopPrinting() {

        $randNumber = request()->api_token;
        $divideFiles = array('images' => [], 'pdf' => []);
        $decodeRandNumber = $randNumber;

        $directory = storage_path('app/public/uploads');
        $files = $this->findFileByName($directory, $randNumber);
        if (empty($files)) {
            return $this->sendResponse(['pdf' => ''], 200, 'No data Found.');
        }

        foreach ($files as $file):
//             dd();
            $fileName = File::name($file);
//            dump($randNumber);
            if ($file) {
                $extension = File::extension($file);
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $divideFiles['images'][] = 'storage/uploads/' . $fileName . '.' . $extension;
                } elseif ($extension === 'pdf') {
                    $divideFiles['pdf'][] = 'storage/uploads/' . $fileName . '.' . $extension;
                } else {
                    // File is neither an image nor a PDF
                }
            } else {
                break;
            }
        endforeach;
//        dd($divideFiles);
        $pdf1 = PDF::loadView('pdf.document', $divideFiles);
        $pdf1Path = public_path('/storage/uploads/first_' . $randNumber . '.pdf');

        $pdf1->save($pdf1Path);

        //Merging Code starts here
        $pdf_list = $divideFiles['pdf'];


        $oMerger = PDFMerger::init();
        $oMerger->addPDF($pdf1Path, 'all');
        foreach ($pdf_list as $pdf):
//            dd($pdf);
            $oMerger->addPDF(public_path($pdf), 'all');
        endforeach;
        $oMerger->merge();
        $oMerger->save(public_path('/storage/uploads/first_' . $randNumber . '.pdf'));

        $pdfPath = asset('storage/uploads/first_' . $randNumber . '.pdf');

        $data = [
            'pdf' => $pdfPath
        ];

        //delete all saved files

        $this->deleteFilesFromFolder($files);

        // Return the response with the example data
        return $this->sendResponse($data, 200, 'PDFs merged and saved successfully.');
    }

    public function deleteFilesFromFolder($files) {
        foreach ($files as $file):
            File::delete($file);
        endforeach;
    }

}
