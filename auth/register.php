<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    require_once('./db.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $stmt = $pdo->query("select * from users where email = '$email' ;");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
        $message = "User with email $email already exists";
    } else {
        $statement = $pdo->query("insert into users (first_name,last_name,email,password,role_id) values ('$firstName','$lastName','$email','$password',2);");

        header('Location: /login');
        die;
    }
}
?>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <form action="" method="post">
                <div class="card">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required />
                        </div>
                        <?php
                        if (isset($message)) {
                            echo "<h5>$message</h5>";
                        }
                        ?>

                    </div>
                    <div class="card-footer">
                        <div class="">
                            <button type="submit" name="register" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
