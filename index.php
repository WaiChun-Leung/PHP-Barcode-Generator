<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Barcode Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div style="margin: 5%">
  	<h2 class="text-center">PHP BARCODE GENERATOR</h2>
	<hr>
  	<form class="form-horizontal" method="post" action="fetchdata.php" target="_blank" enctype='multipart/form-data'>
  	<div class="form-group">
      <label class="control-label col-sm-2" for="uploadfile">Upload File:</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="uploadfile" name="file" >
      </div>
    </div>
	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
	</form>
  </div>
</div>

</body>
</html>

