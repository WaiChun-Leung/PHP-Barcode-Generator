<html>
<head>
	<title>PHP Barcode Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	p.inline {
		display: inline-block;
	}
	span { 
		font-size: 13px;
	}
	.wrapper { 
    	position: relative;
    	display: inline-block; 
    }
	.a { 
		position: relative;
		display: inline-block;
		margin: 15px;
	}
</style>

<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 1mm;  /* this affects the margin in the printer settings */

    }
    .wrapper { 
    	position: relative;
    	display: inline-block;
    }
	.a { 
		position: relative;
		display: inline-block;
		margin: 15px;
	}
</style>
</head>
<body onload="window.print();">
	<div style="margin: 1%">
	
		<?php
		include 'barcode128.php';
		require 'vendor/autoload.php';

		if (($csvfile = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
			while (($csvdata = fgetcsv($csvfile, 1000, ",")) !== FALSE) {
				
				$colcount = count($csvdata);
				
				$product = $csvdata[0];
				$product_id = $csvdata[1];
				$rate = $csvdata[2];		
				$description = $csvdata[3];
				$image = $csvdata[4];
				$imageData = base64_encode(file_get_contents($image));

				$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

				for($i=0;$i<=$colcount($csvdata);$i++){
					echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
					echo '<div class="wrapper">';
					echo '<div class="a"><img src="data:image;base64,'.$imageData.'" width="50"/>
						  <div><b>Item: '.$product.'</b></div>'.bar128(stripcslashes($product_id)).'
						  <span><b>Price: '.$rate.' </b></span><div><span><b>Desc: </b>'.$description.'</span></div></p></span>
						  </div></div>';
				}
			}
			fclose($csvfile);
		}

		?>

	</div>
</body>
</html>