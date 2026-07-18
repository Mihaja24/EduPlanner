<h1><?= isset($cours) ? 'Modifier' : 'Ajouter' ?> un cours</h1>
<?php if (session('errors')): ?>
    <ul class="errors">
        <?php foreach (session('errors') as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form
    action="<?= isset($cours) ? site_url('admin/cours/update/' . $cours['id_cours']) : site_url('admin/cours/create') ?>"
    method="post">
    <?php csrf_field() ?>
    <?php if (isset($cours)): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>

    <label for="titre">Titre</label>
    <input type="text" name="titre_cours" id="titre"
        value="<?= esc(old('titre_cours')) ?? ($cours['titre_cours'] ?? '') ?>">

    <label for="horaire">Volume horaire</label>
    <input type="number" name="volume_horaire" id="horaire"
        value="<?= esc(old('volume_horaire')) ?? ($cours['volume_horaire'] ?? '') ?>">

    <label for="coefficient">Coefficient</label>
    <input type="number" name="coefficient" id="coefficient" step="1"
        value="<?= esc(old('coefficient') ?? ($cours['coefficient']) ?? '1.00') ?>">

    <label for="enseignant">Enseignant: </label>
    <select name="id_enseignant" id="enseignant">
        <option value="">-- Choisir --</option>
        <?php foreach ($enseignants as $e) { ?>
            <option value="<?= esc($e['id_enseignant']) ?>" <?= (old('id_enseignant') ?? ($cours['id_enseignant'] ?? null)) == $e['id_enseignant'] ? 'selected' : '' ?>>
                <?= esc($e['nom_enseignant']) ?>
            </option>
        <?php } ?>
    </select>


    <label for="filiere">Filière</label>
    <select name="id_filliere" id="filiere">
        <option value="">-- Choisir --</option>
        <?php foreach ($filieres as $f): ?>
            <option value="<?= esc($f['id_filliere']) ?>" <?= (old('id_filliere') ?? ($cours['id_filliere'] ?? null)) == $f['id_filliere'] ? 'selected' : '' ?>>
                <?= esc($f['nom_filliere']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit"><?= isset($cours) ? 'Modifier' : 'Ajouter' ?></button>
</form>