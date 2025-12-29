# PLUSFLIX - Agregator Streamingów

Projekt edukacyjny **PLUSFLIX** to wyszukiwarka filmów i seriali dostępnych na różnych platformach streamingowych. Aplikacja została zbudowana w architekturze **MVC** zgodnie z zasadami **SOLID** w czystym PHP.

## Kluczowe Funkcje
- **Wyszukiwarka**: Filtrowanie po tytule, kategorii i platformie streamingowej.
- **Parametry w URL**: Filtry są zapisywane w adresie URL, co pozwala na łatwe dzielenie się wynikami.
- **System Ocen**: Możliwość oceniania filmów (wymaga moderacji administratora).
- **Panel Administratora**: Zarządzanie bazą filmów i moderacja ocen (logowanie na stałe dane).
- **Autorski ORM**: Własna implementacja mapowania obiektowo-relacyjnego.
- **Responsywność**: Interfejs dostosowany do urządzeń mobilnych (Pure CSS).

## Wymagania
- XAMPP (Apache, PHP 8.x, MySQL).

## Przygotowanie Bazy Danych
1. Uruchom **XAMPP Control Panel** (Apache i MySQL).
2. Wejdź do **phpMyAdmin**: `http://localhost/phpmyadmin/`.
3. Zaimportuj plik `sql/setup.sql` (zakładka Import).
   - Skrypt utworzy bazę `ai1` oraz wszystkie potrzebne tabele i przykładowe dane.

## Konfiguracja
W pliku `config/config.php` możesz dostosować parametry połączenia z bazą danych oraz:
- **URLROOT**: Bazowy adres URL aplikacji (domyślnie `http://localhost`). Jeśli przenosisz projekt na inny serwer lub domenę, zaktualizuj tę wartość.

## Uruchomienie Projektu
1. Skopiuj zawartość folderu projektu bezpośrednio do głównego katalogu `htdocs` serwera Apache (tak aby pliki `app`, `core`, `public` były bezpośrednio w `htdocs`).
2. Otwórz w przeglądarce: `http://localhost/`.

## Panel Administratora
- **Dostęp**: Link nie jest widoczny w menu (należy wpisać adres ręcznie).
- **Adres**: `URLROOT /admin` (czyli `http://localhost/admin`)
- **Login**: `admin`
- **Hasło**: `admin123`

## Architektura i SOLID
- **S**ingle Responsibility: Oddzielne klasy dla bazy, routera, kontrolerów i modeli.
- **O**pen/Closed: System łatwy do rozbudowy o nowe platformy czy filtry.
- **L**iskov Substitution: Modele dziedziczą po bazowej klasie `Core\Model`.
- **I**nterface Segregation: Minimalistyczne metody w klasach bazowych.
- **D**ependency Inversion: Wstrzykiwanie zależności `Database` do modeli.

## Struktura Projektu
- `app/` - Kontrolery, Modele i Widoki specyficzne dla PLUSFLIX.
- `core/` - Silnik frameworka (Router, Controller, Model, Database).
- `public/` - Punkt wejścia (`index.php`) i obsługa sesji.
- `sql/` - Schemat bazy danych.
