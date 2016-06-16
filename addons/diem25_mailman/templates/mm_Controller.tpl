<span id="sample">Hello Ajaxkk</span>{jq}
    $.ajax({
        type: 'GET',
        url: 'tiki-ajax_services.php?',
        async: true,
        dataType: 'json',
        data: {
            controller: 'tikiaddon.controller.diem25.mailmam.services',
            action: 'help'
            },
        success: function (data) {
                alert(data);
            }
    });
{/jq}