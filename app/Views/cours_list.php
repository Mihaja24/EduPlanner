<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Catalogue des cours</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Cours</th>
                <th>Horaire</th>
                <th>coefficient</th>
                <th>Enseignant</th>
                <th>Filliere</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($les_cours as $unCours): ?>
                <tr>
                    <td><?= esc($unCours['titre_cours']) ?></td>
                    <td><?= esc($unCours['volume_horaire'])?></td>
                    <td><?= esc($unCours['coefficient'])?></td>
                    <td><?= esc($unCours['nom_enseignant'])?></td>
                    <td><?= esc($unCours['nom_filliere'])?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>