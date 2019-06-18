<?php

$lines = explode("\n", file_get_contents('quotes.txt'));

$line = $lines[mt_rand(0, count($lines) - 1)];

list($text, $author) = explode('|', $line);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Random Quote Generator</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <style type="text/css">
      body{
      background-position:relative;
    }
      * {
        font-size: 20pt;
        line-height: 2;
      }

      body {
        padding-top: 20%;
      }
    </style>
  </head>
  <body>
    <blockquote class="text-center">
      <p><?php echo $text; ?></p>
      <footer><?php echo $author; ?></footer>
    </blockquote>
<center>
<br>
<input type="submit" value="Next Quote" onClick="document.location.reload(true)">
<?php 
echo "<input type='button' value='Share Whatsapp' href='https://api.whatsapp.com/send?text=$text%0A$author'>";
?>
</br>
</center>
  </body>
</html>
