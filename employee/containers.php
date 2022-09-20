<?php
require_once('./db/db.php');
$stmt = $pdo->query('select * from containers ;');
$containers = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container-fluid bg-dark">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                Containers
            </h1>
        </div>
    </div>
    <div class="row mt-5">

        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <table class="table table-light table-hover rounded">
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
                    $i = 1;
                    foreach ($containers as $container) {
                    ?>
                        <form action="" method="post">
                            <tr>
                                <th scope="row" class="text-center">

                                    <form action="/edit-container" method="get">
                                        <input type="number" value="<?php echo $container['id'] ?>" name="id" style="display: none;" readonly>
                                        <button type="submit" class="btn btn-primary"><?php echo $i ?></button>
                                    </form>
                                </th>
                                <td class="text-center"><?php echo $container['label'] ?></td>
                                <td class="text-center"><?php echo $container['max_volume'] ?></td>
                                <td class="text-center"><?php echo $container['free'] ? "" : "Not" ?> Available</td>

                            </tr>
                        </form>
                    <?php
                        $i++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>