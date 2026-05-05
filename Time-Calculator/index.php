<?php


$years = $months = $days = $hours = $minutes = $seconds = "";
$error = "";

function validateDateTime($date, $format = "Y-m-d\TH:i"){
  $d = DateTime::createFromFormat($format, $date);
  return $d && $d->format($format) === $date;
}

function getDiff($userDate){
  $current_Date = new DateTime();
  $userDateObj = new DateTime($userDate);
  $diff = $userDateObj->diff($current_Date);
  return $diff;
}


function isFutureDate($date){
  $now = new DateTime();
  $inputDate = new DateTime($date);
  return $inputDate > $now;
}


if($_SERVER["REQUEST_METHOD"] === "POST"){

  $userDate = $_POST["date"];
  if(validateDateTime($userDate)){
    if(isFutureDate($userDate)){
      $diff = getDiff($userDate);

      $years = $diff->y;
      $months = $diff->m;
      $days = $diff->d;
      $hours = $diff->h;
      $minutes = $diff->i;
      $seconds = $diff->s; 
    }else{
      $error = "Date is not in the feature!";
    }
  }else{
    $error = "This is not a correct date format!";
  }

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <title>How many days</title>
</head>

<body>


  <div class="card-container">
    <div class="title-container">
      <h1>How Many Time</h1>
    </div>
    <div class="time-container">
      <div class="time-section">
        <p class="time-title">Years</p>
        <p class="time-count"><?php echo sprintf("%02d", htmlspecialchars($years))  ?></p>
      </div>
      <div class="time-section">
        <p class="time-title">Months</p>
        <p class="time-count"> <?php echo sprintf("%02d", htmlspecialchars($months))  ?></p>
      </div>
      <div class="time-section">
        <p class="time-title">Days</p>
        <p class="time-count"><?php echo sprintf("%02d", htmlspecialchars($days))  ?></p>
      </div>
      <div class="time-section">
        <p class="time-title">Hours</p>
        <p class="time-count"><?php echo sprintf("%02d", htmlspecialchars($hours))  ?></p>
      </div>
      <div class="time-section">
        <p class="time-title">Minutes</p>
        <p class="time-count"><?php echo sprintf("%02d", htmlspecialchars($minutes))  ?></p>
      </div>
      <div class="time-section">
        <p class="time-title">Seconds</p>
        <p class="time-count"><?php echo sprintf("%02d", htmlspecialchars($seconds))  ?></p>
      </div>
    </div>

    <div class="form-container">
      <?php require_once("./src/Forms/form.php"); ?>
      <small class="err"><?php echo $error ?></small>
    </div>
  </div>
</body>

</html>