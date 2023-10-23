<!DOCTYPE html>
<html>
<head>
    <title>Загрузка изображения</title>
</head>
<body>
    <h1>Загрузка изображения</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Проверка, является ли файл изображением
        if (getimagesize($_FILES["image"]["tmp_name"]) === false) {
            echo "Этот файл не является изображением.";
            $uploadOk = 0;
        }

        // Проверка, существует ли уже файл
        if (file_exists($targetFile)) {
            echo "Извините, файл с таким именем уже существует.";
            $uploadOk = 0;
        }

        // Проверка размера файла (в данном случае, ограничение 2 МБ)
        if ($_FILES["image"]["size"] > 2000000) {
            echo "Извините, ваш файл слишком большой.";
            $uploadOk = 0;
        }

        // Разрешенные форматы файлов
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Извините, только файлы JPG, JPEG, PNG и GIF разрешены.";
            $uploadOk = 0;
        }

        // Попытка загрузки файла, если все проверки пройдены
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "Файл " . basename($_FILES["image"]["name"]) . " успешно загружен.";
            } else {
                echo "Произошла ошибка при загрузке вашего файла.";
            }
        }
    }
    ?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        Выберите изображение для загрузки:
        <input type="file" name="image" id="image">
        <input type="submit" value="Загрузить изображение" name="submit">
    </form>
</body>
</html>
