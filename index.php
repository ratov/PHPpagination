<?php

const DBHOST = 'localhost';
const DBUSER = 'root';
const DBPASS = '';
const DBASE = 'pagination';

$db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBASE) or die("error to connect" . mysqli_error());
if(!$db) die("Error for count" . mysqli_error());
mysqli_select_db($db, DBASE) or die("error to connect" . mysqli_error());

//Посчитаем сколько у нас новостей в БД (всех строк)
$select1 = mysqli_query($db, "SELECT COUNT(*) FROM articles");
if(!$select1) die("Error for count" . mysqli_error());
$row1 = mysqli_fetch_array($select1);
$count_post = $row1[0];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php

$select = mysqli_query($db, "SELECT id,title FROM articles ORDER BY id DESC LIMIT 3");

if(!$_GET) {
    while($row = mysqli_fetch_array($select)) {
        echo $row[1], "<br>";
    }

    echo "Page: 1 ";

    for($i = 3, $ii = 2; $i < $count_post; $i = $i + 3, $ii++)
        echo "<a href='http://pagination.loc/index.php?p={$i}'> {$ii} </a>";
}



if($_GET['p']) {
    $page = (int)$_GET['p'];
    $select = mysqli_query($db, "SELECT id,title FROM articles ORDER BY id DESC LIMIT $page,3");
    if(!$select1) die("Error for count" . mysqli_error());
    while($row = mysqli_fetch_array($select)) {
        echo $row[1], "<br>";
    }

    echo "Page: <a href='http://pagination.loc/index.php'>1</a> ";

    for($i = 3, $ii = 2; $i < $count_post; $i = $i + 3, $ii++) {
        echo "<a href='http://pagination.loc/index.php?p={$i}'";
        if($page == $i) echo "style='color:red'";
        echo ">{$ii} </a>";
    }
}

?>

</body>
</html>