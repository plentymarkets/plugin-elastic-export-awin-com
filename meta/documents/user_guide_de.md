
# User Guide für das ElasticExportAwinCOM Plugin

<div class="container-toc"></div>

## 1 Bei Awin.com registrieren

Awin.com (früher zanox.de) bietet performance-basiertes Online- und Affiliate-Marketing an.

## 2 Das Format AwinCOM-Plugin in plentymarkets einrichten

Mit der Installation dieses Plugins erhalten Sie das Exportformat **AwinCOM-Plugin**, mit dem Sie Daten über den elastischen Export zu Awin übertragen. Um dieses Format für den elastischen Export nutzen zu können, installieren Sie zunächst das Plugin **Elastic Export** aus dem plentyMarketplace, wenn noch nicht geschehen. 

Sobald beide Plugins in Ihrem System installiert sind, kann das Exportformat **AwinCOM-Plugin** erstellt werden. Weitere Informationen finden Sie auf der Handbuchseite [Elastischer Export](https://knowledge.plentymarkets.com/daten/daten-exportieren/elastischer-export).

Neues Exportformat erstellen:

1. Öffnen Sie das Menü **Daten » Elastischer Export**.
2. Klicken Sie auf **Neuer Export**.
3. Nehmen Sie die Einstellungen vor. Beachten Sie dazu die Erläuterungen in Tabelle 1.
4. **Speichern** Sie die Einstellungen.
→ Eine ID für das Exportformat **AwinCOM-Plugin** wird vergeben und das Exportformat erscheint in der Übersicht **Exporte**.

In der folgenden Tabelle finden Sie Hinweise zu den einzelnen Formateinstellungen und empfohlenen Artikelfiltern für das Format **AwinCOM-Plugin**.

|**Einstellung**                                     |**Erläuterung** |
|:---                                                |:--- |
|**Einstellungen**                                   | |
|**Name**                                            |Name eingeben. Unter diesem Name erscheint das Exportformat in der Übersicht im Tab **Exporte**. |
|**Typ**                                             |Typ der Daten aus der Dropdown-Liste wählen, die exportiert werden sollen. |
|**Format**                                          |**AwinCOM-Plugin** wählen. |
|**Limit**                                           |Zahl eingeben. Wenn mehr als 9999 Datensätze übertragen werden sollen, wird die Ausgabedatei für 24 Stunden nicht noch einmal neu generiert, um Ressourcen zu sparen. Wenn mehr als 9999 Datensätze benötigt werden, muss die Option **Cache-Datei generieren** aktiv sein. |
|**Cache-Datei generieren**                          |Häkchen setzen, wenn mehr als 9999 Datensätze übertragen werden sollen. Um eine optimale Performance des elastischen Exports zu gewährleisten, darf diese Option bei maximal 20 Exportformaten aktiv sein. |
|**Bereitstellung**                                  |**URL** wählen. Mit dieser Option kann ein Token für die Authentifizierung generiert werden, damit ein externer Zugriff möglich ist. |
|**Token, URL**                                      |Wenn unter **Bereitstellung** die Option **URL** gewählt wurde, auf **Token generieren** klicken. Der Token wird dann automatisch eingetragen. Die URL wird automatisch eingetragen, wenn unter **Token** der Token generiert wurde. |
|**Dateiname**                                       |Der Dateiname muss auf .csv oder .txt enden, damit Awin die Datei erfolgreich importieren kann. |
|**Artikelfilter**                                   | |
|**Artikelfilter hinzufügen**                        |Wählen, welche Artikel beim Export übertragen werden sollen. Dazu Artikelfilter aus der Dropdown-Liste wählen und auf **Hinzufügen** klicken. Standardmäßig sind keine Filter voreingestellt. Es ist möglich, alle Artikelfilter aus der Dropdown-Liste nacheinander hinzuzufügen.<br/> **Varianten** = Wählen, welche Varianten übertragen werden sollen. **Alle übertragen** = Alle Varianten werden übertragen. **Nur Hauptvarianten übertragen** = Nur Hauptvarianten werden übertragen. **Keine Hauptvarianten übertragen** = Nur die Varianten eines Artikels werden übertragen. Hauptvarianten werden nicht übertragen. _Tipp:_ Verwenden, wenn due Hauptvarianten nur virtuell und keine verkaufbaren Produkte sind. **Nur Einzelvarianten übertragen** = Nur die Hauptvarianten von Artikeln werden übertragen, die nur eine Hauptvariante und keine Varianten haben.<br/> **Märkte** = Eine oder mehrere Auftragsherkünfte wählen. Die gewählten Auftragsherkünfte müssen an der Variante aktiviert sein, damit der Artikel exportiert wird.<br/> **Währung** = Währung wählen.<br/> **Kategorie** = Aktivieren, damit der Artikel mit Kategorieverknüpfung übertragen wird. Es werden nur Artikel, die dieser Kategorie angehören, übertragen.<br/> **Bild** = Aktivieren, damit der Artikel mit Bild übertragen wird. Es werden nur Artikel mit Bildern übertragen.<br/> **Mandant** = Mandant wählen.<br/> **Bestand** = Wählen, welche Bestände exportiert werden sollen.<br/> **Markierung 1-2** = Markierung wählen.<br/> **Hersteller** = Einen, mehrere oder **ALLE** Hersteller wählen.<br/> **Aktiv** = **Aktiv** wählen. Nur aktive Varianten werden übertragen. |
|**Formateinstellungen**                             | |
|**Produkt-URL**                                     |Wählen, ob die URL des Artikels oder der Variante übertragen wird. Varianten-URLs können nur in Kombination mit dem Ceres Webshop übertragen werden. |
|**Mandant**                                         |Mandanten wählen. Diese Einstellung wird für den URL-Aufbau verwendet. |
|**URL-Parameter**                                   |Suffix für die Produkt-URL eingeben, wenn ein Suffix für den Export erforderlich ist. Die Produkt-URL wird dann um die eingegebene Zeichenkette erweitert, wenn weiter oben die Option **übertragen** für die Produkt-URL aktiviert wurde. |
|**Auftragsherkunft**                                |Die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll. |
|**Marktplatzkonto**                                 |Marktplatzkonto aus der Dropdown-Liste wählen. Die Produkt-URL wird um die gewählte Auftragsherkunft erweitert, damit die Verkäufe später analysiert werden können. |
|**Sprache**                                         |Sprache aus der Dropdown-Liste wählen. |
|**Artikelname**                                     |**Name 1**, **Name 2** oder **Name 3** wählen. Die Namen sind im Tab **Texte** eines Artikels gespeichert. Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn die Schnittstelle eine Begrenzung der Länge des Artikelnamen beim Export vorgibt. |
|**Vorschautext**                                    |Wählen, ob und welcher Text als Vorschautext übertragen werden soll.<br/> Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn eine Begrenzung der Länge des Vorschautextes beim Export vorgegeben ist.<br/> Option **HTML-Tags entfernen** aktivieren, damit die HTML-Tags beim Export entfernt werden.<br/> Im Feld **Erlaubte HTML-Tags, kommagetrennt (def. Text)** optional die HTML-Tags eingeben, die beim Export erlaubt sind. Wenn mehrere Tags eingegeben werden, mit Komma trennen. |
|**Beschreibung**                                    |Wählen, welcher Text als Beschreibungstext übertragen werden soll.<br/> Im Feld **Maximale Zeichenlänge (def. Text)** optional eine Zahl eingeben, wenn eine Begrenzung der Länge der Beschreibung beim Export vorgegeben ist.<br/> Option **HTML-Tags entfernen** aktivieren, damit die HTML-Tags beim Export entfernt werden.<br/> Im Feld **Erlaubte HTML-Tags, kommagetrennt (def. Text)** optional die HTML-Tags eingeben, die beim Export erlaubt sind. Wenn mehrere Tags eingegeben werden, mit Komma trennen. |
|**Zielland**                                        |Zielland aus der Dropdown-Liste wählen. |
|**Barcode**                                         |ASIN, ISBN oder eine EAN aus der Dropdown-Liste wählen. Der gewählte Barcode muss mit der oben gewählten Auftragsherkunft verknüpft sein. Anderfalls wird der Barcode nicht exportiert. |
|**Bild**                                            |**Position 0** oder **Erstes Bild** wählen, um dieses Bild zu exportieren.<br/> **Position 0** = Ein Bild mit der Position 0 wird übertragen.<br/> **Erstes Bild** = Das erste Bild wird übertragen. |
|**Bildposition des Energieetiketts**                |Diese Option ist für dieses Format nicht relevant. |
|**Bestandspuffer**                                  |Der Bestandspuffer für Varianten mit Beschränkung auf den Netto-Warenbestand. |
|**Bestand für Varianten ohne Bestandsbeschränkung** |Der Bestand für Varianten ohne Bestandsbeschränkung. |  
|**Bestand für Varianten ohne Bestandsführung**      |Der Bestand für Varianten ohne Bestandsführung. |
|**Währung live umrechnen**                          |Aktivieren, damit der Preis je nach eingestelltem Lieferland in die Währung des Lieferlandes umgerechnet wird. Der Preis muss für die entsprechende Währung freigegeben sein. |
|**Verkaufspreis**                                   |Brutto- oder Nettopreis aus der Dropdown-Liste wählen. |
|**Angebotspreis**                                   |Diese Option ist für dieses Format nicht relevant. |
|**UVP**                                             |Aktivieren, um den UVP zu übertragen. |
|**Versandkosten**                                   |Aktivieren, damit die Versandkosten aus der Konfiguration übernommen werden. Wenn die Option aktiviert ist, stehen in den beiden Dropdown-Listen Optionen für die Konfiguration und die Zahlungsart zur Verfügung.<br/> Option **Pauschale Versandkosten übertragen** aktivieren, damit die pauschalen Versandkosten übertragen werden. Wenn diese Option aktiviert ist, muss im Feld darunter ein Betrag eingegeben werden. |
|**MwSt.-Hinweis**                                   |Diese Option ist für dieses Format nicht relevant. |
|**Artikelverfügbarkeit überschreiben**              |Option aktivieren und in die Felder **1** bis **10**, die die ID der Verfügbarkeit darstellen, Artikelverfügbarkeiten eintragen. Somit werden die Artikelverfügbarkeiten, die im Menü **System » Artikel » Verfügbarkeit** eingestellt wurden, überschrieben. |

_Tab. 1: Einstellungen für das Datenformat **AwinCOM-Plugin**_

## 3 Verfügbare Spalten der Exportdatei

|**Spaltenbezeichnung** |**Erläuterung** |
|:---                   |:--- |
|prod_number            |Die Varianten-ID der Variante. |
|prod_name              |Entsprechend der Formateinstellung **Artikelname**. |
|prod_price             |Hier steht der Verkaufspreis. |
|currency_symbol        |Der ISO3-Code für die Währung. |
|category               |Der Kategoriepfad der Standardkategorie für den in den Formateinstellungen definierten **Mandanten**. |
|prod_description       |Entsprechend der Formateinstellung **Vorschautext**. |
|prod_description_long  |Entsprechend der Formateinstellung **Beschreibung**. |
|img_small              |Preview-URL des Bildes. Variantenbilder werden vor Artikelbildern priorisiert. |
|img_medium             |Middle-URL des Bildes. Variantenbilder werden vor Artikelbildern priorisiert. |
|img_large              |URL des Bildes. Variantenbilder werden vor Artikelbildern priorisiert. |
|manufacturer           |Der **Name des Herstellers** des Artikels. Der **Externe Name** unter **Einstellungen » Artikel » Hersteller** wird bevorzugt, wenn vorhanden. |
|prod_url               |Der URL-Pfad des Artikels abhängig vom gewählten Mandanten in den Formateinstellungen. |
|prod_ean               |Entsprechend der Formateinstellung **Barcode**. |
|shipping_costs         |Entsprechend der Formateinstellung **Versandkosten**. |
|base_price             |Der Grundpreis entsprechend der Einheit. |
|base_price_amount      |Die Menge der Variante. |
|base_price_unit        |Die Einheit in Bezug auf den Grundpreis. |

## 4 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-awin-com/blob/master/LICENSE.md).
