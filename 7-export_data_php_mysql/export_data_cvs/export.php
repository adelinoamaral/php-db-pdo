<?php  
    include 'functions.php';

    $pdo = connect_db();
    $output = '';
    
    if(isset($_POST["export"]))
    {
        $sql = "SELECT * FROM contacts";
        $results = $pdo->query($sql);
        if ($results->rowCount() > 0){
            $output .= '
                <table class="table">  
                <tr>  
                    <th>ID</th> 
                    <th>Nome</th>  
                    <th>Email</th>  
                </tr>
                ';
            while ($row = $results->fetch())
            {
                $output .= '
                        <tr>  
                            <td>'.$row["id"].'</td>  
                            <td>'.$row["name"].'</td>  
                            <td>'.$row["email"].'</td>  
                        </tr>
                ';
        }
        $output .= '</table>';

    /**
     * warning: o output tem caracteres especiais, não aceita acentos
     * VERIFICAFR
     */

    // create file xls format
    header('Content-Type:application/xls;charset=utf-8');
    header('Content-Disposition:attachment;filename=download.xls');

    // download_send_headers('download.xls');

    // create file csv format
    // header('Content-Type: text/csv; charset=utf-8');
    // header('Content-Disposition: attachment; filename=download.csv');
    echo $output;
    }
}
?>