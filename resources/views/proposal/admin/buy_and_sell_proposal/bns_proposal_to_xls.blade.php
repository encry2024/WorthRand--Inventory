<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <tr>
            <td>PURCHASE ORDER NUMBER</td>
            <td style="text-align: left;">{{ $buyAndSellProposal->purchase_order != '' ? $buyAndSellProposal->purchase_order : '' }}</td>
        </tr>

        <tr>
            <td>WPC NUMBER/REFERENCE</td>
            <td style="text-align: left;">{{ $buyAndSellProposal->wpc_reference != '' ? $buyAndSellProposal->wpc_reference : '' }}</td>
        </tr>

        <tr>
            <td>TO:</td>
            <td>{{ $buyAndSellProposal->customer->name }}</td>
        </tr>

        <tr>
            <td></td>
            <td>{{ $buyAndSellProposal->customer->address }}</td>
        </tr>

        <tr>
            <td>INVOICE TO:</td>
            <td>{{ $buyAndSellProposal->invoice_to != '' ? $buyAndSellProposal->invoice_to : '' }}</td>
        </tr>
        <tr>
            <td></td>
            <td>{{ $buyAndSellProposal->invoice_to_address != '' ? $buyAndSellProposal->invoice_to_address : '' }}</td>
        </tr>

        <tr>
            <td>QRC REFERENCE:</td>
            <td>{{ $buyAndSellProposal->qrc_ref != '' ? $buyAndSellProposal->qrc_ref : '' }}</td>
        </tr>


        <tr></tr>
        <tr></tr>
        <tr></tr>

        <table>
            <tr>
                <th><b>Item #</b></th>

                <th><b>Material Code</b></th>

                <th><b>Description</b></th>

                <th><b>Quantity</b></th>

                <th><b>Price</b></th>

                <th><b>Delivery</b></th>
            </tr>
            @foreach($selectedItems as $selectedItem)
                <tr >
                    <td>{{ ++$ctr }}</td>
                    <td>{{ $selectedItem->project_mn != "" ? $selectedItem->project_mn : $selectedItem->after_market_mn }}</td>
                    <td  style="text-align: left;">
                        <b>NAME:&nbsp;</b> {{ $selectedItem->project_name != "" ? $selectedItem->project_name : $selectedItem->after_market_name }}
                        <br>
                        <b>PN:&nbsp;</b> {{ $selectedItem->project_pn != "" ? $selectedItem->project_pn : $selectedItem->after_market_pn }}
                        <br>
                        <b>MODEL NO.:&nbsp;</b> {{ $selectedItem->project_md != "" ? $selectedItem->project_md : $selectedItem->after_market_md }}
                        <br>
                        <b>DWG NO.:&nbsp;</b> {{ $selectedItem->project_dn != "" ? $selectedItem->project_dn : $selectedItem->after_market_dn }}
                        <br>
                        <b>TAG NO.:&nbsp;</b> {{ $selectedItem->project_tn != "" ? $selectedItem->project_tn : $selectedItem->after_market_tn }}
                    </td>
                    <td>{{ $selectedItem->quantity != "" ? $selectedItem->quantity : $selectedItem->after_market_price }}</td>
                    <td>{{ $selectedItem->project_price != "" ? $selectedItem->project_price : $selectedItem->after_market_price }}</td>
                    <td>
                        {{ $selectedItem->delivery != "" ? $selectedItem->delivery : $selectedItem->delivery }}
                    </td>
                </tr>
            @endforeach
        </table>

        <tr></tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <td><b><i>VALIDITY:</i></b></td>
            <td>{{ $buyAndSellProposal->validity != '' ? $buyAndSellProposal->validity : '' }}</td>
        </tr>

        <tr>
            <td><b>PAYMENT TERMS:</b></td>
            <td>{{ $buyAndSellProposal->payment_terms != '' ? $buyAndSellProposal->payment_terms : '' }}</td>
        </tr>

    </body>
</html>