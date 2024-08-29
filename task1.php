<?php

$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];

$scores = [];

foreach ($data as $entry) {
    $student = $entry[0];
    $subject = $entry[1];
    $score = $entry[2];

    $scores[$student][$subject] += $score;
}

$subjects = array_unique(array_column($data, 1));
sort($subjects);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th></th>
        <?php foreach ($subjects as $subject): ?>
            <th><?= htmlspecialchars($subject) ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($scores as $student => $studentScores): ?>
        <tr>
            <td><?= htmlspecialchars($student) ?></td>
            <?php foreach ($subjects as $subject): ?>
                <td><?= htmlspecialchars($studentScores[$subject]) ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>