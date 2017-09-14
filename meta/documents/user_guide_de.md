
# User Guide für das ElasticExportAwinCOM Plugin

<div class="container-toc"></div>

## 1 Bei Awin.com registrieren

Awin.com (früher zanox.de) bietet performance-basiertes Online- und Affiliate-Marketing an.

## 2 Das Format AwinCOM-Plugin in plentymarkets einrichten

Um dieses Format nutzen zu können, benötigen Sie das Plugin Elastic Export.

Auf der Handbuchseite [Daten exportieren](https://www.plentymarkets.eu/handbuch/datenaustausch/daten-exportieren/#4) werden die einzelnen Formateinstellungen beschrieben.

In der folgenden Tabelle finden Sie Hinweise zu den Einstellungen, Formateinstellungen und empfohlenen Artikelfiltern für das Format **AwinCOM-Plugin**.
<table>
    <tr>
        <th>
            Einstellung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Einstellungen
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            <b>AwinCOM-Plugin</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Bereitstellung
        </td>
        <td>
            <b>URL</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Dateiname
        </td>
        <td>
            Der Dateiname muss auf <b>.csv</b> oder <b>.txt</b> enden, damit Kauflux.de die Datei erfolgreich importieren kann.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Artikelfilter
        </td>
    </tr>
    <tr>
        <td>
            Aktiv
        </td>
        <td>
            <b>Aktiv</b> wählen.
        </td>        
    </tr>
    <tr>
        <td>
            Märkte
        </td>
        <td>
            Eine oder mehrere Auftragsherkünfte wählen. Die gewählten Auftragsherkünfte müssen an der Variante aktiviert sein, damit der Artikel exportiert wird.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Formateinstellungen
        </td>
    </tr>
    <tr>
        <td>
            Auftragsherkunft
        </td>
        <td>
            Die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll.
        </td>        
    </tr>
    <tr>
        <td>
            Angebotspreis
        </td>
        <td>
            Diese Option ist für dieses Format nicht relevant.
        </td>        
    </tr>
    <tr>
        <td>
            MwSt.-Hinweis
        </td>
        <td>
            Diese Option ist für dieses Format nicht relevant.
        </td>        
    </tr>
</table>

## 3 Übersicht der verfügbaren Spalten

<table>
    <tr>
        <th>
            Spaltenbezeichnung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
		<td>
			prod_number
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Varianten-ID</b> der Variante.
		</td>        
	</tr>
	<tr>
		<td>
			prod_name
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Artikelname</b>.
		</td>        
	</tr>
	<tr>
		<td>
			prod_price
		</td>
		<td>
			<b>Inhalt:</b> Hier steht der <b>Verkaufspreis</b>.
		</td>        
	</tr>
	<tr>
		<td>
			currency_symbol
		</td>
		<td>
			<b>Inhalt:</b> Der ISO3 Code für die <b>Währung</b>.
		</td>        
	</tr>
	<tr>
		<td>
			category
		</td>
		<td>
			<<b>Inhalt:</b> Der <b>Kategorie-Pfad</b> der Standard-Kategorie für den in den Formateinstellungen definierten <b>Mandanten</b>.
		</td>        
	</tr>
	<tr>
		<td>
			prod_description
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Vorschautext</b>.
		</td>        
	</tr>
	<tr>
		<td>
			prod_description_long
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Beschreibung</b>.
		</td>        
	</tr>
	<tr>
		<td>
			img_small
		</td>
		<td>
			<b>Inhalt:</b> Preview URL des Bildes. Variantenbiler werden vor Artikelbildern priorisiert.
		</td>        
	</tr>
	<tr>
		<td>
			img_medium
		</td>
		<td>
			<b>Inhalt:</b> Middle URL des Bildes. Variantenbiler werden vor Artikelbildern priorisiert.
		</td>        
	</tr>
	<tr>
		<td>
			img_large
		</td>
		<td>
			<b>Inhalt:</b> URL des Bildes. Variantenbiler werden vor Artikelbildern priorisiert.
		</td>        
	</tr>
	<tr>
		<td>
			manufacturer
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Name des Herstellers</b> des Artikels. Der <b>Externe Name</b> unter <b>Einstellungen » Artikel » Hersteller</b> wird bevorzugt, wenn vorhanden.
		</td>        
	</tr>
	<tr>
		<td>
			prod_url
		</td>
		<td>
			<b>Inhalt:</b> Der <b>URL-Pfad</b> des Artikels abhängig vom gewählten <b>Mandanten</b> in den Formateinstellungen.
		</td>        
	</tr>
	<tr>
		<td>
			prod_ean
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Barcode</b>.
		</td>        
	</tr>
	<tr>
		<td>
			shipping_costs
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Versandkosten</b>.
		</td>        
	</tr>
	<tr>
		<td>
			base_price
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Grundpreis</b> entsprechend der <b>Einheit</b>. 
		</td>        
	</tr>
	<tr>
		<td>
			base_price_amount
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Menge</b> der Variante.
		</td>
	</tr>
	<tr>
		<td>
			base_price_unit
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Einheit</b> in Bezug auf den <b>Grundpreis</b>.
		</td>        
	</tr>
</table>

## 4 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-awin-com/blob/master/LICENSE.md).
