<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des cours</title>
</head>
<body>
    <h1>Gestion des cours</h1>

    <p>
        <a href="<?= site_url('admin/cours/new') ?>">Ajouter un cours</a>
    </p>

    <?php if (session('success')): ?>
        <p><?= esc(session('success')) ?></p>
    <?php endif; ?>

    <?php if (session('errors')): ?>
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Horaire</th>
                <th>Coefficient</th>
                <th>Enseignant</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($les_cours)): ?>
                <tr>
                    <td colspan="6">Aucun cours trouvé.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($les_cours as $unCours): ?>
                    <tr>
                        <td><?= esc($unCours['titre_cours']) ?></td>
                        <td><?= esc($unCours['volume_horaire']) ?></td>
                        <td><?= esc($unCours['coefficient']) ?></td>
                        <td><?= esc($unCours['nom_enseignant']) ?></td>
                        <td><?= esc($unCours['nom_filliere']) ?></td>
                        <td>
                            <a href="<?= site_url('admin/cours/edit/' . $unCours['id_cours']) ?>">Modifier</a>
                            <form action="<?= site_url('admin/cours/delete/' . $unCours['id_cours']) ?>" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ce cours ?');" style="display:inline;">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($totalPages > 1): ?>
        <p>
            <?php if ($hasPrevious): ?>
                <a href="<?= site_url('admin/cours?page=' . ($page - 1)) ?>">Précédent</a>
            <?php endif; ?>

            <span>Page <?= $page ?> sur <?= $totalPages ?></span>

            <?php if ($hasNext): ?>
                <a href="<?= site_url('admin/cours?page=' . ($page + 1)) ?>">Suivant</a>
            <?php endif; ?>
        </p>
    <?php endif; ?>
</body>
</html>
