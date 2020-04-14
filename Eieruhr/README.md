# Eieruhr
Beschreibung des Moduls.

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
* Kontrollierbar über das WebFront 

### 2. Vorraussetzungen

- IP-Symcon ab Version 5.0

### 3. Software-Installation

* Über den Module Store das 'Eieruhr'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen: https://github.com/symcon/Eieruhr

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' ist das 'Eieruhr'-Modul unter dem Hersteller '(Gerät)' aufgeführt.

__Konfigurationsseite__:

Name                     | Beschreibung
------------------------ | ------------------
Aktualisierungsintervall | Der Intervall in dem die verbleibende Zeit aktualisiert wird
TestCenter               | Hier können alle schaltbaren Statusvariablen geschaltet werden

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name             | Typ     | Beschreibung
---------------- | ------- | ------------
Aktiv            | boolean | Legt fest ob die Eieruhr läuft oder nicht
Zeit in Sekunden | integer | Die Dauer in Sekunden welche die Eieruhr läuft
Verbleibend      | string  | Zeigt die verbleibende Zeit der laufenden Eieruhr an

#### Profile

Es werden keine zusätzlichen Profile angelegt

### 6. WebFront

Im WebFront kann die Laufzeit der Eieruhr eingestellt und de-/aktiviert werden

### 7. PHP-Befehlsreferenze

Es werden keine zusätzlichen Befehle hinzugefügt