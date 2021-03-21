<?php require_once('header.php'); ?>
<?php require_once('databaseCrud.php'); ?>


<?php

if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?= $_SESSION['msg_type'] ?> ">

        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>

<div class="container">

    <?php
    // Create connection
    $mysqli = new mysqli('localhost', 'root', '', 'marketcrud');

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $result = $mysqli->query("SELECT * FROM market") or die($mysqli->error);

    //om te zien welke array het heeft dus met welke naam het wordt oproepen uit het database
    //pre_r($result->fetch_assoc());

    function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    ?>

    <!--    <div class="container">-->
    <h1>Market Crud</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Market ID</th>
            <th scope="col">Naam</th>
            <th scope="col">Market</th>
            <th scope="col">Aantal</th>
            <th scope="col">Prijs</th>
            <th scope="col">Totaal Waarde</th>
            <th scope="col" colspan="2">Action</th>
        </tr>
        </thead>


        <?php while ($row = $result->fetch_assoc()): ?>

            <tr>
                <td><?php echo $row['idmarket']; ?></td>
                <td><?php echo $row['naam']; ?></td>
                <td><?php echo $row['market']; ?></td>
                <td><?php echo $row['aantal']; ?></td>
                <td><?php echo $row['prijs']; ?></td>
                <td><?php echo $row['totaalWaarde']; ?></td>

                <td>
                    <a href="index.php?edit=<?php echo $row['idmarket']; ?>"
                       class="btn btn-info">Edit</a>
                    <a href="databaseCrud.php?delete=<?php echo $row['idmarket']; ?>"
                       class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>


    <!--    creat toevoegen##################################################################################################################################### -->
    <div class="row justify-content-center">
        <form action="databaseCrud.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label>Naam</label>
                <input type="text" name="naam" class="form-control"
                       value="<?php echo $naam; ?>" placeholder="Naam?">
            </div>
            <div class="form-group">
                <label>Market</label>
                <input type="text" name="market" class="form-control" value="<?php echo $market; ?>"
                       placeholder="Market?">
            </div>
            <div class="form-group">
                <label>Aantal</label>
                <input type="text" name="aantal" class="form-control" value="<?php echo $aantal; ?>"
                       placeholder="Aantal?">
            </div>
            <div class="form-group">
                <label>Prijs</label>
                <input type="text" name="prijs" class="form-control" value="<?php echo $prijs; ?>"
                       placeholder="Prijs?">
            </div>
            <div class="form-group">
                <label>Totaal waarde</label>
                <input type="text" name="totaalWaarde" class="form-control" value="<?php echo $totaalwaarde; ?>"
                       placeholder="Totaal waarde?">
            </div>
            <div class="form-group">
                <?php
                if ($update == true):
                    ?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="opslaan">Opslaan</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?php require_once('./footer.php'); ?>
