<!DOCTYPE html>

<html>

<head>
    <title>Print your data</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <style>
        * {
            font-family: Arial;
        }
        p.inline {
            display: inline-block;
        }
        span { 
            font-size: 13px;
        }
        .parent { 
            position: relative;
            display: inline-block;
            padding: 3px;
        }
        .child { 
            position: relative;
            display: inline-block;
            margin-left: 4px;
            margin-right: 4px;
            padding: 5px;
            box-sizing: content-box;
            width: 100%;
        }
        .print {
            margin-top: 10px;
            margin-bottom: 10px;
            background-color: navy;
            color: white;
        }
        .print:hover {
            color: white;
            background-color: black;
        }
        #wrapper {
            max-width: 800px;
            margin: auto;
        }
    </style>

    <style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 1mm;  /* this affects the margin in the printer settings */

        }
        .parent { 
            position: relative;
            display: inline-block;
            padding: 3px;
        }
        .child { 
            position: relative;
            display: inline-block;
            margin-left: 4px;
            margin-right: 4px;
            padding: 5px;
            box-sizing: content-box;
            width: 100%;
        }
        .print {
            display: none;
        }
        #wrapper {
            max-width: 780px;
            margin: auto;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div class="col text-center">
            <button onclick="window.print();" class="print btn btn-lg">Print your data</button>
        </div>
        <div style="margin: 1%" class="barcode-width">

                <?php
                require 'vendor/autoload.php';
                    
                    $row = 1;
                    if (($csvfile = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
                        while (($csvdata = fgetcsv($csvfile, 1000, ",")) !== FALSE) {

                            $colcount = count($csvdata);
                            
                            //Skip the CSV first line, start read from second line
                            if($row == 1) {

                                $row++; continue; 
                            }

                            if($colcount!=5) {
                                $error = 'Column count incorrect';
                            } else {

                                /*$product = $csvdata[0];
                                $product_id = $csvdata[1];
                                $rate = $csvdata[2];
                                $description = $csvdata[3];
                                $image = $csvdata[4];
                                $imageData = base64_encode(file_get_contents($image));

                                    echo '<div class="wrapper">';
                                    echo '<div class="a"><img src="data:image;base64,'.$imageData.'" width="50"/>
                                          <div><b>Item: '.$product.'</b></div>
                                          <div><svg id="barcode"><script>JsBarcode("#barcode", "'.$product_id.'",{
                                          format: "code128",width: 1,height: 35,fontOptions: "bold",marginRight:30});</script></svg></div><span><b>Price: '.$rate.' </b></span><div><span><b>Desc: </b>'.$description.'</span></div></p></span>
                                          </div></div>';
                                */

                                $imageData = base64_encode(file_get_contents($csvdata[4]));
                                $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                                    echo '<div class="parent">
                                              <div class="child">
                                                  <img src="data:image;base64,'.$imageData.'" width="50"/>
                                                  <div>
                                                    <b>Item: '.$csvdata[0].'</b>
                                                  </div>
                                                  <div>
                                                    <img src="data:image/png;base64,' . base64_encode($generator->getBarcode("$csvdata[1]", $generator::TYPE_CODE_128)) . '"/>
                                                    <div>
                                                        <b>'.$csvdata[1].'</b>
                                                    </div>
                                                  </div>
                                                    <span><b>Price: '.$csvdata[2].'</b></span>
                                                  <div>
                                                    <span><b>Desc: </b>'.$csvdata[3].'</span>
                                                  </div>
                                              </div>
                                          </div>';
                            }
                        }
                        fclose($csvfile);
                    }
                ?>
        </div>
    </div>
</body>
</html>