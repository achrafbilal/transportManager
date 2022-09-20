<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    require_once('./db.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->query("select * from users where email = '$email' and password = '$password' ;");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($result) > 0) {
        $_SESSION["user"] = $result[0];
        $stmt = $pdo->query('select role_name from roles where id = ' . $result[0]['role_id'] . ';');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['role_name'] = $result[0]['role_name'];
        header('Location: /travels');
        die;
    } else {
        $message = "Incorrect email or password";
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
                        <h4>
                            Login
                        </h4>
                    </div>
                    <div class="card-body">
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
                                Login
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
