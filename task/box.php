<?php
function checkWinner($box)
{

    for ($i = 0; $i < 3; $i++) {
        if ($box[$i][0] == $box[$i][1] && $box[$i][1] == $box[$i][2] && $box[$i][0] != '') {
            return $box[$i][0];
        }
        if ($box[0][$i] == $box[1][$i] && $box[1][$i] == $box[2][$i] && $box[0][$i] != '') {
            return $box[0][$i];
        }
    }
    if ($box[0][0] == $box[1][1] && $box[1][1] == $box[2][2] && $box[0][0] != '') {
        return $box[0][0];
    }
    if ($box[0][2] == $box[1][1] && $box[1][1] == $box[2][0] && $box[0][2] != '') {
        return $box[0][2];
    }
    return null;
}