<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\File;
use finfo;

class FrontendController extends Controller {

    public function index($type = 'home') {
        $page = Page::with('pageDetails')->whereSlug($type)->first();
        $categories = $sliders = [];
        if ($type == "home") {
            $categories = Category::where('active', 1)->get();
            $sliders = Banner::where('active', 1)->orderBy('sort_order')->get();
        }

        return view('frontend.index', compact('sliders', 'page', 'type', 'categories'));
    }

    public function gallery($slug) {
        $gallery = Category::with('images')->whereSlug($slug)->first();
        return view('frontend.gallery', compact('gallery'));
    }

    public function contact() {
        return view('frontend.contact');
    }

    public function sendMessage(Request $request) {
        //Get data form and send mail
        if (isset($_POST['name']) and isset($_POST['mail']) and isset($_POST['messageForm'])) {
            $name = $_POST['name'];
            $mail = $_POST['mail'];
            $subjectForm = $_POST['subjectForm'];
            $messageForm = $_POST['messageForm'];

            if ($name == '') {
                echo json_encode(array('info' => 'error', 'msg' => "Please enter your name."));
                exit();
            } else if ($mail == '' or $this->check_email($mail) == false) {
                echo json_encode(array('info' => 'error', 'msg' => "Please enter valid e-mail."));
                exit();
            } else if ($messageForm == '') {
                echo json_encode(array('info' => 'error', 'msg' => "Please enter your message."));
                exit();
            } else {
//                $to = env('MAIL_FROM_ADDRESS');
                $to = "hallo@manda.gmbh";
                $data = array();
                $data['name'] = $name;
                $data['email'] = $mail;
                $data['subject'] = $subjectForm;
                $data['message'] = $messageForm;
//                dd($data);
                Contact::create($data);

//dd($to);
                $mail = Mail::to($to)
                        ->send(new contactMail($_POST));
                if (Mail::failures()) {
                    echo json_encode(array('info' => 'error', 'msg' => "Your message hasn't been sent. Please try again."));
                } else {
                    echo json_encode(array('info' => 'success', 'msg' => "Your message has been sent. We will reply soon. Thank you!"));
                }
            }
        } else {
            echo json_encode(array('info' => 'error', 'msg' => __MESSAGE_EMPTY_FIELDS__));
        }
    }

    public function check_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    public function PrintNew() {
        $randNum = $this->generateRandomString();
//        dd();
        return view('pages.upload', compact('randNum'));
    }

    public function sendResponse(array $data = [], int $status = 200, string $message = '', array $headers = []) {
        // Define the structure of the response
        $response = [
            'success' => $status >= 200 && $status < 300, // Success if status is 2xx
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        // Return the JSON response
        return response()->json($response, $status, $headers);
    }

    public function apiStartPrinting() {
        $randNum = $this->generateRandomString();
        $data = [
            'api_token' => $randNum,
            'file_number' => 1,
        ];

        // Return the response with the example data
        return $this->sendResponse($data, 200, 'New ID Generated.');
    }

    public function fileDetails($file, $mannualName) {
        /*
         * New Code Starts
         */
        $base64String = $file;

        // Remove the part before the comma (if it exists) and decode the base64 string
        if (strpos($base64String, ',') !== false) {
            $base64String = explode(',', $base64String)[1];
        }
        $binaryData = base64_decode($base64String);

        // Use the Fileinfo extension to determine the file type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($binaryData);



        // Determine file extension based on the MIME type
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'application/pdf' => 'pdf',
                // Add more MIME types and extensions as needed
        ];

        $extension = isset($extensions[$mimeType]) ? $extensions[$mimeType] : 'unknown';

        // Handle the file (save to disk, process, etc.)
        // For example, save the file to storage/app/public
        $fileName = $mannualName . '.' . $extension;
        $filePath = public_path('storage/uploads/' . $fileName);
        file_put_contents($filePath, $binaryData);

        return [
            'file_name' => $fileName,
            'mime_type' => $mimeType,
            'extension' => $extension,
            'path' => $filePath,
        ];
    }

    public function apiUploadFiles(Request $request) {
        $files = $request->json();
//        dd($files);
        $fileNumber = 0;
        foreach ($files as $fn => $file):
            $mannualName = $request->api_token . '-' . $fn;
            $fileDetails = $this->fileDetails($file, $mannualName);
//            dump($fn);
            $fileNumber = $fn;
        endforeach;
//        exit;
        $fileNumber = $fileNumber + 1;
        $data = [
            'file_number' => $fileNumber,
        ];
        return $this->sendResponse($data, 200, 'File/Files Uploaded Successfully.');
    }

    public function upload(Request $request) {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Custom file name
//            $originalName = $file->getClientOriginalName();
            $mannualName = $request->mannual_name . '-' . $request->file_number;
            $extension = $file->getClientOriginalExtension();
            $customName = $mannualName . '.' . $extension;

            // Store the file with the custom name
            $path = $file->storeAs('uploads', $customName, 'public');

            return response()->json(['path' => $path], 200);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function generateRandomString($length = 20) {
        // Characters to include in the random string
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Generate the random string
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function amzDone() {
        return view('frontend.amz_done');
    }

}
