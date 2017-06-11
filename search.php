<?php
require('db_config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search results</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css"/>
<!--    ne znam koji stil da koristi ti nadji neki -->
</head>
<body>
<?php
$query = $_GET['query'];

if(($query)){

    $query = htmlspecialchars($query);
    $query = mysql_real_escape_string($query);
    $raw_results = mysql_query("SELECT * FROM article
            WHERE (`name_article` LIKE '%".$query."%') OR (`price_sell` LIKE '%".$query."%')") or die(mysql_error());
//ovo iznad je da radi search po imenu artikla i ceni ako korisnik zeli, ali zelim i da uradim search da korisnik moze ukucati i
//type takodje pa ako korisnik ukuca samo heels da sve heels izbaci pa nisam sigurna kako to da napravim tj. kontam da moram
//povezati te dve tabele ovde i jos promeni da li treba GET method ili ipak treba POST
    //KAD PRITISNEM ENTER PREBACI ME NA SEARCH.PHP ALI SE NISTA NE ISPISE



    if(mysql_num_rows($raw_results) > 0){

        while($results = mysql_fetch_array($raw_results)){


            echo "<p><h3>".$results['name_article']."</h3>".$results['discount']."<br/>".$results['price_sell']."</p>";
        }

    }
    else{
        echo "No results";
    }

}
?>
</body>
</html>