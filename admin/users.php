<?php
require_once('./db/db.php');
$stmt = $pdo->query('select u.id,u.first_name,u.last_name,u.email,r.role_name from users u left join roles r on u.role_id=r.id;;');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="container-fluid bg-dark">
    <div class="row m-5">
        <div class="col-12 d-flex justify-content-center align-items-center text-center text-light">
            <h1>
                Users
            </h1>
        </div>
    </div>

    <div class="row mt-5">

        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <table class="table table-light table-hover rounded">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">First Name</th>
                        <th scope="col" class="text-center">Last Name</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Role</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <th scope="row" class="text-center">
                                <!-- /show-user/<?php echo $user['id'] ?> -->
                                <a href="javascript:void(0)"><?php echo $i ?></a>
                            </th>
                            <td class="text-center"><?php echo $user['first_name'] ?></td>
                            <td class="text-center"><?php echo $user['last_name'] ?></td>
                            <td class="text-center"><?php echo $user['email'] ?></td>
                            <td class="text-center"><?php echo $user['role_name'] ?> </td>

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