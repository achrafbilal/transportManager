<?php
require_once('./db/db.php');

$id = $_SESSION['user']['id'];
$stmt = $pdo->query("select travels_clients_containers.*, fromC.from_city_name,fromC.from_country_name,    toC.to_city_name,toC.to_country_name    from  (select c.id,c.city_name as from_city_name,cou.country_name as from_country_name from cities c left join countries cou on cou.id = c.country_id) as fromC inner join   (select t.*,u.first_name,u.last_name,u.email,con.label,con.max_volume from containers con inner join travels t on t.container_id = con.id inner join users u on u.id = t.client_id where u.id=$id) as travels_clients_containers on fromC.id = travels_clients_containers.from_city_id inner join (select c.id,c.city_name as to_city_name,cou.country_name as to_country_name from cities c left join countries cou on cou.id = c.country_id) as toC on toC.id = travels_clients_containers.to_city_id  order by travels_clients_containers.departure_date desc; ");

$travels = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($travels);



?>
<div class="container-fluid bg-dark">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                Travels
            </h1>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <table class="table table-light table-hover rounded">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-left"> From </th>
                        <th scope="col" class="text-left">To</th>
                        <th scope="col" class="text-center">Container Label</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-center">Unit price</th>
                        <th scope="col" class="text-center">Total price</th>
                        <th scope="col" class="text-center">Departure date</th>
                        <th scope="col" class="text-center">Arrival date</th>
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
                                <a href="javascript:void(0)"><?php echo $i ?></a>
                            </th>
                            <td class="text-left pt-3"><?php echo $travel['from_country_name'] . ' , ' . $travel['from_city_name'] ?></td>
                            <td class="text-left pt-3"><?php echo $travel['to_country_name'] . ' , ' . $travel['to_city_name'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['label'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['max_volume'] . ' ' ?>Ton</td>
                            <td class="text-center pt-3"><?php echo $travel['unit_price'] . ' ' ?>Dhs / Ton</td>
                            <td class="text-center pt-3"><?php echo $travel['max_volume'] * $travel['unit_price'] . ' ' ?>Dhs</td>
                            <td class="text-center pt-3"><?php echo date('Y-m-d', strtotime($travel['departure_date'])) === date('Y-m-d') ? "Today" : $travel['departure_date'] ?></td>
                            <td class="text-center pt-3"><?php echo $travel['arrival_date'] !== null ? (date('Y-m-d', strtotime($travel['arrival_date'])) === date('Y-m-d') ? "Today" : $travel['arrival_date']) : "Not yet" ?></td>

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