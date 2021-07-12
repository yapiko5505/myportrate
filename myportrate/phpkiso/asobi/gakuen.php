<?php

$gakunen=$_POST['gakunen'];

switch($gakunen)
{
    case '1':
        $kousya = 'あなたの校舎は南校舎です。';
        break;

    case '2':
        $kousya = 'あなたの校舎は西校舎です。';
        break;

    case '3':
        $kousya = 'あなたの校舎は東校舎です。';
        break;
    default:
        print 'あなたの校舎は東校舎です。';
        break;
}

print '校舎 '.$kousya.'<br>';
?>