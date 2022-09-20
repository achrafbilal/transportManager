<?php
require_once('./db/db.php');
$stmt = $pdo->query('select * from users;');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($result);
return json_encode(['users' => $result]);
