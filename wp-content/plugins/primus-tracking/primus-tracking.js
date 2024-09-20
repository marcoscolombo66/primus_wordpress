(function () {
    var links = document.getElementsByClassName('primus-tracking-menu');
    var form = document.getElementById('primus-tracking')
    var inputId = document.getElementById('trackingNumber');
    var closeButton = document.getElementById('primus-tracking-close');
    var searchButton = document.getElementById('primus-tracking-button');

    var modal = document.getElementById("primus-tracking-modal");
    var modalContent = document.getElementById('primus-tracking-modal-body');
    var modalClose = document.getElementsByClassName("primus-tracking-modal-close")[0];

    function addListenerToLink(link) {
        link.addEventListener('click', function (e) {
            form.classList.remove('hide');
            form.classList.add('visible');
            e.preventDefault();
        })
    }

    for (var index = 0; index < links.length; index++) {
        var element = links[index];
        addListenerToLink(element);
    }

    closeButton.addEventListener('click', function (e) {
        form.classList.remove('visible');
        form.classList.add('hide');
        e.preventDefault();
    });

    modalClose.addEventListener('click', function (e) {
        modal.style.display = "none";
        e.preventDefault();
    });

    searchButton.addEventListener('click', function (e) {
        var loading = '<div style="display: flex;text-align: center;align-items: center;width: 160px;margin: 0 auto;">Sending...<div class="sk-folding-cube sk-folding-cube-inline sk-folding-cube-small"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div></div>';
        modalContent.innerHTML = loading;
        modal.style.display = "block";


        jQuery.ajax({
            // crossDomain:true,
            type: "POST",
            url: primustrakingdir + 'primus-tracking-call.php',
            data: { id: inputId.value },
            success: function (datos) {
                var result = JSON.parse(datos);
                if (result.Error) {
                    modalContent.innerHTML = '<div>' + result.Error + '</div>';
                    e.preventDefault();
                    return false;
                }
                var html = '';
                if (result !== '') {
                    html = buildModal(result.Result);
                    modalContent.innerHTML = html;
                }
            },
            //dataType: "json" // El tipo de datos esperados del servidor. Valor predeterminado: Intelligent Guess (xml, json, script, text, html).
        })
        e.preventDefault();
    })

    function buildModal(data) {
        var html = '';
        html += '<div>';

        html += '<div class="info info-1">';
        html += '<span><strong>BOL: </strong>#' + data.BOL + '</span>';
        html += '<span><strong>PRO: </strong>#' + data.Carrier.carrierRef + '</span>';
        html += '<span><strong>Pieces: </strong>' + data.FreightInformation.TotalPieces + '</span>';
        html += '<span><strong>Weight: </strong>' + data.FreightInformation.TotalWeight + '</span>';
        html += '</div>';

        html += '<div class="info info-2">';
        html += '<span><strong>Origin: </strong>' + data.Shipper.City + ', ' + data.Shipper.State + ' ' + data.Shipper.ZipCode + '</span>';
        html += '<span><strong>Destination: </strong>' + data.Consignee.City + ', ' + data.Consignee.State + ' ' + data.Consignee.ZipCode + '</span>';
        html += '</div>';

        html += '<div class="info info-3">';
        html += '<span><strong>Carrier: </strong>' + data.Carrier.CarrierName + '</span>';
        html += '<span><strong>Destination: </strong>' + data.Carrier.SCAC + '</span>';
        html += '</div>';

        html += '';
        html += '</div>';

        html += '<div style="margin-top: 25px;">';
        html += '<h3>Tracking Information</h3>';
        html += '<div id="primus-tracking-table-container">';
        html += '<table>';
        html += '<thead><tr><th>Date</th><th>Time</th><th>Status</th><th>Remarks</th></tr></thead>';
        html += '<tbody>';
        for (let index = 0; index < data.TrackingInformation.length; index++) {
            const element = data.TrackingInformation[index];
            html += '<tr><td>' + element.Item.date + '</td>';
            html += (element.Item.time === '00:00') ? '<td></td>' : '<td>' + element.Item.time + '</td>';
            html += (element.Item.Status !== null) ? '<td>' + element.Item.Status + '</td>' : '<td></td>';
            html += '<td>' + element.Item.Remarks + '</td></tr>'
        }
        html += '</tbody>';
        html += '</table>';
        html += '</div>';

        html += '</div>';
        return html;
    }

}());
