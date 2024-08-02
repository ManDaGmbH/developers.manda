<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dropzone Upload</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Dropzone CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
        <style>
            .dropzone {
                border: 2px dashed #007bff;
                border-radius: 5px;
                background: #f8f9fa;
                padding: 20px;
            }
            .dropzone .dz-message {
                color: #6c757d;
                font-weight: 500;
            }
            .dropzone .dz-preview .dz-remove {
                color: #dc3545;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Upload Your Files</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('print-new') }}" class="dropzone" id="my-dropzone" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?= $randNum ?>" name="mannual_name">
                                <input type="hidden" value="1" id="file_number" name="file_number">
                                @csrf
                            </form>
                            <div class="text-right pt-2">
                                <a href="<?= route('convert.to.pdf', base64_encode($randNum)) ?>" class="btn btn-success">Convert To PDF</a>
                                <a  href="<?= url('/print-new') ?>" onclick="return confirm('are you sure you want to clear the data?')" class="btn btn-danger">Clear Data</a>

                            </div>
                            @if(Session::has('success'))
                            <div class="alert alert-success mt-2">
                                <?= Session::get('success') ?>
                            </div>
                            @endif
                            <div id="upload-result" class="mt-3"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap JS and dependencies -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
        <!-- Dropzone JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
        <script>
// Disable Dropzone auto-discovery globally
                                    Dropzone.autoDiscover = false;

                                    $(document).ready(function () {
                                        // Check if Dropzone is already initialized on #my-dropzone
                                        if (!$("#my-dropzone").hasClass("dz-clickable")) {
                                            // Initialize Dropzone
                                            var myDropzone = new Dropzone("#my-dropzone", {
                                                paramName: "file", // The name that will be used to transfer the file
//            maxFilesize: 2, // MB
//            addRemoveLinks: true,
                                                dictDefaultMessage: "Drag & drop files here or click to upload",
                                                init: function () {
                                                    this.on("success", function (file, response) {
                                                        // Handle successful upload here
                                                        console.log("File successfully uploaded:", response);
                                                        var fileNumber = +$('#file_number').val();
                                                        $('#file_number').val(fileNumber + 1);
//                    alert(fileNumber);
//                    $('#upload-result').html('<div class="alert alert-success">File uploaded successfully! Path: ' + response.path + '</div>');
                                                    });
                                                    this.on("error", function (file, errorMessage) {
                                                        // Handle errors here
                                                        console.log("Error uploading file:", errorMessage);
//                    $('#upload-result').html('<div class="alert alert-danger">Error uploading file: ' + errorMessage + '</div>');
                                                    });
                                                }
                                            });
                                        } else {
                                            console.log("Dropzone already initialized on #my-dropzone");
                                        }
                                    });
        </script>
    </body>
</html>