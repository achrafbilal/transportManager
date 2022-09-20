<?php
require_once('./db/db.php');

$id = $_SESSION['user']['id'];
$stmt = $pdo->query("select travels_clients_containers.*, fromC.from_city_name,fromC.from_country_name,    toC.to_city_name,toC.to_country_name    from  (select c.id,c.city_name as from_city_name,cou.country_name as from_country_name from cities c left join countries cou on cou.id = c.country_id) as fromC inner join   (select t.*,u.first_name,u.last_name,u.email,con.label from containers con inner join travels t on t.container_id = con.id inner join users u on u.id = t.client_id where u.id=$id) as travels_clients_containers on fromC.id = travels_clients_containers.from_city_id inner join (select c.id,c.city_name as to_city_name,cou.country_name as to_country_name from cities c left join countries cou on cou.id = c.country_id) as toC on toC.id = travels_clients_containers.to_city_id ; ");

$travels = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($travels);



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
            <table class="table table-dark table-hover rounded">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" colspan="2"> From </th>
                        <th scope="col" colspan="2">To</th>
                        <th scope="col" class="text-center">Container Label</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-center">Unit price</th>
                        <th scope="col" class="text-center">Total price</th>
                        <th scope="col" class="text-center">Departure date</th>
                        <th scope="col" class="text-center">Arrival date</th>
                        <th scope="col" class="text-center">State</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($travels as $travel) {
                    ?>
                        <tr>
                            <th scope="row">
                                <!-- /show-user/<?php echo $travel['id'] ?> -->
                                <a href="javascript:void(0)"><?php echo $travel['id'] ?></a>
                            </th>
                            <td class="text-center"><?php echo $travel['from_country_name'] ?></td>
                            <td class="text-center"><?php echo $travel['from_city_name'] ?></td>
                            <td class="text-center"><?php echo $travel['to_country_name'] ?></td>
                            <td class="text-center"><?php echo $travel['to_city_name'] ?></td>
                            <td class="text-center"><?php echo $travel['label'] ?></td>
                            <td class="text-center"><?php echo $travel['volume'] . ' ' ?>Ton</td>
                            <td class="text-center"><?php echo $travel['unit_price'] . ' ' ?>Dhs / Ton</td>
                            <td class="text-center"><?php echo $travel['volume'] * $travel['unit_price'] . ' ' ?>Dhs</td>
                            <td class="text-center"><?php echo $travel['label'] ?></td>
                            <td class="text-center"><?php echo $travel['label'] ?></td>
                            <td class="text-center"><?php echo $travel['label'] ?></td>

                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>