<?php
require_once('./db/db.php');
// $stmt = $pdo->query('select * from containers_states');
// $states = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['container-submit'])) {
    $label = $_POST['label'];
    $maxVolume = $_POST['max_volume'];
    $free = true;
    $stmt = $pdo->query("select * from containers where label = '$label'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $message = "A container with the name $label already exists";
    } else {
        $stmt = $pdo->query("insert into containers (label,max_volume,free) values ('" . $label . "'," . $maxVolume . "," . $free . ");");

        header('Location: /containers');
        die;
    }
}
?>
<div class="container-fluid bg-dark text-light">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                Add Container
            </h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-12">

                        <?php
                        if (isset($message)) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo $message
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <label for="label" class="form-label">
                                    Container Label
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="label" id="label" type="text" class="form-control" placeholder="Cargo 45" required>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <label for="max_volume " class="form-label">
                                    Container Max Volume
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="max_volume" id="max_volume" type="number" min="50" max="700" class="form-control" placeholder="370" required>
                            </div>
                        </div>
                        <div class="row pb-5 ">
                            <div class="col-md-6">

                            </div>

                            <div class="d-grid col-4 mx-auto">
                                <button type="submit" name="container-submit" class="btn btn-light">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<style>
    .a {
        justify-content: stretch;
    }
</style>