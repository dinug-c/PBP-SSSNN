<?php
    $array_mhs = array(
    'Abdul' => array( 89,90,54 ),
    'Budi' => array( 98,65,74 ),
    'Nina' => array( 67,56,84 ),
    );

    function hitung_rata($array){
        $n = sizeof($array);
        $total = 0;
        for($i=0;$i<=($n-1);$i++){
            $total = $total + $array[$i];
        }
        $rata = $total / $n;
        return $rata;
    }

    function print_mhs($array_mhs){
        echo '<table border="1">';
        echo '<tr>
        <td>Nama</td>
        <td>Nilai 1</td>
        <td>Nilai 2</td>
        <td>Nilai 3</td>
        <td>Rata-rata</td>
        </tr>';
        foreach($array_mhs as $nama => $nilai){
            echo '<tr>';
            echo '<td>'.$nama.'</td>';
            $n = sizeof($nilai);
            for($i=0;$i<=($n-1);$i++){
                echo '<td>'.$nilai[$i].'</td>';
            }
            echo '<td>'.hitung_rata($nilai).'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    print_mhs($array_mhs);
?>