<?php
  if ($_POST['debug']) {
    $result = $_POST['debug'];
foreach ($result as $key) {
    // Access individual fields using keys
    $id = $key['id'];
    $title = $key['title'];
    $length = $key['length'];
    $poster = $key['poster'];

    // Output or process the data as needed
    echo "ID: $id, Title: $title, Length: $length, Poster: $poster <br>";

    // You can do additional processing or output here
}
  }
?>