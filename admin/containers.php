<?php
require_once('./db/db.php');
$stmt = $pdo->query('select c.*,s.container_state_name from containers c left join containers_states s on c.container_state_id=s.id;');
$containers = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                Containers
            </h1>
        </div>
    </div>
    <div class="row mt-5">

        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <table class="table table-dark table-hover rounded">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Label</th>
                        <th scope="col" class="text-center">Max Volume</th>
                        <th scope="col" class="text-center">State</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($containers as $container) {
                    ?>
                        <tr>
                            <th scope="row" class="text-center">

                                <form action="/edit-container" method="get">
                                    <input type="number" value="<?php echo $container['id'] ?>" name="id" style="display: none;" readonly>
                                    <button type="submit" class="btn btn-primary"><?php echo $container['id'] ?></button>
                                </form>
                            </th>
                            <td class="text-center"><?php echo $container['label'] ?></td>
                            <td class="text-center"><?php echo $container['max_volume'] ?></td>
                            <td class="text-center"><?php echo $container['container_state_name'] ?></td>

                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>