<?php
require_once('./db/db.php');
$stmt = $pdo->query('select * from containers_states');
$states = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['container-submit'])) {
    $label = $_POST['label'];
    $maxVolume = $_POST['max_volume'];
    $containerStateId = $_POST['container_state_id'];
    $stmt = $pdo->query("select * from containers where label = '$label'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $message = "A container with the name $label already exists";
    } else {
        $stmt = $pdo->query("insert into containers (label,max_volume,container_state_id) values ('" . $label . "'," . $maxVolume . "," . $containerStateId . ");");

        header('Location: /containers');
        die;
    }
}
?>
<div class="container-fluid pt-5 bg-dark text-light">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                New Travel
            </h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="POST">
                <div class="row pt-5">
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
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <label for="label" class="form-label">
                                    Container Label
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="label" id="label" type="text" class="form-control" placeholder="Cargo 45" required>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <label for="max_volume " class="form-label">
                                    Container Max Volume
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="max_volume" id="max_volume" type="number" min="50" max="700" class="form-control" placeholder="370" required>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <label for="container_state_id" class="form-label">
                                    Container State
                                </label>
                            </div>

                            <div class="col-md-6">
                                <select name="container_state_id" id="container_state_id" class="form-control" required>
                                    <?php
                                    foreach ($states as $state) {
                                    ?>
                                        <option value="<?php echo $state['id'] ?>"><?php echo $state['container_state_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row pt-5 ">
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