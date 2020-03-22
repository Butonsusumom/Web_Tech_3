<?php
 function getChainize($date) { // в качестве параметров будут год, месяц и день
    $timeZone = new DateTimeZone ( 'Europe/Moscow' ); // временная зона
    $datetime1 = new DateTime ( $date, $timeZone ); // д.р.
    switch ((int)$datetime1->format('Y') % 12) {
        case 4:
            return 'Rat';
            break;
        case 5:
            return 'Ox';
            break;
        case 6:
            return 'Tiger';
            break;
        case 7:
            return 'Rabbit';
            break;
        case 8:
            return 'Dragon';
            break;
        case 9:
            return 'Snake';
            break;
        case 10:
            return 'Horse';
            break;
        case 11:
            return 'Goat';
            break;
        case 0:
            return 'Monkey';
            break;
        case 1:
            return 'Rooster';
            break;
        case 2:
            return 'Dog';
            break;
        case 3:
            return 'Pig';
            break;
    }
    return "";
}

function getEasten($date) { // в качестве параметров будут год, месяц и день
    $timeZone = new DateTimeZone ( 'Europe/Moscow' ); // временная зона
    $datetime1 = new DateTime ( $date, $timeZone ); // д.р.
    if ( ((int)$datetime1->format('m') == 3 && (int)$datetime1->format('d')  >= 21) || ((int)$datetime1->format('m')  == 4 && (int)$datetime1->format('d') <= 20) ) return 'Aries';
    if ( ((int)$datetime1->format('m')  == 4 && (int)$datetime1->format('d') >= 21) || ((int)$datetime1->format('m')  == 5 && (int)$datetime1->format('d') <= 20) )  return 'Taurus';
    if ( ((int)$datetime1->format('m')  == 5 && (int)$datetime1->format('d') >= 21) || ((int)$datetime1->format('m')  == 6 && (int)$datetime1->format('d') <= 21) )  return 'Gemini';
    if ( ((int)$datetime1->format('m')  == 6 && (int)$datetime1->format('d') >= 22) || ((int)$datetime1->format('m')  == 7 && (int)$datetime1->format('d') <= 22) )  return 'Cancer';
    if ( ((int)$datetime1->format('m')  == 7 && (int)$datetime1->format('d') >= 23) || ((int)$datetime1->format('m')  == 8 && (int)$datetime1->format('d') <= 23) ) return 'Leo';
    if ( ((int)$datetime1->format('m')  == 8 && (int)$datetime1->format('d') >= 24) || ((int)$datetime1->format('m')  == 9 && (int)$datetime1->format('d') <= 23) ) return 'Virgo';
    if ( ((int)$datetime1->format('m')  == 9 && (int)$datetime1->format('d') >= 24) || ((int)$datetime1->format('m')  == 10 && (int)$datetime1->format('d') <= 22) ) return 'Libra';
    if ( ((int)$datetime1->format('m')  == 10 && (int)$datetime1->format('d') >= 23) || ((int)$datetime1->format('m')  == 11 && (int)$datetime1->format('d') <= 22) ) return 'Scorpio';
    if ( ((int)$datetime1->format('m')  == 11 && (int)$datetime1->format('d') >= 23) || ((int)$datetime1->format('m')  == 12 && (int)$datetime1->format('d') <= 21) ) return 'Sagittarius';
    if ( ((int)$datetime1->format('m')  == 12 && (int)$datetime1->format('d') >= 22) || ((int)$datetime1->format('m')  == 1 && (int)$datetime1->format('d') <= 20) ) return 'Capricorn';
    if ( ((int)$datetime1->format('m')  == 1 && (int)$datetime1->format('d') >= 21) || ((int)$datetime1->format('m')  == 2 && (int)$datetime1->format('d') <= 19) ) return 'Aquarius';
    if ( ((int)$datetime1->format('m')  == 2 && (int)$datetime1->format('d') >= 20) || ((int)$datetime1->format('m')  == 3 && (int)$datetime1->format('d') <= 20) ) return 'Pisces';
}

function getAge($date) { // в качестве параметров будут год, месяц и день
    $timeZone = new DateTimeZone ( 'Europe/Moscow' ); // временная зона
    $datetime1 = new DateTime ( $date, $timeZone ); // д.р.
    $datetime2 = new DateTime (); // текущая дата
    $interval = $datetime1->diff ( $datetime2 ); // собственно вычисление
    return $interval->format ( '%y year %m mes %d day' ); // вывод на экран
}

function addDays($date,$d) { // в качестве параметров будут год, месяц и день
    $timeZone = new DateTimeZone ( 'Europe/Moscow' ); // временная зона
    $datetime1 = new DateTime ( $date, $timeZone ); // д.р.
    $datetime1->modify("+$d day");
    return $datetime1->format('Y-m-d');
}

function Button(&$days,&$inputLine,&$ag,&$daysComes,&$chein,&$east) {

         $fp = fopen("log.txt", "a"); // Открываем файл в режиме записи
         $days = $_POST['message'];
         $inputLine = $_POST['name'];
         $ag = getAge($inputLine);
        $daysComes = addDays($inputLine, (int)$days);
         $chein = getChainize($inputLine);
         $east = getEasten($inputLine);

        $logtext = "[request]:      $inputLine| date of Birth\r\n "; // Исходная строка
        $test = fwrite($fp, $logtext); // Запись в фай
        if ($test) echo "<script>alert('Can''t write to file)</script>";
        fprintf($fp, "%25s", $days); // Запись в фай
        if ($test) echo "<script>alert('Can''t write to file)</script>";
        $logtext = "| days\r\n"; // Исходная строка
        $test = fwrite($fp, $logtext); // Запись в фай
        if ($test) echo "<script>alert('Can''t write to file)</script>";

        $logtext = "[respond]: Date after days| $daysComes\r\n"; // Исходная строка
        $test = fwrite($fp, $logtext); // Запись в фай
        if ($test) echo "<script>alert('Can''t write to file)</script>";
        $logtext = "          Chinize Goroskop| $east\r\n"; // Исходная строка
        $test = fwrite($fp, $logtext); // Запись в фай
        if ($test) echo "<script>alert('Can''t write to file)</script>";
        $logtext = "                    Zodiak| $chein\r\n"; // Исходная строка
        $test = fwrite($fp, $logtext); // Запись в фай
        if ($test) echo "<script>alert('Can''t write to file)</script>";
        $logtext = "                       Age| $ag\r\n"; // Исходная строка
        $test = fwrite($fp, $logtext); // Запись в фай
        if ($test) echo "<script>alert('Can''t write to file)</script>";
        fclose($fp);

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Space - Universe</title>


    <!-- Styles -->
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/contact.css">
</head>
<body link="white" vlink="white" alink="white">
<body>
<header>

</header>

<!-- Contact section -->
<section style="padding-top: 100px; padding-bottom: 90px;" class="about">
    <div class="about-header">

    </div>


    <div class="card">
        <form method="POST" >
            <input name="message" type="number" min="0"  class="feedback-input" placeholder="Days"  value=<?php if (isset($_POST['enter'])) { echo $_POST['message'];}?> required>
            <input name="name" placeholder="Date" class="feedback-input"   max=<?php echo date('Y-m-d'); ?> type="date"  value=<?php if (isset($_POST['enter'])) { echo $_POST['name'];}?> required>

            <br><input type="submit" name="enter" value="SUBMIT">

            <?php
            {
            $days = '';
            $inputLine = '';
            $ag = '';
            $daysComes = '';
            $chein = '';
            $east = '';}
            if (isset($_POST['enter'])) {
                Button($days,
            $inputLine,
            $ag,
            $daysComes,
            $chein,
            $east);} ?>

            <h3><?php echo ' <font color=#8e2de2>Age: </font>'; echo $ag; ?></h3>
            <h3><?php echo ' <font color=#8e2de2>Date, when comes </font>';echo  "<font color=#8e2de2>$days days: </font>";echo $daysComes;?></h3>
            <h3><?php echo ' <font color=#8e2de2>Zodiak: </font>'; echo $east; ?></h3>
            <h3><?php echo ' <font color=#8e2de2>Chinize Goroskop: </font>'; echo $chein; ?></h3>



        </form>
    </div>
</section>
<br>
<br>
<br>
<br>
<br>
</body>
</html>