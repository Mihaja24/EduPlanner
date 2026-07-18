PRAGMA foreign_keys = ON;
CREATE TABLE cours (
    id_cours INTEGER PRIMARY KEY AUTOINCREMENT,
    titre_cours VARCHAR(150) NOT NULL,
    volume_horaire INTEGER NOT NULL,
    coefficient DECIMAL(4, 2) NOT NULL DEFAULT 1.00,
    id_enseignant INTEGER NOT NULL,
    id_filliere INTEGER NOT NULL,
    FOREIGN KEY (id_enseignant) REFERENCES enseignant(id_enseignant) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_filliere) REFERENCES filiere(id_filliere) ON DELETE RESTRICT ON UPDATE CASCADE
);
CREATE INDEX idx_cours_enseignant ON cours(id_enseignant);
CREATE INDEX idx_cours_filiere ON cours(id_filliere);