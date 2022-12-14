<?php
require_once('./db/db.php');
// $stmt = $pdo->query('select * from containers_states');
// $states = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['id'])) {
    $stmt = $pdo->query('select * from containers where id = ' . $_GET['id'] . ';');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) < 1) {
        header('Location: /containers');
        exit;
    }
    $container = $result[0];
} else {
    header('Location: /containers');
    exit;
}
if (isset($_POST['container-submit'])) {
    $id = $_POST['id'];
    $label = $_POST['label'];
    $maxVolume = $_POST['max_volume'];
    $free = $_POST['free'];
    $stmt = $pdo->query("select * from containers where label = '$label' and id !=$id");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $message = "A container with the name $label already exists";
    } else {
        $stmt = $pdo->query("update containers set label = '" . $label . "',max_volume = $maxVolume,free = $free where id = $id;");
        header('Location: /containers');
        die;
    }
}
?>
<div class="container-fluid bg-dark text-light">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                Edit Container
            </h1>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="POST">
                <div class="row pb-5">
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

                        <input name="id" id="id" type="text" class="form-control" value="<?php echo $container['id'] ?>" readonly required style="display: none;">
                        <input name="free" id="free" type="text" class="form-control" value="<?php echo $container['free'] ?>" readonly required style="display: none;">
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <label for="label" class="form-label">
                                    Container Label
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="label" id="label" type="text" class="form-control" value="<?php echo $container['label'] ?>" placeholder="Cargo 45" required>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <label for="max_volume " class="form-label">
                                    Container Max Volume
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="max_volume" id="max_volume" type="number" min="50" max="700" class="form-control" value="<?php echo $container['max_volume'] ?>" placeholder="370" required>
                            </div>
                        </div>
                        <div class="row pb-5 ">
                            <div class="col-md-6">

                            </div>

                            <div class="d-grid col-4 mx-auto">
                                <button type="submit" name="container-submit" class="btn btn-light">Save</button>
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