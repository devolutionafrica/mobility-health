```
+-----------------+          +-----------------+          +-----------------+
|    Utilisateur  |          |   Souscription  |          | PoliceAssurance |
|-----------------|          |-----------------|          |-----------------|
| id (PK)         |<-------->| id (PK)         |<-------->| id (PK)         |
| nom             |          | user_id (FK)    |          | subscription_id |
| prénom          |          | date_souscription|         | num_police      |
| date_naissance  |          | date_début      |          | date_validation |
| nationalité     |          | date_fin        |          | statut          |
| pays_résidence  |          | destination     |          +-----------------+
| num_téléphone   |          | formule         |
| num_whatsapp    |          | statut          |
| role           |          +-----------------+
| email           |          +-----------------+
| mot_de_passe    |
| photo           |
| pièce_identité  |
| role            |
+-----------------+

+-----------------+          +-----------------+          +-----------------+
| Questionnaire   |          |    Paiement     |          | MédecinRéférent |
| Médical         |          |-----------------|          |-----------------|
|-----------------|          | id (PK)         |          | id (PK)         |
| id (PK)         |<-------->| subscription_id |          | nom             |
| user_id (FK)    |          | montant         |          | prénom          |
| réponses        |          | date_paiement   |          | spécialité      |
| date_soumission |          | méthode_paiement|          | num_téléphone   |
| statut          |          | statut          |          | email           |
+-----------------+          +-----------------+          | localisation    |
                                                         +-----------------+

+-----------------+          +-----------------+          +-----------------+
| PartenaireSanté |          |    Sinistre     |          |    Facture      |
|-----------------|          |-----------------|          |-----------------|
| id (PK)         |<-------->| id (PK)         |<-------->| id (PK)         |
| nom             |          | user_id (FK)    |          | claim_id (FK)   |
| adresse         |          | date_sinistre   |          | health_partner_id|
| num_téléphone   |          | localisation    |          | montant         |
| email           |          | description     |          | date_facture    |
| localisation    |          | statut          |          | statut          |
+-----------------+          +-----------------+          +-----------------+

+-----------------+
| CarteAssuré     |
|-----------------|
| id (PK)         |
| user_id (FK)    |
| num_carte       |
| date_émission   |
| date_expiration |
| statut          |
+-----------------+
