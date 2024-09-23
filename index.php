<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>pr2</title>
</head>

<body>
    <div class="container">
        <h1>Форма с валидацией</h1>
        <form action="process_form.php" method="POST">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" placeholder="Введите имя">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Введите email">
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона:</label>
                <input type="tel" id="phone" name="phone" placeholder="Введите номер телефона">
            </div>
            <button type="submit">Отправить</button>
        </form>
    </div>
</body>

</html>
<?php
function validateForm($name, $email, $phone) {
    $errors = [];

    if (empty($name)) {
        $errors['name'] = "Пожалуйста, введите имя.";
    } elseif (strlen($name) < 3 || strlen($name) > 50) {
        $errors['name'] = "Имя должно быть от 3 до 50 символов.";
    }

   
    if (empty($email)) {
        $errors['email'] = "Пожалуйста, введите email.";
    } elseif (strlen($email) < 6 || strlen($email) > 100) {
        $errors['email'] = "Email должен быть от 6 до 100 символов.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Пожалуйста, введите действительный email.";
    }

    
    if (empty($phone)) {
        $errors['phone'] = "Пожалуйста, введите номер телефона.";
    } elseif (strlen($phone) !== 11) {
        $errors['phone'] = "Номер телефона должен содержать 11 цифр.";
    }

    if (!empty($errors)) {
        return $errors;
    }

   
    return true;
}


$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];


$validationResult = validateForm($name, $email, $phone);

if ($validationResult === true) {
    echo "Форма успешно отправлена!";
} else {
    echo "Произошли следующие ошибки:<br>";
    foreach ($validationResult as $error) {
        echo "- " . $error . "<br>";
    }
}
