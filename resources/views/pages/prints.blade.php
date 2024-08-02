
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Print Doc</title>
        <style type="text/css">
            @media print {
                #print_sec {
                    background-color: white;
                    height: 100%;
                    width: 100%;
                    /*        position: fixed;*/
                    /*        top: 0;*/
                    /*        left: 0;*/
                    margin: 0;
                    padding: 15px;
                    font-size: 14px;
                    line-height: 18px;
                }
                @page { size: auto;  margin: 0mm; }
                .hide{
                    display: none;

                }
            }

            .my-img{
                padding:10px;
            }

            /* Custom alert styles */
            .alert {
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid transparent;
                border-radius: 4px;
            }

            .alert-success {
                color: #155724;
                background-color: #d4edda;
                border-color: #c3e6cb;
            }

        </style>
    </head>
    <body>
        <div class="container">
            @if(Session::has('success'))
            <div class="alert alert-success">
                <?= Session::get('success') ?>
            </div>
            @endif
            @if(Session::has('success1'))
            <div class="alert alert-success">
                {{ Session::get('success1') }} 
            </div>
            @endif

            <!-- Your page content here -->
            @yield('content')
        </div>


        <form action="<?= route('upload.file') ?>" method="post" enctype="multipart/form-data">
            <label for="fileUpload">Choose file:</label>
            @csrf
            <input type="file" id="fileUpload" name="fileUpload">
            <button type="submit">Submit</button>
        </form>
        <a  href="<?= route('clearPDF') ?>" onclick="return confirm('are you sure you want to clear the data?')" style="color:red;float:right;margin-right: 20px;">Clear</a>
        <a href="<?= route('convertPDF') ?>" style="float:right;margin-right: 20px">Convert to pdf</a>

        @foreach ($images as $image)
        <?php
        $extension = pathinfo($image->name, PATHINFO_EXTENSION);

        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            // File is an image
            ?>
            <div class="my-img">
                <img src="{{ asset('storage/'.$image->name) }}" alt="Image" style="width: 400px; height: auto;">
            </div>
            <?php
        } elseif ($extension === 'pdf') {
            ?>
            <div class="my-img">
                <embed src="{{ asset('storage/'.$image->name) }}" alt="PDF" style="width: 400px; height: auto;">
            </div>    
            <?php
        } else {
            // File is neither an image nor a PDF
            echo "File is neither an image nor a PDF.";
        }
        ?>



        @endforeach
<!--<input type="button" class="hide" onclick="PrintElem('print_sec')" id="print_button" value="Print all">-->
        <!--<div id="print_sec">
            
            
                <div style="text-align: center; ">
                        <img src="<?= asset('print') ?>/img1.jpg" width="500px">
                </div>
                <div style="text-align: center;">
        
                <img src="<?= asset('print') ?>/img2.jpg" width="500px">
                </div>
                <div style="text-align: center;">
                <img src="<?= asset('print') ?>/img3.jpg" width="500px">
                </div>
                <div style="text-align: center;">
                <img src="<?= asset('print') ?>/img4.jpg" width="500px">
                </div>
                <div style="text-align: center;">
                        <embed src="<?= asset('print') ?>/my.pdf" width="800px"  height="1000px" />
                </div>
        </div>-->
        <!--
        <script type="text/javascript">
                
        //	alert();
        function PrintElem(elem)
        {
            var mywindow21 = window.open('', 'PRINT', 'height=600,width=900');
        
            mywindow21.document.write('<html><head><style>div{padding: 50px;}  @page { size: auto;  margin: 0mm; }</style><title></title>');
            mywindow21.document.write('</head><body >');
            mywindow21.document.write(document.getElementById(elem).innerHTML);
            mywindow21.document.write('</body></html>');
        
          
            mywindow21.document.close(); // necessary for IE >= 10
            mywindow21.focus(); // necessary for IE >= 10*/
        
            mywindow21.print();
            mywindow21.close();
        
            return true;
        }
        printPdf = function (url) {
          var iframe = this._printIframe;
          if (!this._printIframe) {
            iframe = this._printIframe = document.createElement('iframe');
            document.body.appendChild(iframe);
        
            iframe.style.display = 'none';
            iframe.onload = function() {
              setTimeout(function() {
                iframe.focus();
                iframe.contentWindow.print();
              }, 1);
            };
          }
        
          iframe.src = url;
        }
        </script>-->

    </body>
</html>