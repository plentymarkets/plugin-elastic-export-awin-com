
# ElasticExportAwinCOM plugin user guide

<div class="container-toc"></div>

## 1 Registering with Awin.com

Awin.com (former zanox.de) offers performance-based online and affiliate marketing.

## 2 Setting up the data format AwinCOM-Plugin in plentymarkets

The plugin Elastic Export is required to use this format.

Refer to the [Exporting data formats for price search engines](https://knowledge.plentymarkets.com/en/basics/data-exchange/exporting-data#30) page of the manual for further details about the individual format settings.

The following table lists details for settings, format settings and recommended item filters for the format **AwinCOM-Plugin**.
<table>
    <tr>
        <th>
            Settings
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Settings
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            Choose <b>AwinCOM-Plugin</b>.
        </td>        
    </tr>
    <tr>
        <td>
            Provisioning
        </td>
        <td>
            Choose <b>URL</b>.
        </td>        
    </tr>
    <tr>
        <td>
            File name
        </td>
        <td>
            The file name must have the ending <b>.csv</b> or <b>.txt</b> for kauflux.de to be able to import the file successfully.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Item filter
        </td>
    </tr>
    <tr>
        <td>
            Active
        </td>
        <td>
            Choose <b>active</b>.
        </td>        
    </tr>
    <tr>
        <td>
            Markets
        </td>
        <td>
            Choose one or multiple order referrers. The chosen order referrer has to be active at the variation for the item to be exported.
        </td>        
    </tr>
    <tr>
        <td class="th" colspan="2">
            Format settings
        </td>
    </tr>
    <tr>
        <td>
            Order referrer
        </td>
        <td>
            Choose the order referrer that should be assigned during the order import.
        </td>        
    </tr>
    <tr>
        <td>
            Preview text
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
    <tr>
        <td>
            Offer price
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
    <tr>
        <td>
            VAT note
        </td>
        <td>
            This option is not relevant for this format.
        </td>        
    </tr>
</table>

## 3 Overview of available columns

<table>
    <tr>
        <th>
            Column name
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
		<td>
			prod_number
		</td>
		<td>
			<b>Content:</b> The <b>variation ID</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			prod_name
		</td>
		<td>
			<b>Content:</b> According to the format setting <b>item name</b>.
		</td>        
	</tr>
	<tr>
		<td>
			prod_price
		</td>
		<td>
			<b>Content:</b> The <b>sales price</b> of the variation.
		</td>        
	</tr>
	<tr>
		<td>
			currency_symbol
		</td>
		<td>
			<b>Content:</b> The ISO3 Code for the <b>currency</b>.
		</td>        
	</tr>
	<tr>
		<td>
			category
		</td>
		<td>
			<b>Content:</b> The names of the categories that are linked to the variation separeted with >.
		</td>        
	</tr>
	<tr>
		<td>
			prod_description
		</td>
		<td>
			<b>Content:</b> According to the format setting <b>Preview test</b>.
		</td>        
	</tr>
	<tr>
		<td>
			prod_description_long
		</td>
		<td>
			<b>Content:</b> According to the format setting <b>Description</b>.
		</td>        
	</tr>
	<tr>
		<td>
			img_small
		</td>
		<td>
			<b>Content:</b> The image preview URL. Variation images are prioritizied over item images.
		</td>        
	</tr>
	<tr>
		<td>
			img_medium
		</td>
		<td>
			<b>Content:</b> The image middle URL.Variation images are prioritizied over item images.
		</td>        
	</tr>
	<tr>
		<td>
			img_large
		</td>
		<td>
			<b>Content:</b> The image  URL. Variation images are prioritizied over item images.
		</td>        
	</tr>
	<tr>
		<td>
			manufacturer
		</td>
		<td>
			<b>Content:</b> The <b>name of the manufacturer</b> of the item. The <b>external name</b> in the menu <b>Settings » Items » Manufacturer</b> will be preferred if existing.
		</td>        
	</tr>
	<tr>
		<td>
			prod_url
		</td>
		<td>
			<b>Content:</b> The <b>URL path</b> of the item depending on the chosen <b>client</b> in the format settings.
		</td>        
	</tr>
	<tr>
		<td>
			prod_ean
		</td>
		<td>
			<b>Content:</b> According to the format setting <b>Barcode</b>.
		</td>        
	</tr>
	<tr>
		<td>
			shipping_costs
		</td>
		<td>
			<b>Content:</b> According to the format setting <b>shipping costs</b>.
		</td>        
	</tr>
	<tr>
		<td>
			base_price
		</td>
		<td>
			<b>Content:</b> The base price based on the <b>base_price_unit</b>. 
		</td>        
	</tr>
	<tr>
		<td>
			base_price_amount
		</td>
		<td>
			<b>Content:</b> The <b>Lot</b> of the variation.
		</td>
	</tr>
	<tr>
		<td>
			base_price_unit
		</td>
		<td>
			<b>Content:</b> The <b>Unit</b> based on the <b>base_price</b>.
		</td>        
	</tr>
</table>

## 4 License

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE.- find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-awin-com/blob/master/LICENSE.md).
