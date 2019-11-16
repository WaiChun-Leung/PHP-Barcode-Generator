<!DOCTYPE html>

<html>

<head>
	<title>Confirm your data</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
		<div style="margin: 5%">
		<h2 class="text-center">CONFIRM YOUR DATA</h2>
		<hr>
		<form class="form-horizontal" method="post" action="barcode1.php" target="_blank" enctype='multipart/form-data'>
                <?php
                    if (($csvfile = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
                        while (($csvdata = fgetcsv($csvfile, 1000, ",")) !== FALSE) {
                            $error='';
                            $colcount = count($csvdata);

                            if($colcount!=5) {
                                $error = 'Column count incorrect';
                            } else {
                                //check data types
                                if(!is_numeric($csvdata[2])) $error.='error';
                            }
                            switch($error) {
                                case "Column count incorrect":
                                    echo $error;
                                    break;
                                default:
                                    echo '<input type="text" class="form-control" name="csvdata0" value="'.$csvdata[0].'"></input>';
                                    echo '<input type="text" class="form-control" name="csvdata1" value="'.$csvdata[1].'"></input>';
                                    echo '<input type="text" class="form-control" name="csvdata2" value="'.$csvdata[2].'"></input>';
                                    echo '<input type="text" class="form-control" name="csvdata3" value="'.$csvdata[3].'"></input>';
                                    echo '<input type="text" class="form-control" name="csvdata4" value="'.$csvdata[4].'"></input>';
                            }
                        }
                        fclose($csvfile);
                    }
                ?>
			
			<div class="form-group">
				<p class="lead text-center">If you confirm your data is correct, then click "submit" button.</p>
			</div>

			<div class="form-group">        
				<div class="text-center">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</div>
		</form>
    </div>

</body>
</html>
