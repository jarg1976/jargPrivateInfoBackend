<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="process_form.php" method="post" enctype="multipart/form-data">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="photo">Foto:</label>
    <input type="file" id="photo" name="photo" accept="image/*" required><br><br>
    <button type="submit">Enviar</button>
  </form>

</body>

</html>