CREATE TABLE enseignant (
    id_enseignant INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_enseignant TEXT NOT NULL,
    email TEXT
);

CREATE TABLE filliere (
    id_filliere INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_filliere TEXT NOT NULL,
    code_filliere TEXT NOT NULL
);