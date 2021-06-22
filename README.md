# IPMEDTH-Lakenhal back-end
Lakenhal MuseumMatch applicatie back-end IPMEDTH hogeschool Leiden

## Inhoud
- [Probleemstelling](#probleemstelling)
- [Installatie](#installatie)
- [API Routes](#api-routes)
   - [User routes](#user-routes)
   - [Activiteiten routes](#activiteiten-routes)
   - [Categorieën routes](#categorieën-routes)
   - [Groepschat routes](#groepschat-routes)
   - [Rapporteer activiteit routes](#rapporteer-activiteit-routes)
   - [Authenticatie routes](#authenticatie-routes)

### Probleemstelling
Kunst wordt vanuit één perspectief bekeken van een persoon. Mensen komen niet samen om over kunst te discussiëren. 
Het kan ook zijn dat mensen niemand hebben om mee samen naar het museum te gaan, om op die manier tot andere inzichten te komen over kunst.
Museum De Lakenhal wil hier graag verandering in brengen en heeft ons gevraagd iets te verzinnen om mensen samen te laten komen met kunst als verbindende factor.

### Installatie
De back-end van de applicatie is gebouwd met het PHP framework Laravel. Volg de volgende stappen om de omgeving werkend te krijgen:
1. Clone de repository
```
$ git clone https://github.com/samirtown/API_LakenhalMatched.git
```
2. Ga in het project
```
$ cd API_LakenhalMatched
```
3. Installeer de dependencies
```
~/API_LakenhalMatched$ composer install
```
4. Genereer een APP_KEY 
```
~/API_LakenhalMatched$ php artisan key:generate
```
5. Configureer het .env bestand door de volgende onderdelen te wijzigen
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jouw database naam
DB_USERNAME=jouw database username
DB_PASSWORD=jouw database wachtwoord dat bij je gebruiker hoort
  
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=jouwmail@gmail.com 
MAIL_PASSWORD=wachtwoordVanJouwMail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=jouwMail@gmail.com
```
6. Voer de migrations uit om de database tabellen aan te maken
```
~/API_LakenhalMatched$ php artisan migrate
```
7. Om authenticatie te laten werken moet een client gecreëerd worden
```
~/API_LakenhalMatched$ php artisan passport:install
```
9. Om de storage in laravel bereikbaar te maken: 
```
~/API_LakenhalMatched$ php artisan storage:link
```
11. Laat de API nu draaien
```
~/API_LakenhalMatched$ php artisan serve
```

### API Routes
###### User routes
- GET /users
- GET /users{user_ID}
- PUT users/update/{user_ID}
- PUT users/updateKenmerk/{user_ID}
- PUT users/deleteKenmerk/{user_ID}
- POST users/profielFotoUpload/{user_ID}

###### Activiteiten routes
- GET /activiteit
- GET /activiteit/{activiteit_ID}
- GET /activiteitenUsers
- GET /activiteitenUsersProfiel/{user_ID}
- GET /activiteitenGerapporteerd
- POST /activiteit
- PATCH /activiteit/verwijderRapportage/{activiteit_ID}
- DELETE /activiteit{activiteit_ID}

###### Categorieën routes
- GET /categorie
- GET /categorie/{categorie}
- POST /categorie/store
- DELETE /categorie/delete/{categorie_ID}

###### Groepschat routes
- GET /inschrijvingen
- GET /inschrijvingen/user/{user_ID}
- GET /inschrijvingen/activiteit/{activiteit_ID}
- GET /ingeschreven/activiteitUser/{activiteit_ID}
- PUT /inschrijvingen/activiteit/{activiteit_ID}/{user_ID}
- POST /inschrijvingen

###### Rapporteer activiteit routes
- GET /rapporteerActiviteit}
- GET /rapporteerActiviteit/{activiteit_ID}
- POST /activiteit/rapporteer

###### Authenticatie routes
- GET /auth/view-profile
- GET /auth/logout
- POST /auth/register
- POST /auth/login
- POST /auth/forgot-password
- POST /auth/reset-password

### Front-end
Voor de front-end zie de README van de repository [IPMEDTH-Lakenhal](https://github.com/mauricekoreman/IPMEDTH-Lakenhal)
