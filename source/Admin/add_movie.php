<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include_once '../../includes/css_links.php'?>
  <link rel="stylesheet" href="../../public/css/Admin/add-movie.css">
  <title>Document</title>
</head>
<body>
  <?php include_once '../../includes/navbar.php';?>

  <main>
    <h1 class="title">Add a Movie</h1>
    <form class="add-form" action="" method="POST">
      <section class="basic-info-section">
        <div class="input-container">
          <label class="grey" for="name">Movie Name</label>
          <input class="input" id="name" type="text">
        </div>

        <div class="input-container">
          <label class="grey" for="length">Movie Length</label>
          <input class="input" id="length" type="text">
        </div>

        <div class="input-container">
          <label class="grey" for="rated">Movie Rated</label>
          <input class="input" id="rated" type="text">
        </div>

        <div class="input-container">
          <label class="grey" for="display">Movie Display</label>
          <input class="input" id="display" type="text">
        </div>

        <div class="input-container">
          <label class="grey" for="rating">Movie Rating</label>
          <input class="input" id="rating" type="text">
        </div>
      </section>
      
      <section class="desc-poster-section">
        <div class="large-container">
          <label class="grey" for="description">Movie Description</label>
          <textarea class="large-input input" name="" id="description"></textarea>
        </div>

        <div class="large-container">
          <label class="grey" for="poster">Movie Poster</label>
          <input class="large-input input" id="poster" type="text">
        </div>
      </section>
      <section class="button-operations">
        <a href="landing.php"><button class="go-back">Go Back</button></a>
        <a href=""><button class="proceed">Proceed</button></a> 
      </section>  
    </form>
  </main>
</body>
</html>