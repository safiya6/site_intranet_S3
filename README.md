
# SAE S3 groupe HKMT




Repository GitLab appartenant à l'équipe HKMT du groupe Topaze pour la SAE S3.01.





Le repertoire Autoformation permet aux membres de l'équipe de commit les pages PHP qui ont été codé dans le cadre de l'autoformation pour la SAE.
Les pages sont sensé couvrir les quatre opérations de base pour la persistance des données (CRUD).

le repertoire applicationWeb contient tout le code de la version finale du projet.
## Features

- CAS de l'universitée
- Chiffrement dans la bdd
- Outils de visualisation pour les enseignants
- Ajout et suppression de professeurs
- Ajout et suppression de formation
- Interface differentes en fonction du login

## groupe


- Boutajar Houssna
- Azouagh Safiya
- Jedorowicz Tom
- Bouazzaoui Soheib 
- Zidee Johann
- Aublet Arnaud

## Exemple de  couples login/mdp pour se connecter au service 

- directeur :(1010100 / mdp123)
- secrétaire : (1010102 / mdp789)
- chef de departement : (1010115 / mdp159)
- équipe de direction : (1010106 / mdp147)
- enseignant: (1010103 / mdp321)


## Tester la page depuis l'IUT


```bash
http://pedagoweb/~12200893/
```

## Tester la page depuis l'IUT manuellement (déconseillé)

```bash
  git clone https://gitlab.sorbonne-paris-nord.fr/12200893/app-web-hkmt.git
```

changer les informations dans credentials.php
```bash
  $login,$mdp,$dsn
```

importer la bdd sur votre sgbd postgresql
```postgresql
\i superBDD.sql
```
chiffrer les mdps en utilisant la page dédié
```bash
  ./testRSA/RSAmodule.php
```


