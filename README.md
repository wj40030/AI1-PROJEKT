# AI1-PROJEKT - Prosty Framework MVC w PHP

Projekt edukacyjny prezentujący implementację wzorca **MVC** (Model-View-Controller) oraz zasad **SOLID** w czystym PHP, bez użycia zewnętrznych bibliotek.

## Kluczowe Cechy
- **MVC Architecture**: Wyraźny podział na logikę biznesową (Models), interfejs użytkownika (Views) i kontrolę przepływu (Controllers).
- **Zasady SOLID**: Implementacja Dependency Injection (wstrzykiwanie bazy danych do modeli) oraz Single Responsibility.
- **Pure SQL**: Komunikacja z bazą danych odbywa się za pomocą czystych zapytań SQL przy użyciu klasy PDO.
- **Autoloading**: Automatyczne ładowanie klas na podstawie przestrzeni nazw (Namespaces).
- **Przyjazne adresy URL**: Dzięki konfiguracji `.htaccess`, adresy są czytelne (np. `/pages/about`).

## Wymagania
- XAMPP (lub inne środowisko z Apache, PHP 8.x i MySQL).

## Przygotowanie Bazy Danych
Aplikacja wymaga bazy danych o nazwie `ai1`. Możesz ją przygotować automatycznie:

1. Uruchom **XAMPP Control Panel** (Apache i MySQL).
2. Wejdź do **phpMyAdmin**: `http://localhost/phpmyadmin/`.
3. Kliknij zakładkę **Import**.
4. Wybierz plik `sql/setup.sql` znajdujący się w głównym katalogu projektu.
5. Kliknij **Wykonaj** (Go).

Skrypt utworzy bazę `ai1`, tabelę `posts` oraz doda przykładowe dane.

## Uruchomienie Projektu
1. Skopiuj folder `AI1-PROJEKT` do katalogu `htdocs` w folderze instalacyjnym XAMPP (zwykle `C:\xampp\htdocs\`).
2. Otwórz przeglądarkę i wejdź pod adres: `http://localhost/AI1-PROJEKT/`.

## Struktura Katalogów
- `app/` - Główny kod aplikacji.
    - `Controllers/` - Kontrolery obsługujące żądania.
    - `Models/` - Modele odpowiedzialne za dane i SQL.
    - `Views/` - Szablony HTML (widoki).
- `config/` - Pliki konfiguracyjne (połączenie z bazą, stałe).
- `core/` - Silnik frameworka (Router, bazowy Kontroler, klasa Database).
- `public/` - Punkt wejścia aplikacji (`index.php`) i pliki publiczne (CSS/JS).
- `sql/` - Skrypty inicjalizujące bazę danych.

## Konfiguracja
Jeśli Twoje ustawienia MySQL są inne niż domyślne (np. masz hasło do użytkownika root), zaktualizuj plik `config/config.php`:
```php
define('DB_USER', 'twój_użytkownik');
define('DB_PASS', 'twoje_hasło');
```
