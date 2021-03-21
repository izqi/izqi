<?php
session_start();

// Create connection
$mysqli = new mysqli('localhost', 'root', '', 'marketcrud') or die(mysqli_error($mysqli));

// insert velden leeg te houden
$id = 0;
$update = false;

$naam = '';
$market = '';
$aantal = '';
$prijs = '';
$totaalwaarde = '';


//creat van crud
if (isset($_POST['opslaan'])) {
    $naam = $_POST['naam'];
    $market = $_POST['market'];
    $aantal = $_POST['aantal'];
    $prijs = $_POST['prijs'];
    $totaalwaarde = $_POST['totaalwaarde'];

    $mysqli->query("INSERT INTO market (naam, market, aantal, prijs, totaalwaarde ) 
    VALUES ('$naam', '$market', '$aantal', '$prijs', '$totaalwaarde' )")
    or die($mysqli->error);

    $_SESSION['message'] = "Uw gegevens zijn opgeslagen!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}


//delete van crud
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM market WHERE idmarket=$id") or die($mysqli->error());

    $_SESSION['message'] = "Uw gegevens zijn verwijderd!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}


//edit van crud
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM market WHERE idmarket=$id") or die ($mysqli->error());

    if ($result->num_rows) {
        $row = $result->fetch_array();

        $naam= $row['naam'];
        $market = $row['market'];
        $aantal = $row['aantal'];
        $prijs = $row['prijs'];
        $totaalwaarde= $row['totaalWaarde'];

    }
}


//update button to save edit$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
if (isset($_POST['update'])){
    $id = $_POST['id'];

    $naam = $_POST['naam'];
    $market = $_POST['market'];
    $aantal = $_POST['aantal'];
    $prijs = $_POST['prijs'];
    $totaalwaarde = $_POST['totaalWaarde'];

    $mysqli->query("UPDATE market SET naam='$naam',
                market='$market', aantal='$aantal', prijs='$prijs',
                totaalWaarde='$totaalwaarde' WHERE idmarket=$id") or die($mysqli->error);

    $_SESSION['message'] = "Uw gegevens zijn geupdate!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}