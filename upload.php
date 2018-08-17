<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<?php
    /**include database configuration file */
    include 'dbConfig.php';

    $fieldseparator = ";"; 
    $lineseparator  = "\n";
    $csvfile        = "tickets_appels_201202.csv";
   
    /** import csv file  */
    $affectedRows = $pdo->exec("LOAD DATA LOCAL INFILE ".$pdo->quote($csvfile)." INTO TABLE `ticket_appel`
                                FIELDS TERMINATED BY ".$pdo->quote($fieldseparator)."
                                LINES TERMINATED BY ".$pdo->quote($lineseparator)."
                                IGNORE 3 LINES"."
        (Compte_facture, No_facture,No_abonne,@Date_facturation,Heure_facturation,Dure_vol_reel,Dure_vol_facturee,Type_facturation)"."
        SET Date_facturation = cast(concat(substring(@Date_facturation,7,4),'-',substring(@Date_facturation,4,2),'-',substring(@Date_facturation,1,2)) as date)");

    /** if rows are inserted; provide an alert with the answers of the questions*/
    if ($affectedRows>0) {

        echo '<h2 align="center" >GAC Technology </h2>';

        /** alert : number of lines inserted */
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                '. $affectedRows .'  lignes insérées avec succès
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';

        /**  Question 1  */
        echo '<div align="center" class="white-pink">';
        echo '<label >La durée totale réelle des appels effectués après le 15/02/2012 (inclus) sont :</label>';
        $duration = $pdo->query("SELECT  TIME_TO_SEC(CAST( Dure_vol_reel AS TIME)) AS total
                                 FROM ticket_appel
                                 WHERE Type_facturation 
                                 LIKE '%appel%' 
                                 AND Date_facturation>='2012-02-15'");
        /** fetch all data */
        $rows = $duration->fetchAll();
        $totalDuration = 0;

        /** if any rows exist; sum up total rows to total duration*/
        if ($rows) {
            foreach ($rows as $row) {
                $totalDuration = $totalDuration + $row['total'];
            }

            /** convert total duration into hrs, mins and secs  */
            $hours   = floor($totalDuration / 3600);
            $minutes = floor(($totalDuration / 60) % 60);
            $seconds = $totalDuration % 60;
            echo '<strong>' . $hours. ':'.$minutes. ':'.$seconds.'</strong>' ;
        }
        echo '</div>';

        /**  Question 2  */
        echo '<div class="white-pink">';
        echo '<label >Le TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné sont :</label>';
        $duration = $pdo->query("SELECT *
                                 FROM ticket_appel
                                 WHERE Heure_facturation>'18:00' 
                                 OR Heure_facturation<'08:00'
                                 GROUP BY No_abonne
                                 ORDER BY No_abonne 
                                 LIMIT 10");
        /** fetch all data */
        $rows = $duration->fetchAll();

        /** display table with data  */
        echo '<table  class="table table-striped">
            <tr>
                <th> No_facture </th>
                <th> No_abonne </th>
                <th> Heure_facturation </th>
            </tr>';

        foreach($rows as $row){
            echo '<tr>
                    <th>'.$row['No_facture'].'</th>
                    <th>'.$row['No_abonne'].'</th>
                    <th>'.$row['Heure_facturation'].'</th>
            </tr>';
        }
        echo '</table>';
        echo '</div>';

        /**  Question 3 */
        echo '<div align="center" class="white-pink" >
             <label >Quantite Total de SMS envoyes par l\'ensemble des abonnes: </label>';
        $duration = $pdo->query("SELECT COUNT(type_facturation) as total
                                 FROM ticket_appel
                                 WHERE type_facturation 
                                 LIKE '%sms%'")->fetch();
        echo '<strong>'.$duration['total'].'</strong>';
        echo '</div>';

    /** else display errer message */
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Fichier invalide: veuillez télécharger un fichier CSV.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        /** redirect to index page to allow the user to import another csv file */
        header ("Refresh: 3;URL='index.php'"); 
    }
?>
    </body>
</html>
