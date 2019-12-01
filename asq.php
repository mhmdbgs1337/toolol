<?php

@system("clear");

function banner(){
    @system("clear");
    $blue="\033[1;34m";
    $cyan="\033[1;36m";
    $okegreen="\033[92m";
    $lightgreen="\033[1;32m";
    $white="\033[1;37m";
    $purple="\033[1;35m";
    $red="\033[1;31m";
    $yellow="\033[1;33m";
    print "\n";
    print "$yellow  ╔═╗╔═╗╔═╗  $white Ask\n";
    print "$yellow  ╠═╣╚═╗║═╬╗ $white Some\n";
    print "$yellow  ╩ ╩╚═╝╚═╝╚ $white Questions\n";
    print "\n";
    print "$cyan  01$white Cari Pertanyaan\n";
    print "$cyan  02$white Cari Jawaban\n";
    print "\n";
    print "$okegreen  ??$white Menu : ";
    $menu = trim(fgets(STDIN));
    if ( $menu == '1' ){
        tanya();
    }
    elseif ( $menu == '2' ){
        jawab();
    }
    else{
        banner();
    }
}

function tanya(){
    $blue="\033[1;34m";
    $cyan="\033[1;36m";
    $okegreen="\033[92m";
    $lightgreen="\033[1;32m";
    $white="\033[1;37m";
    $purple="\033[1;35m";
    $red="\033[1;31m";
    $yellow="\033[1;33m";
    print "$okegreen  ??$white Mau bertanya tentang apa? : ";
    $tanya = trim(fgets(STDIN));
    $tanya = str_replace(' ', '%20', $tanya);
    print "$red  //$white Tunggu selagi saya mencari pertanyaan ...\n";
    $result = file_get_contents('http://rpl2texar.000webhostapp.com/api/quora/tanya.php?soal='.$tanya);
    $json = json_decode($result, true);
    print "$red  //$white Dibawah ini adalah pertanyaan yang dapat anda berikan :\n\n";
    foreach ((array) $json as $row){
        $soal = $row['title'];
        $link = $row['url'];
        print "$yellow    ->$white $soal\n";
    }
    print "\n";
    print "$okegreen  ??$white Mau bertanya lagi? (Y/n/0) : ";
    $ulang = trim(fgets(STDIN));
    if ( $ulang == 'Y' OR $ulang == 'y' ){
        tanya();
    }
    elseif ( $ulang == 'N' or $ulang == 'n' ){
        print "$red  !!$white Keluar\n\n";
        exit();
    }
    elseif ( $ulang == '0' ){
        banner();
    }
    else{
        print "$red  !!$white Aborting\n\n";
        exit();
    }
}

function jawab(){
    $blue="\033[1;34m";
    $cyan="\033[1;36m";
    $okegreen="\033[92m";
    $lightgreen="\033[1;32m";
    $white="\033[1;37m";
    $purple="\033[1;35m";
    $red="\033[1;31m";
    $yellow="\033[1;33m";
    print "$okegreen  ??$white Apa yang mau ditanyakan? : ";
    $tanya = trim(fgets(STDIN));
    $tanya = str_replace(' ', '%20', $tanya);
    print "$red  //$white Tunggu selagi saya mencari jawaban ...\n";
    $result = file_get_contents('http://rpl2texar.000webhostapp.com/api/brainly/tanya.php?soal='.$tanya);
    $json = json_decode($result, true);
    print "$red  //$white Dibawah ini adalah pertanyaan dan jawaban yang sesuai :\n\n";
    foreach ((array) $json as $row){
        $soal = $row['content'];
        $soal = str_replace('<span>', '', $soal);
        $soal = str_replace('</span>', '', $soal);
        $soal = str_replace('<br />', "\n", $soal);
        $soal = str_replace('<p>', '', $soal);
        $soal = str_replace('</p>', '', $soal);
        $soal = str_replace('<strong>', '', $soal);
        $soal = str_replace('/<strong>', '', $soal);
        $jawab = $row['answers'];
        print "$red  //$white Soal\n";
        print "\n$soal\n\n";
        print "$red  //$white Jawaban\n";
        foreach ((array) $jawab as $row){
            $row = str_replace('<span>', '', $row);
            $row = str_replace('</span>', '', $row);
            $row = str_replace('<br />', "\n", $row);
            $row = str_replace('<p>', '', $row);
            $row = str_replace('</p>', '', $row);
            $row = str_replace('<strong>', '', $row);
            $row = str_replace('</strong>', '', $row);
            print "\n- $white $row\n";
        }
        print "\n\n";
    }
    print "\n";
    print "$okegreen  ??$white Mau bertanya lagi? (Y/n/0) : ";
    $ulang = trim(fgets(STDIN));
    if ( $ulang == 'Y' OR $ulang == 'y' ){
        jawab();
    }
    elseif ( $ulang == 'N' or $ulang == 'n' ){
        print "$red  !!$white Keluar\n\n";
        exit();
    }
    elseif ( $ulang == '0' ){
        banner();
    }
    else{
        print "$red  !!$white Aborting\n\n";
        exit();
    }
}

banner();
