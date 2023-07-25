# Eieruhr
Eine Eieruhr, die eine gewisse Zeit läuft und jederzeit wieder aufgezogen werden kann. Ideal für die Verwendung in Ereignissen und Skripten.

### Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)
6. [WebFront](#6-webfront)
7. [PHP-Befehlsreferenz](#7-php-befehlsreferenz)

### 1. Funktionsumfang

* Eine einfache Eieruhr
* Jederzeit wieder aufziehbar
* Läuft eine einstellbare Zeit
* Kontrollierbar über das WebFront 
* Einfache Integration in Ereignisse und Skripte über die Aktiv-Variable

### 2. Voraussetzungen

- IP-Symcon ab Version 5.0

### 3. Software-Installation

* Über den Module Store das 'Eieruhr'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen: https://github.com/symcon/Eieruhr

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' ist das 'Eieruhr'-Modul unter dem Hersteller '(Gerät)' aufgeführt.

__Konfigurationsseite__:

Name                     | Beschreibung
------------------------ | ------------------
Aktualisierungsintervall | Das Intervall in dem die verbleibende Zeit aktualisiert wird (Wenn das gewählte Intervall größer als die verbleibende Zeit ist, wird "Aktiv" erst dann wieder auf false gesetzt, wenn das Intervall abgelaufen ist)

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name             | Typ     | Beschreibung
---------------- | ------- | ------------
Aktiv            | boolean | Legt fest ob die Eieruhr läuft oder nicht; Erneutes Setzen startet die Uhr neu
Zeit in Sekunden | integer | Die Dauer in Sekunden welche die Eieruhr läuft; Nach Ablauf der Zeit wird "Aktiv" auf false gesetzt 
Verbleibend      | string  | Zeigt die verbleibende Zeit der laufenden Eieruhr an
Abgebrochen      | boolean | Zeigt an ob die Variable Aktiv vor Ablauf der Zeit wieder ausgeschaltet und somit der Timer abgebrochen wurde.

#### Profile

Es werden keine zusätzlichen Profile angelegt

### 6. WebFront

Im WebFront kann die Laufzeit der Eieruhr eingestellt und de-/aktiviert werden

### 7. PHP-Befehlsreferenze

Es werden keine zusätzlichen Befehle hinzugefügt
