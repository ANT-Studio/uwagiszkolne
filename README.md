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

## Uruchomienie

Żeby uruchomić back-end na localhost otwórz terminal w folderze `uwagiszkolne` i wpisz:
```
php artisan serve
```

Żeby strona przeładowywała się odrazu po zmianie kodu (hot reload) otwórz kolejny termina w folderz `uwagiszkolne` i wpisz:
```
npm run watch
```
lub:
```
mix run watch
```

Należy również utworzyć serwer oraz bazę danych MySQL w xampp'ie (adres: `localhost/phpmyadmin`).
Następnie należy ustawić dane serwera w pliku `.env.example` i zmienić nazwę tego pliku na `.env`

Przy pierwszym uruchomieniu należy otworzyć okno terminala w folderze `uwagiszkolne` i wpisać:
```
php artisan migrate
```
Nie trzeba wykonywać tego polecenia jeśli nie zmienia się struktury bazy danych przy następnych uruchomieniach

# Aktualny stan

Aktualnie aplikacja jest w fazie produkcyjnym 

## Aplikacja zawiera:

- Logowanie
- Rejestracja
- Dodawanie uwag

## Planowane funkcjonalności:

- Wyświetlanie uwag
- Rankingi
- System like'ów
- Usuwanie uwag przez moderatorów
- Zabezpieczenia przed spamem
- Komentarze
- Profil użytkownika
- Uwagi użytkownika w profilu
