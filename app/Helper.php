<?php


namespace App;


class Helper
{


    public static function tryMat(){
        $pwd = getcwd();
        $cmd = '"C:\Program Files\MATLAB\R2019b\bin\matlab.exe" -automation -sd ' . $pwd . ' -r "magicSquare(2);exit" -wait -logfile log.txt';
        // exec
        $last_line = exec($cmd, $output, $retval);
        if ($retval == 0){
            // Read from CSV file which MATLAB has created
            $lines = file('result.csv');
            echo '<p>Results:<br>';
            foreach($lines as $line)
            {
                echo $line.'<br>';
            }
            echo '</p>';
        } else {
            // When command failed
            echo '<p>Failed </p>';
        }
    }

    public static function  storeMovies(){
        $filecontents = file_get_contents("u.item");

        $movies = explode("\n", $filecontents);

        for($i=0; $i<=0; $i++) {
            list($id, $title, $date, $url, $g1, $g2, $g3, $g4, $g5, $g6,$g7,$g8,$g9,$g10,$g11,$g12,$g13,$g14, $g15, $g16,$g17,$g18,$g19 ) = explode("|",$movies[$i]);
            $movie = new movie();
            $movie->id = $id;
            $movie->name = $title;
            $movie->save();
        }
    }
}