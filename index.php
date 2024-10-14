<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Выбор печенья</title>
</head>
<body>
    <div class="container">
        <h2>Выберите самое балдежное печенье</h2>
        <?php
        class Cookie {
            private $type;
            private $availableTypes = ['Кубическое', 'Балдежное', 'Фиолетовое', 'Дубайское'];

            public function setType($type) {
                if (in_array($type, $this->availableTypes)) {
                    $this->type = $type;
                } else {
                    throw new InvalidArgumentException();
                }
            }

            public function getType() {
                return $this->type;
            }

            public function displayAvailableTypes() {
                echo "Доступные виды печенья: " . implode(', ', $this->availableTypes) . "<br/>";
            }
        }

        $message = "";
        $selectedType = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cookie = new Cookie();
            try {
                $selectedType = trim($_POST['cookieType']);
                $cookie->setType($selectedType);
                $message = "Вы выбрали: " . $cookie->getType() . ".  " ."Оно есть в списке!";
            } catch (InvalidArgumentException $e) {
                $message = "Такого печенья нет. Пожалуйста, выберите другое.";
            }
        }
        ?>

        <form method="POST">
            <input type="text" name="cookieType" value="<?php echo htmlspecialchars($selectedType); ?>" placeholder="Введите вид печенья" required>
            <button type="submit">Выбрать</button>
        </form>

        <div class="error"><?php echo $message; ?></div>

        <?php
        $cookie = new Cookie();
        $cookie->displayAvailableTypes();
        ?>
    </div>
</body>
</html>
