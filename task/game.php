<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div id="box"></div>
<script>
    var currentPlayer = "X";

    function makeMove(row, col) {
        $.post("move.php", { row: row, col: col, player: currentPlayer }, function (data) {
            $("#board").html(data);
            checkWinner();
            currentPlayer = (currentPlayer === "X") ? "O" : "X";
        });
    }

    function checkWinner() {
        $.get("check_winner.php", function (data) {
            if (data) {
                alert("Player " + data + " wins!");
                location.reload();
            }
        });
    }

    $(document).ready(function () {
        for (var i = 0; i < 3; i++) {
            for (var j = 0; j < 3; j++) {
                $("#board").append("<div class='cell' onclick='makeMove(" + i + ", " + j + ")'></div>");
            }
            $("#board").append("<br>");
        }
    });
</script>
</body>

</html>