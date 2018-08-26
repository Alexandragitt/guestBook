<?php
$db = new PDO('mysql:host=localhost;dbname=city', 'root','' );
$selectBooks =  $db->query('SELECT  * from book ');
$arrayDb = $selectBooks->fetchAll();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
</head>
<body>
<table>
<?php foreach ($arrayDb as $key=> $element):?>
<tr>
    <td> <p ><?php echo $element['name'];?></p></td>
    <td> <p ><?php echo $element['date'];?></p></td>
    <td></td>
    <tr>
    <td colspan="3"> <p ><?php echo $element['comment'];?></p></td>
    </tr>
<?php endforeach; ?>
</table>
<form action="" method="post">
    <p>
        <label>Ваше имя:<br></label>
        <input name="name" type="text" value="">
    </p>
    <p>
        <label>Ваш отзыв<br></label>
        <input name="comment" type="text"  value="">
    </p>

    <p>
        <input type="submit" name="submit" value="Добавить" >
    </p></form>
</body>
</html>
<?php
$insertComment = $db->prepare("insert into book(name,comment) values (:name,:comment)");
if(!empty($_POST)){
    $resultPost = [];
    foreach ($_POST as $key=> $element) {
        $resultPost[$key] = htmlspecialchars(strip_tags(trim($element)));
    }
    $insertComment->bindParam( ':name', $resultPost['name']) ;
    $insertComment->bindParam( ':comment', $resultPost['comment']) ;
    $result=$insertComment->execute();
}
?>