<?php

/* $source = ChatServer::getConversations();

  foreach ($source as $value) {
  echo new ChatItem($value);
  } */
$pdo = DB::getConnection();
$curr_user = $_SESSION["login"];
$stmt = $pdo->prepare(
        "SELECT DISTINCT users.username FROM users"
        . " JOIN events ON events.action='liked'"
        . " AND (events.actioned_by=:unameBy OR events.actioned_towards=:unameTo)"
        . " WHERE (users.username !=:unameExcluded)"
);

$stmt->bindparam(":unameBy", $curr_user, PDO::PARAM_STR);
$stmt->bindparam(":unameTo", $curr_user, PDO::PARAM_STR);
$stmt->bindparam(":unameExcluded", $curr_user, PDO::PARAM_STR);
$stmt->execute();
$i = 0;
while (($row = $stmt->fetch(PDO::FETCH_ASSOC))) {
    if ($i == 0)
        echo new ChatItem($row["username"], true);
    else
        echo new ChatItem($row["username"]);
    $i++;
}
?>
