

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
        <li><a class="active" href="#">ADD</a></li>
        <li><a href="/AdditionalTask/move.php">MOVE</a></li>
        <li><a href="/AdditionalTask/delete.php">DELETE</a></li>
    </ul>
</header>
<section style="padding-top: 100px; padding-bottom: 90px;" class="about">
    <div class="about-header">
        <h1>Add</h1>
    </div>
    <div class="card">
        <form enctype="multipart/form-data"  method="post">
             <input type="file" name="file" class="feedback-input" placeholder="Name Of File">
             <input type="text" name="dir" class="feedback-input" placeholder="Derectory">
            <input type="submit" name="enter" value="SUBMIT" />

            <?php
            $str='';
            if (isset($_POST['enter'])) {
                $dir = isset($_POST['dir']) ? $_POST['dir'] : "";

                if (is_dir($dir) && ($_FILES["file"]["error"] == 0)){

                    $save_path = "$dir/" . $_FILES["file"]["name"];

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $save_path)){
                        $str= "Success";

                        if (strpos($_FILES["file"]['type'], 'text') === 0){
                            $file = fopen($save_path, "r");
                            $contents = fread($file, 30);
                            fclose($file);
                            echo $contents;
                        } elseif (strpos($_FILES["file"]['type'], 'image') === 0){
                            copy($save_path, "." . "\\" . pathinfo($save_path)['basename']);
                            echo "<img src=\"" . pathinfo($save_path)['basename'] . "\">";
                        }
                    }
                } elseif (!is_dir($dir)){
                    $str="Invalid Directory Path";
                } else {
                    $str="Upload Error";
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