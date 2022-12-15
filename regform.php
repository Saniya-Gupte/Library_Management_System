<?php
session_start();
$conn = mysqli_connect("localhost","root","","library");
if(!$conn){  
	echo "<script type='text/javascript'>alert('Database failed');</script>";
  	die('Could not connect: '.mysqli_connect_error());  
}
if (isset($_POST['register']))
{
$full_name=$_POST['full_name'];
$mob_number='91'.$_POST['mob_number'];
$reg_id=$_POST['reg_id'];
$book_name=$_POST['book_name'];
$issue_date=$_POST['issue_date'];
$due_date=$_POST['due_date'];

$finding = "SELECT fname FROM studentrecord WHERE date_of_return > GETDATE();";
$book1 = "SELECT book FROM studentrecord WHERE date_of_return > GETDATE();";
$type_message = "Dear $finding the date of return of your issued book $book1 has exceeded.Please return it at the earliest to the library.";
$phone = "SELECT mob FROM studentrecord WHERE date_of_return > GETDATE();";
// Account details
$apiKey = urlencode('NjQ1OTYzNWE3YTZhMzI2Yzc1NDk3MzM0Mzg0NTZhMzk=');
	
$numbers = array($phone);
$sender = urlencode('TXTLCL');
$message = rawurlencode($type_message);
$numbers = implode(',', $numbers);
$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
$ch = curl_init('https://api.textlocal.in/send/');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;

$sql = "INSERT INTO studentrecord (fname, mob, regno, book, date_of_issue, date_of_return) VALUES ('$full_name', '$mob_number', '$reg_id', '$book_name', '$issue_date', '$due_date');";
	if(mysqli_query($conn, $sql))
{  
	$message = "You have successfully issued a book";
}
else
{  
	$message = "Could not insert record"; 
}
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">



    <link rel="icon" href="Favicon.png">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title></title>
</head>
<script src="js/script.js"></script>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
        </ul>

    </div>
    </div>
</nav>

<main class="my-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form name="my-form" onsubmit="return validform()" action="regform.php" method="post">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="full_name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mob_number" class="col-md-4 col-form-label text-md-right">Mobile Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="mob_number" name="mob_number" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="reg_id" class="col-md-4 col-form-label text-md-right">Registration ID</label>
                                    <div class="col-md-6">
                                        <input type="text" id="reg_id" class="form-control" name="reg_id">
                                    </div>
                                </div>

                                

                                <div class="form-group row">
                                    <label for="book_name" class="col-md-4 col-form-label text-md-right">Book Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="book_name" class="form-control" name="book_name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="issue_date" class="col-md-4 col-form-label text-md-right">Issue Date</label>
                                    <div class="col-md-6">
                                        <input type="date" id="issue_date" class="form-control" name="issue_date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="due_date" class="col-md-4 col-form-label text-md-right">Due Date</label>
                                    <div class="col-md-6">
                                        <input type="date" id="due_date" class="form-control" name="due_date">
                                    </div>
                                </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="register" id="register">
                                        Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>