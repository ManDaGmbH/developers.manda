<!DOCTYPE html>
<html>
    <head>
        <title>Document</title>
        <style>
            body {
/*                margin: 0;*/
                padding: 0;
                height: 100vh; /* 100% of viewport height */
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .content {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
                box-sizing: border-box;
            }

            .centered-image {
                max-width: 100%;
                max-height: 100%;
                display: block;
            }

            @media print {
                body, .content {
                    height: 100vh; /* Ensure content fits within one page height */
                    margin: 0;
                    padding: 0;
                }

                .centered-image {
                    max-width: 100%;
                    max-height: 100vh;
                    margin: auto;
                }
            }

        </style>
    </head>
    <body>
        <!--<img src="<?= asset('images/1648819991.jpg') ?>" width="100%">-->
        @foreach($images as $image)
        <?php
        $imageData = base64_encode(file_get_contents(public_path($image)));
//        dd($imageData);
        $image = 'data:image/jpeg;base64,' . $imageData;
        ?>
        <div class="content">
            <img src="<?= $image ?>" class="centered-image">
        </div>
        <?php
//        dd('yes');
        ?>
        @endforeach
    </body>
</html>