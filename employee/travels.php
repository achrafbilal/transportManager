<?php
require_once('./db/db.php');

if (isset($_POST['travel-arrived'])) {
    $id = $_POST['id'];
    $container_id = $_POST['container_id'];
    $date = date('Y-m-d');
    $stmt = $pdo->query("update travels set arrival_date='$date' where id = $id;");
    if ($stmt)
        $stmt = $pdo->query("update containers set free=true where id = $container_id;");
}
$stmt = $pdo->query("select 	travels_clients_containers.*,	fromC.from_city_name,fromC.from_country_name,    toC.to_city_name,toC.to_country_name    from  (select c.id,c.city_name as from_city_name,cou.country_name as from_country_name from cities c left join countries cou on cou.id = c.country_id) as fromC inner join   (select t.*,u.first_name,u.last_name,u.email,con.label,con.max_volume from containers con inner join travels t on t.container_id = con.id inner join users u on u.id = t.client_id ) as travels_clients_containers on fromC.id = travels_clients_containers.from_city_id inner join (select c.id,c.city_name as to_city_name,cou.country_name as to_country_name from cities c left join countries cou on cou.id = c.country_id) as toC on toC.id = travels_clients_containers.to_city_id order by travels_clients_containers.departure_date desc; ");
$travels = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid bg-dark">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                Travels
            </h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <table class="table table-light table-hover rounded">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" colspan="2"> From </th>
                        <th scope="col" colspan="2">To</th>
                        <th scope="col" class="text-center">Container Label</th>
                        <th scope="col" class="text-center">Client Full Name</th>
                        <th scope="col" class="text-center">Client Email</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-center">Unit price</th>
                        <th scope="col" class="text-center">Total price</th>
                        <th scope="col" class="text-center">Departure date</th>
                        <th scope="col" class="text-center">Arrival date</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    foreach ($travels as $travel) {
                    ?>
                        <tr>
                            <th scope="row" class="pt-3">
                                <!-- /show-user/<?php echo $travel['id'] ?> -->
                                <!-- <a href="/edit-travel?id=<?php echo $travel['id'] ?>"><?php echo $i ?></a> -->
                                <a href="javascript:void(0)"><?php echo $i ?></a>
                            </th>
                            <td class="text-center pt-3"><?php echo $travel['from_country_name'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['from_city_name'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['to_country_name'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['to_city_name'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['label'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['first_name'] . ' ' . $travel['last_name'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['email'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['max_volume'] . ' ' ?>Ton</td>
                            <td class="text-center pt-3"><?php echo $travel['unit_price'] . ' ' ?>Dhs / Ton</td>
                            <td class="text-center pt-3"><?php echo $travel['max_volume'] * $travel['unit_price'] . ' ' ?>Dhs</td>
                            <td class="text-center pt-3"><?php echo date('Y-m-d', strtotime($travel['departure_date'])) === date('Y-m-d') ? "Today" : $travel['departure_date'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['arrival_date'] !== null ? (date('Y-m-d', strtotime($travel['arrival_date'])) === date('Y-m-d') ? "Today" : $travel['arrival_date']) : "Not yet" ?></td>
                            <td class="text-center">
                                <?php
                                $afterToday = $travel['arrival_date'] !== null ? date('Y-m-d', strtotime($travel['arrival_date'])) > date('Y-m-d') : false;
                                if (($travel['arrival_date'] === null && date('Y-m-d', strtotime($travel['departure_date'])) < date('Y-m-d')) || $afterToday) {
                                ?>
                                    <form action="" method="post">
                                        <input type="number" style="display: none;" name="id" value="<?php echo $travel['id'] ?>">
                                        <input type="number" style="display: none;" name="container_id" value="<?php echo $travel['container_id'] ?>">
                                        <button type="submit" name="travel-arrived" class="btn btn-danger" value="arrived">Arrived now</button>
                                    </form>
                                <?php
                                }
                                ?>
                            </td>

                        </tr>
                    <?php
                        $i++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>