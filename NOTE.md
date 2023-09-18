# TODO

- [ ] Changer nom de fichier pour mieux m'y retrouver.
- [ ] Ajouter table Acteurs/Réalisateurs (id, nom, prénom, date de naissance, biographie, avis, statut)
- [ ] Ajouter table Films (id,titre, année, genre, 🔑id_acteur)
- [ ] Ajouter table commentaires (titre, description, 🔑id_film)

```mermaid
erDiagram
    Act_Real }o--o{ Films : "actor of"
    Films ||--o{ Commentaires : has
    Utilisateurs ||--o{ Commentaires : has
    Utilisateurs {
        int id_user PK
        string(100) pseudo
        string(100) email
        string(255) password

    }
    Act_Real {
        int id_act_real PK
        string(255) last_name
        string(255) first_name
        datetime birthday
    }
    Films {
        int id_films PK
        string(255) title
        int(4) year
        string(255) genre
        int id_act_real FK

    }
    Commentaires{
        int id_coment PK
        string(255) title
        string(255) description
        int id_film FK
        int id_user FK
    }
```
