# IPMEDTH-Lakenhal back-end
Lakenhal MuseumMatch applicatie back-end IPMEDTH hogeschool Leiden

#### Probleemstelling
Kunst wordt vanuit één perspectief bekeken van een persoon. Mensen komen niet samen om over kunst te discussiëren. 
Het kan ook zijn dat mensen niemand hebben om mee samen naar het museum te gaan, om op die manier tot andere inzichten te komen over kunst.
Museum De Lakenhal wil hier graag verandering in brengen en heeft ons gevraagd iets te verzinnen om mensen samen te laten komen met kunst als verbindende factor.

# Beschrijving applicatie
De back-end van de applicatie is gebouwd met het framework Laravel. Volg de volgende stappen om de omgeving werkend te krijgen:
1. Clone de repository
2. Voer de command `composer install` uit. 
3. Het is nodig om een database te hebben waar alle informatie in kan worden opgeslagen. De details van deze database moeten in de _.env_ file worden verwerkt om verbinding te maken
4. Verander de volgende onderdelen in de _.env_ file: 
   ```
   DB_DATABASE=jouw database naam
   DB_USERNAME=jouw database username
   DB_PASSWORD=jouw database wachtwoord dat bij je gebruiker hoort
   
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=het gmail adres waarmee de Lakenhal emails wil versturen 
   MAIL_PASSWORD=het wachtwoord van dit gmail adres
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=het gmail adres waarmee de Lakenhal emails wil versturen
   MAIL_FROM_NAME="${APP_NAME}"
   ```
   De mail setup kan natuurlijk verschillen als er iets anders gebruikt wordt dan gmail.

4. Het aanmaken van alle database tables en het creeëren van de Lakenhal moderator user: `php artisan migrate --seed`
5. Om de authenticatie functionaliteit te laten werken: `php artisan key:generate`
6. Om de storage in laravel bereikbaar te maken: `php artisan storage:link`
7. Om de API te laten draaien voer de volgende command uit: `php artisan serve`

### Front-end
Voor de front-end zie de README van de repository [IPMEDTH-Lakenhal](https://github.com/mauricekoreman/IPMEDTH-Lakenhal)
