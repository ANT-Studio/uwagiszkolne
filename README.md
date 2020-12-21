# Uwagi Szkolne

Uwagi szkolne to stona internetowa poświęcona śmiesznym lub ciekawym uwagom szkolnym (jak sama nazwa wskazuje).

Docelowo stonę będzie można znaleźć w domenie www.uwagiszkolne.pl.

Strona została wykonana za pomocą technologii Laravel 8 oraz Vue.js 3.

# Wersja deweloperska

## Projekt wymaga:

- npm
- composer
- php >= 7.4
- vue >= 3.0
- xampp

## Instalacja

Sklnouj repozytorium na komputer:
```
$ git clone https://github.com/ANT-Studio/uwagiszkolne.git
$ cd uwagiszkolne
```

Zainstaluj biblioteki front-endowe i back-endowe:
```
composer install
npm install
```
Następnie należy uruchomić serwer MySQL xampp i stworzyć bazę o dowolnej nazwie w panelu phpmyadmin (Wpisz w przeglądarkę: `localhost/phpmyadmin`).

Otwórz plik `.env.example` i ustaw opcję `DB_DATABASE` na nazwę stworzonej bazy. Następnie zmień nazwę tego pliku na `.env`.

Następnie otwórz terminal w folderze `uwagiszkolne` i wpisz:
```
php artisan key:generate
php artisan migrate
```

## Uruchomienie

Włacz serwer MySQL w xampp'ie.

Żeby uruchomić back-end na localhost otwórz terminal w folderze `uwagiszkolne` i wpisz:
```
php artisan serve
```

Żeby strona przeładowywała się odrazu po zmianie kodu (hot reload) otwórz kolejny terminal w folderze `uwagiszkolne` i wpisz:
```
npm run watch
```
lub:
```
mix run watch
```

# Aktualny stan

Aktualnie aplikacja jest w fazie produkcyjnym 

## Aplikacja zawiera:

- Logowanie
- Rejestracja
- Dodawanie uwag
- Wyświetlanie uwag

## Planowane funkcjonalności:

- Rankingi
- System like'ów
- Usuwanie uwag przez moderatorów
- Zabezpieczenia przed spamem
- Komentarze
- Profil użytkownika
- Uwagi użytkownika w profilu
