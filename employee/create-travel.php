<?php
require_once('./db/db.php');
$error = false;
if (isset($_POST['travel-submit'])) {

    $container_id = $_POST['container_id'];
    $from_city_id = $_POST['from_city_id'];
    $to_city_id = $_POST['to_city_id'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $arrival_date = strlen($arrival_date) > 0 ? $arrival_date : "null";
    $unit_price = $_POST['unit_price'];
    $client_id = $_POST['client_id'];
    if ($arrival_date !== 'null') {

        if (date('Y-m-d', strtotime($departure_date)) >= date('Y-m-d', strtotime($arrival_date))) {
            $message = "Invalid dates";
            $error = true;
        }
    } else
    if ($from_city_id === $to_city_id) {
        $message = "Can't ship to same city";
        $error = true;
    }
    if (!$error) {
        if ($arrival_date === "null") {
            $arrival_date = var_export(null, true);
        } else
            $arrival_date = "'$arrival_date'";

        $stmt = $pdo->query("insert into travels (from_city_id,to_city_id,container_id,client_id,unit_price,departure_date,arrival_date) values ($from_city_id,$to_city_id,$container_id,$client_id,$unit_price,'$departure_date',$arrival_date);");
        $stmt = $pdo->query("update containers set free=false where id = $container_id;");
        header('Location: /travels');
        die;
    }
}
$stmt = $pdo->query('select * from containers where free=1');
$containers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query('select c.*,co.country_name from cities c left join countries co on c.country_id=co.id');
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query('select id,email from users where role_id =2');
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid bg-dark text-light">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                New Travel
            </h1>
        </div>
    </div>

    <div class="row ">
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
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="container_id" class="form-label">
                                    Container
                                </label>
                            </div>

                            <div class="col-md-6">

                                <select name="container_id" id="container_id" class="form-control" required>
                                    <?php
                                    foreach ($containers as $container) {
                                    ?>
                                        <option value="<?php echo $container['id'] ?>"><?php echo $container['label'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="client_id" class="form-label">
                                    Client
                                </label>
                            </div>

                            <div class="col-md-6">

                                <select name="client_id" id="client_id" class="form-control" required>
                                    <?php
                                    foreach ($clients as $client) {
                                    ?>
                                        <option value="<?php echo $client['id'] ?>"><?php echo $client['email'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="from_city_id" class="form-label">
                                    Origin
                                </label>
                            </div>

                            <div class="col-md-6">

                                <select name="from_city_id" id="from_city_id" class="form-control" required>
                                    <?php
                                    foreach ($cities as $city) {
                                    ?>
                                        <option value="<?php echo $city['id'] ?>"><?php echo $city['country_name'] . ' , ' . $city['city_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="to_city_id" class="form-label">
                                    Destination
                                </label>
                            </div>

                            <div class="col-md-6">

                                <select name="to_city_id" id="to_city_id" class="form-control" required>
                                    <?php
                                    foreach ($cities as $city) {
                                    ?>
                                        <option value="<?php echo $city['id'] ?>"><?php echo $city['country_name'] . ' , ' . $city['city_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="departure_date" class="form-label">
                                    Departure date
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="departure_date" id="departure_date" type="date" class="form-control" placeholder="<?php echo '20/06/2023' ?>" required>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="arrival_date" class="form-label">
                                    Arrival date
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="arrival_date" id="arrival_date" type="date" class="form-control" placeholder="<?php echo '20/06/2023' ?>">
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-md-6">
                                <label for="unit_price" class="form-label">
                                    Unit Price
                                </label>
                            </div>

                            <div class="col-md-6">
                                <input name="unit_price" id="unit_price" type="number" class="form-control" placeholder="1250" required>
                            </div>
                        </div>


                        <div class="row pt-5 ">
                            <div class="col-md-6"></div>

                            <div class="d-grid col-4 mx-auto">
                                <button type="submit" name="travel-submit" class="btn btn-light">Add</button>
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