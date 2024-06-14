<?php
include_once '../../classes/dbh.class.php';
$dbhconnect = new Dbh();
$results = [];

try {
    if (isset($_POST['submit'])) {
        $file_name = $_FILES['poster']['name'];
        $tempname = $_FILES['poster']['tmp_name'];
        $folder = '../../public/images/' . $file_name;

        if (move_uploaded_file($tempname, $folder)) {
            echo '<h2>File Uploaded Successfully</h2>';

            // Insert the file name into the database
            $query = 'INSERT INTO images(img_file) VALUES (:img_filename)';
            $stmt = $dbhconnect->connection()->prepare($query);
            $stmt->bindParam(":img_filename", $file_name, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            echo '<h2>File not Uploaded</h2>';
        }
    }

    // Fetch all images from the database
    $query = 'SELECT * FROM images';
    $stmt = $dbhconnect->connection()->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

} catch (PDOException $e) {
    die("Query Failed. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="poster">
    <br><br>
    <button type="submit" name="submit">Submit</button>
  </form>

  <div>
    <?php foreach ($results as $row) {?>
        <img src="../../public/images/<?php echo $row['img_file']; ?>" alt="">
    <?php }?>
  </div>

</body>
</html>
