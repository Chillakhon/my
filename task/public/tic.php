<?php
$users = [
        'player1'=>'Игор',
        'player2'=>'Паша',
        'player3'=>'Маша',
];

$winner = 'n';
$box = ['','','','','','','','','',];
if (isset($_POST['submitbtn'])) {
    $box['0'] = $_POST['box0'];
    $box['1'] = $_POST['box1'];
    $box['2'] = $_POST['box2'];
    $box['3'] = $_POST['box3'];
    $box['4'] = $_POST['box4'];
    $box['5'] = $_POST['box5'];
    $box['6'] = $_POST['box6'];
    $box['7'] = $_POST['box7'];
    $box['8'] = $_POST['box8'];


    if (($box[0] == 'x' && $box[1] == 'x' && $box[2] == 'x') ||
        ($box[3] == 'x' && $box[4] == 'x' && $box[5] == 'x') ||
        ($box[6] == 'x' && $box[7] == 'x' && $box[8] == 'x') ||
        ($box[0] == 'x' && $box[3] == 'x' && $box[6] == 'x') ||
        ($box[2] == 'x' && $box[6] == 'x' && $box[8] == 'x') ||
        ($box[2] == 'x' && $box[4] == 'x' && $box[6] == 'x') ||
        ($box[1] == 'x' && $box[4] == 'x' && $box[7] == 'x') ||
        ($box[2] == 'x' && $box[5] == 'x' && $box[8] == 'x') ||
        ($box[0] == 'x' && $box[4] == 'x' && $box[8] == 'x')) {
        $winner = 'x';
        print ("</br> <strong> X wins the game</strong></b>");
    }
    $blank = 0;
    for ($i = 0; $i <= 8; $i++) {
        if ($box[$i] == '') {
            $blank = 1;
        }
    }
    if ($blank == 1 && $winner == 'n') {
        $i = rand() % 8;
        while ($box[$i] != '') {
            $i = rand() % 8;
        }
        $box[$i] = 'o';
        if (($box[0] == 'o' && $box[1] == 'o' && $box[2] == 'o') ||
            ($box[3] == 'o' && $box[4] == 'o' && $box[5] == 'o') ||
            ($box[6] == 'o' && $box[7] == 'o' && $box[8] == 'o') ||
            ($box[0] == 'o' && $box[3] == 'o' && $box[6] == 'o') ||
            ($box[2] == 'o' && $box[6] == 'o' && $box[8] == 'o') ||
            ($box[2] == 'o' && $box[4] == 'o' && $box[6] == 'o') ||
            ($box[1] == 'o' && $box[4] == 'o' && $box[7] == 'o') ||
            ($box[2] == 'o' && $box[5] == 'o' && $box[8] == 'o') ||
            ($box[0] == 'o' && $box[4] == 'o' && $box[8] == 'o')) {
            $winner = 'o';
            print ("</br> <strong> O wins the game</strong></b>");
        }
    } else if ($winner == 'n') {
        $winner = 't';
        print ("</br>TIED GAME.");
    }
}
?>
<html>
<head>
    <title> ИГРА  </title>
    <style type="text/css">
        #box {
            background-color: #d9d8d8;
            border: 3px solid #000000;
            width: 100px;
            height: 100px;
            font-size: 70px;
            text-align: center;
        }
        #go {
            width: 150px;
            height: 50px;
            background-color: #cddc39;
            font-size: 20px;
        }

    </style>
</head>
<body bgcolor="fuchsia" align="center">

<div id="content">
<form name="tictactoe" action="" method="post">

<?php
for ($i=0; $i<=8; $i++){
    printf("<input type = 'text'  name='box%s' value = '%s' id ='box'>",$i,$box[$i]);
    if ($i==2 || $i==5 || $i==8){
        print ("</br>");
    }
}
if ($winner == 'n'){
    print ("</br><input type ='submit' name='submitbtn' value = 'PLAY' id ='go'>");
}else{
    echo ("</br><input type = 'button'  value = 'PLAY AGAIN' id='updateButton' ");
}
?>
</form>
</div>
<script src="forms.js"></script>
</body>
</html>
