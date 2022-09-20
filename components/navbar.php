<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)">Containers Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex">

                <?php
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user']['id'] > 0) {
                        switch ($_SESSION['user']['role_id']) {
                            case 1:
                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/travels">Travels</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/containers">Containers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/users">Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="new-container">Add New Container</a>
                                </li>
                                <li class="nav-item me-auto">
                                    <a class="nav-link" href="/logout">Logout</a>
                                </li>
                            <?php
                                break;
                            case 2:
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/travels">My Travels</a>
                                </li>
                                <li class="nav-item me-auto">
                                    <a class="nav-link" href="/logout">Logout</a>
                                </li>
                            <?php
                                break;
                            case 3:
                            ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="/new-travel">Add New Travel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/travels">Travels</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/containers">Containers</a>
                                </li>
                                <li class="nav-item me-auto">
                                    <a class="nav-link" href="/logout">Logout</a>
                                </li>
                            <?php
                                break;
                            default:
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/login">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/register">Register</a>
                                </li>
                        <?php
                        }

                        ?>
                        <li class=" d-flex ">
                            <a class="nav-link text-danger" href="javascript:void(0)">
                                User :
                                <?php
                                echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']
                                ?>
                            </a>
                        </li>

                        <li class=" d-flex ">
                            <a class="nav-link text-danger" href="javascript:void(0)">
                                Role :
                                <?php
                                echo isset($_SESSION['role_name']) ? $_SESSION['role_name'] : ""
                                ?>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    <?php
                    }
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>