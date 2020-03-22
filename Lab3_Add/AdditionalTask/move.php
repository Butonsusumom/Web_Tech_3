<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->


    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/normalize.css" />
    <link rel="stylesheet" href="/css/contact.css">
</head>
<body link="white" vlink="white" alink="white">
<body>
<!-- Landing section -->

<header>
    <div class="title"></div>
    <ul>
        <li><a href="/AdditionalTask/index.php">HOME</a></li>
        <li><a href="/AdditionalTask/upload.php">ADD</a></li>
        <li><a class="active" href="#">MOVE</a></li>
        <li><a href="/AdditionalTask/delete.php">DELETE</a></li>
    </ul>
</header>
<section style="padding-top: 100px; padding-bottom: 90px;" class="about">
    <div class="about-header">
        <h1>Move</h1>
    </div>
    <div class="card">
        <form name="form"method="POST">
            <input type="text" name="full_filename" type="text" class="feedback-input" placeholder="Name Of File" />
            <input type="text" name="new_directory" type="text" class="feedback-input" placeholder="New Path" />
            <input type="submit" name="enter" value="SUBMIT" />
            <?php
            $str='';
            if (isset($_POST['enter'])) {
                $filename = isset($_POST['full_filename']) ? $_POST['full_filename'] : "";
                $dir = isset($_POST['new_directory']) ? $_POST['new_directory'] : "";

                if (file_exists($filename) && is_dir($dir)){
                    if (rename($filename, $dir.pathinfo($filename)['basename']))
                    {
                        $str="Success";
                    }
                } elseif (!file_exists($filename)) {
                    $str="File not found";
                } else {
                    $str="Invalid Path";
                }
            }
            ?>
            <br><br><br> <h3><?php echo $str ?></h3>
        </form>
    </div>
</section>


<footer>
    <p>&#169; 2020 <a href="https://www.instagram.com/orange_list/?hl=ru">KSENIA TSYBULKO</a></p>
</footer>
</body>
</html>