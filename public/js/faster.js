function number_format(number, decimals, decPoint, thousandsSep)
{
    decimals = decimals || 0;
    number = parseFloat(number);

    if(!decPoint || !thousandsSep){
        decPoint = '.';
        thousandsSep = ',';
    }

    var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
    var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
    var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
    var formattedNumber = "";

    while(numbersString.length > 3){
        formattedNumber += thousandsSep + numbersString.slice(-3)
        numbersString = numbersString.slice(0,-3);
    }

    return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
}

$(function(){

    writeLog = function(serverError, errorCode, type)
    {
        $.ajax({
            url: $("body").attr("data-path") + "/public/?module=Audit&controller=Log&view=writeLog",
            type: 'post',
            data: { msg: serverError, code: errorCode, type:  type},
            error: function(jqXHR, textStatus, errorThrown)
            {
                var UI = new JScriptRender.jquery.UI();
                UI.dialog({
                    id: 'ERROR-LOG',
                    title: "ERROR!",
                    width: 300,
                    content: "<p><span class='text-danger text-justify'>Ha ocurrido un error al escribir el registro de LOG.</span></p> \
                              <div class='alert alert-danger'><strong>" + textStatus + ":</strong>" + errorThrown + "</div> \
                              " + serverError
                });
            }
        });
    };

    $("body").delegate(".general-export-button","click", function()
    {
        var div = document.createElement("div");

        var tbl = $(this).attr('data-table');
        var baseURL = $(this).attr('data-base-url');

        var _table = $("#" + tbl);

        _table = _table.clone();

        var recursiveFunction = function(element, callback)
        {
            callback = callback || new Function();

            element = callback(element);

            if (element.children.length)
            {
                for (var i = element.children.length - 1; i >= 0; i--)
                {
                    recursiveFunction(element.children[i], callback);
                }
            }
        };

        recursiveFunction(_table[0], function(html){

            var style = [];

            for (var k in window.getComputedStyle(html))
            {
                if (parseInt(k) != k)
                {
                    var prop = window.getComputedStyle(html).getPropertyValue(k);

                    if (prop.trim() !== '')
                        style.push(k + ": " + prop);
                }
            }

            style = style.join(';')
            $(html).attr('style', style);

            return html;
        });

        div.appendChild(_table[0]);
        table = $(div).html();

        var doc_title = "Report";

        if (_table.children("caption").length)
        {
            var caption = _table.children("caption");

            var div = document.createElement("div");
            var _title = caption.clone();
            div.appendChild(_title[0]);
            title = $(div).html();

            var data = title + "<br /><br />" + table;
            var doc_title = _title.text();
        }

        var _title = _table.attr('data-title') || "";

        var data = table;

        var uri      = 'data:application/vnd.ms-excel;base64,';
        var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';

        var base64_encode   = function (s) { return window.btoa(unescape(encodeURIComponent(s))) };
        var format_template = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

        var ctx = { worksheet: name || 'Worksheet', table: data }
        window.location.href = uri + base64_encode(format_template(template, ctx));

        /*$.ajax({
            type: "post",
            url: baseURL + "/library/Calc-Writer/writer.php",
            data: {
                html: window.btoa(encodeURIComponent(data))
            },
            success: function(datos)
            {
                window.location = baseURL + "/public/Utils/Xls/write";
            }
        });*/
    });

    $("body").delegate(".general-export-button-pdf","click", function()
    {
        var div = document.createElement("div");

        var tbl = $(this).attr('data-table');
        var _name = $(this).attr('data-name');
        var baseURL = $(this).attr('data-base-url');

        var _table = $("#" + tbl);

        _table = _table.clone();

        var recursiveFunction = function(element, callback)
        {
            callback = callback || new Function();

            element = callback(element);

            if (element.children.length)
            {
                for (var i = element.children.length - 1; i >= 0; i--)
                {
                    recursiveFunction(element.children[i], callback);
                }
            }
        };

        recursiveFunction(_table[0], function(html){

            var style = [];

            for (var k in window.getComputedStyle(html))
            {
                if (parseInt(k) != k)
                {
                    var prop = window.getComputedStyle(html).getPropertyValue(k);

                    if (prop.trim() !== '')
                        style.push(k + ": " + prop);
                }
            }

            style = style.join(';')
            $(html).attr('style', style);

            return html;
        });

        div.appendChild(_table[0]);
        table = $(div).html();

        var doc_title = "Report";

        if (_table.children("caption").length)
        {
            var caption = _table.children("caption");

            var div = document.createElement("div");
            var _title = caption.clone();
            div.appendChild(_title[0]);
            title = $(div).html();

            var data = title + "<br /><br />" + table;
            var doc_title = _title.text();
        }

        var _title = _table.attr('data-title') || "";

        var data = table;

        $.ajax({
            type: "post",
            url: baseURL + "/library/Pdf-Writer/writer.php",
            data: {
                html: window.btoa(encodeURIComponent(data))
            },
            success: function(datos)
            {
                //window.location = baseURL + "/library/Pdf-Writer/pdf.php";
            }
        });
    });

    $("body").delegate(":not(form)[data-action='ajax-request']", "click", function(event)
    {
        event.preventDefault();

        var url = $(this).attr('href');
        var type = $(this).attr('data-type');
        var box = $(this).attr('data-response');
        var data = $(this).attr('data-object');

        var call = eval($(this).attr('data-callback')) || {};
        call.success = call.success || new Function();
        call.before = call.before || new Function();
        call.error = call.error || new Function();

        $.ajax({
            url: url,
            type: type,
            data: eval(data),
            beforeSend: function() {
                $(box).html("<div class='spinner79 icon-spinner79-2' aria-hidden='true'></div>");
                call.before();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $(box).html("<div class='alert alert-danger'>Ha ocurrido al procesar la petición!.</div>");

                var e = {};
                e.jqXHR = jqXHR;
                e.textStatus = textStatus;
                e.errorThrown = errorThrown;

                call.error(e);

                $(box).append("Error <strong>" + jqXHR.status + "</strong> - " + jqXHR.statusText + "<br />");
                $(box).append("Status: " + textStatus + "<br />");
                $(box).append("readyState: " + jqXHR.readyState + "<br />");
            },
            success: function(data)
            {
                $(box).html(data);
                call.success();
            }
        });
    });

    $("body").delegate("[data-action='ajax-request-on-change']", "change", function(event)
    {
        var url = $(this).attr('href');
        var type = $(this).attr('data-type');
        var box = $(this).attr('data-response');
        var data = $(this).attr('data-object');

        var call = eval($(this).attr('data-callback')) || {};
        call.success = call.success || new Function();
        call.before = call.before || new Function();
        call.error = call.error || new Function();

        $.ajax({
            url: url,
            type: type,
            data: eval(data),
            beforeSend: function() {
                $(box).html("<div class='spinner79 icon-spinner79-2' aria-hidden='true'></div>");
                call.before();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $(box).html("<div class='alert alert-danger'>Ha ocurrido al procesar la petición!.</div>");

                var e = {};
                e.jqXHR = jqXHR;
                e.textStatus = textStatus;
                e.errorThrown = errorThrown;

                call.error(e);

                $(box).append("Error <strong>" + jqXHR.status + "</strong> - " + jqXHR.statusText + "<br />");
                $(box).append("Status: " + textStatus + "<br />");
                $(box).append("readyState: " + jqXHR.readyState + "<br />");
            },
            success: function(data)
            {
                $(box).html(data);
                call.success();
            }
        });
    });

    $("body").delegate("[data-action='show-dialog']", "click", function(event)
    {
        event.preventDefault();

        var _url = $(this).attr('data-url');

        var _title    = $(this).attr('data-title');
        var _id       = $(this).attr('data-id');
        var _width    = $(this).attr('data-width');
        var _footer   = $(this).attr('data-footer');
        var _keyboard = $(this).attr('data-keyboard');
        var _overlay  = $(this).attr('data-overlay');

        var _type = $(this).attr('data-type');
        var _data = $(this).attr('data-object');
        var frm   = $(this).attr('data-form');

        _width = (_width == "small") ? "modal-sm" : _width;
        _width = (_width == "large") ? "modal-lg" : _width;

        _footer = (_footer == "no") ? false : true;

        var keyboard = "data-keyboard='" + _keyboard + "'";

        if (!$('#'+_id).length)
        {
            var footer = (_footer) ? "<div class='modal-footer'></div>" : "";

            var modal = "<div id='" + _id + "' class='modal fade' tabindex='-1' role='dialog' " + keyboard + ">" +
                                "<div class='modal-dialog " + _width + "'>" +
                                    "<div class='modal-content'>" +
                                      "<div class='modal-header'>" +
                                        "<h4 class='modal-title'>" + _title + "</h4>" +
                                        "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                                      "</div>" +
                                      "<div class='modal-body'>" +
                                        "<p><div class='spinner79 icon-spinner79-2' aria-hidden='true'></div></p>" +
                                      "</div>" +
                                       footer +
                                    "</div>" +
                                  "</div>" +
                                "</div>";

            $("body").append(modal);
        }

        var box = $('#'+_id);

        box.modal();

        var call = eval($(this).attr('data-callback')) || {};
        call.success = call.success || new Function();
        call.before = call.before || new Function();
        call.error = call.error || new Function();

        var form_data = $(frm).serializeArray();

        var parsed = eval(_data);

        for (var i in parsed)
        {
            form_data.push({ name: i, value: parsed[i] });
        }

        $.ajax({
            url: _url,
            type: _type,
            data: form_data,
            beforeSend: function() {
                $(box).find(".modal-body").html("<div class='spinner79 icon-spinner79-2' aria-hidden='true'></div>");
                call.before();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $(box).find(".modal-body").html("<div class='alert alert-danger'>Ha ocurrido al procesar la petición!.</div>");

                var e = {};
                e.jqXHR = jqXHR;
                e.textStatus = textStatus;
                e.errorThrown = errorThrown;

                call.error(e);

                var currentDate = new Date();
                var id = currentDate.getTime();

                $(box).find(".modal-body").append("Error <strong>" + jqXHR.status + "</strong> - " + jqXHR.statusText + "<br />");
                $(box).find(".modal-body").append("Status: " + textStatus + "<br />");
                $(box).find(".modal-body").append("readyState: " + jqXHR.readyState + "<br /><br />");
                $(box).find(".modal-body").append("<iframe style='width: 100%' id=" + id + "></iframe><br /><br />");

                var iframe = document.getElementById(id),
                    iframedoc = iframe.contentDocument || iframe.contentWindow.document;

                iframedoc.body.innerHTML = jqXHR.responseText;
            },
            success: function(data)
            {
                if (data.error !== undefined && data.error == true)
                {
                    $(box).find(".modal-body").html("<div class='alert alert-danger'>" + data.message + "</div>");
                }
                else
                {
                    $(box).find(".modal-body").html(data);
                    call.success();
                }
            }
        });
    });

    $("body").delegate("[data-action='show-dialog-on-change']", "change", function(event)
    {
        event.preventDefault();

        var _url = $(this).attr('data-url');

        var _title = $(this).attr('data-title');
        var _id = $(this).attr('data-id');
        var _width = $(this).attr('data-width');
        var _overlay = $(this).attr('data-overlay');

        var _type = $(this).attr('data-type');
        var _data = $(this).attr('data-object');

        _width = (_width == "small") ? "modal-sm" : _width;
        _width = (_width == "large") ? "modal-lg" : _width;

        if (!$('#'+_id).length)
            $("body").append("<div id='" + _id + "' class='modal fade' tabindex='-1' role='dialog'>" +
                                "<div class='modal-dialog " + _width + "'>" +
                                    "<div class='modal-content'>" +
                                      "<div class='modal-header'>" +
                                        "<h4 class='modal-title'>" + _title + "</h4>" +
                                        "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                                      "</div>" +
                                      "<div class='modal-body'>" +
                                        "<p><div class='spinner79 icon-spinner79-2' aria-hidden='true'></div></p>" +
                                      "</div>" +
                                      "<div class='modal-footer'>" +
                                      "</div>" +
                                    "</div>" +
                                  "</div>" +
                                "</div>");

        var box = $('#'+_id);

        box.modal();

        var call = eval($(this).attr('data-callback')) || {};
        call.success = call.success || new Function();
        call.before = call.before || new Function();
        call.error = call.error || new Function();

        $.ajax({
            url: _url,
            type: _type,
            data: eval(_data),
            beforeSend: function() {
                $(box).find(".modal-body").html("<div class='spinner79 icon-spinner79-2' aria-hidden='true'></div>");
                call.before();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $(box).find(".modal-body").html("<div class='alert alert-danger'>Ha ocurrido al procesar la petición!.</div>");

                var e = {};
                e.jqXHR = jqXHR;
                e.textStatus = textStatus;
                e.errorThrown = errorThrown;

                call.error(e);

                $(box).find(".modal-body").append("Error <strong>" + jqXHR.status + "</strong> - " + jqXHR.statusText + "<br />");
                $(box).find(".modal-body").append("Status: " + textStatus + "<br />");
                $(box).find(".modal-body").append("readyState: " + jqXHR.readyState + "<br />");
            },
            success: function(data)
            {
                $(box).find(".modal-body").html(data);
                call.success();
            }
        });
    });

    $("body").delegate("[data-action='show-dialog-on-submit']", "submit", function(event)
    {
        event.preventDefault();

        var _url = $(this).attr('action');

        var _title = $(this).attr('data-title');
        var _id = $(this).attr('data-id');
        var _width = $(this).attr('data-width');
        var _overlay = $(this).attr('data-overlay');

        var _type = $(this).attr('data-type');
        var _data = $(this).attr('data-object');

        _width = (_width == "small") ? "modal-sm" : _width;
        _width = (_width == "large") ? "modal-lg" : _width;

        if (!$('#'+_id).length)
            $("body").append("<div id='" + _id + "' class='modal fade' tabindex='-1' role='dialog'>" +
                                "<div class='modal-dialog " + _width + "'>" +
                                    "<div class='modal-content'>" +
                                      "<div class='modal-header'>" +
                                        "<h4 class='modal-title'>" + _title + "</h4>" +
                                        "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                                      "</div>" +
                                      "<div class='modal-body'>" +
                                        "<p><div class='spinner79 icon-spinner79-2' aria-hidden='true'></div></p>" +
                                      "</div>" +
                                      "<div class='modal-footer'>" +
                                      "</div>" +
                                    "</div>" +
                                  "</div>" +
                                "</div>");

        var box = $('#'+_id);

        box.modal();

        var call = eval($(this).attr('data-callback')) || {};
        call.success = call.success || new Function();
        call.before = call.before || new Function();
        call.error = call.error || new Function();

        var form_data = $(this).serializeArray();

        var parsed = eval(_data);

        for (var i in parsed)
        {
            form_data.push({ name: i, value: parsed[i] });
        }

        $.ajax({
            url: _url,
            type: _type,
            data: form_data,
            beforeSend: function() {
                $(box).find(".modal-body").html("<div class='spinner79 icon-spinner79-2' aria-hidden='true'></div>");
                call.before();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                $(box).find(".modal-body").html("<div class='alert alert-danger'>Ha ocurrido al procesar la petición!.</div>");

                var e = {};
                e.jqXHR = jqXHR;
                e.textStatus = textStatus;
                e.errorThrown = errorThrown;

                call.error(e);

                $(box).find(".modal-body").append("Error <strong>" + jqXHR.status + "</strong> - " + jqXHR.statusText + "<br />");
                $(box).find(".modal-body").append("Status: " + textStatus + "<br />");
                $(box).find(".modal-body").append("readyState: " + jqXHR.readyState + "<br />");
            },
            success: function(data)
            {
                $(box).find(".modal-body").html(data);
                call.success();
            }
        });
    });

    $("body").delegate("[data-role='ajax-request']", "submit", function(event)
    {
        event.preventDefault();

        var formObject = $(this);

        var inputs = formObject.find("input");

        var preserve_readonly = [];

        $.each(inputs, function(key, element){
            if (element.hasAttribute('readonly'))
                preserve_readonly.push(element);
        });

        var select = formObject.find("select");

        $.each(select, function(key, element){
            if (element.hasAttribute('readonly'))
                preserve_readonly.push(element);
        });

        var textarea = formObject.find("select");

        $.each(textarea, function(key, element){
            if (element.hasAttribute('readonly'))
                preserve_readonly.push(element);
        });

        formObject.find("input").attr("readonly", "readonly");
        formObject.find("select").attr("readonly", "readonly");
        formObject.find("textarea").attr("readonly", "readonly");
        formObject.find("button[type='submit']").attr("disabled", "disabled");

        var url  = $(this).attr('action');
        var type = $(this).attr('method');
        var box  = $(this).attr('data-response');
        var data = $(this).attr('data-object');
        var filt = $(this).attr('data-filter');

        var call = eval($(this).attr('data-callback')) || {};
        call.success = call.success || new Function();
        call.before = call.before || new Function();
        call.error = call.error || new Function();

        var form_data = $(this).serializeArray();

        var parsed = eval(data);

        for (var i in parsed)
        {
            form_data.push({ name: i, value: parsed[i] });
        }

        var parsed = eval('var filters = ' + filt);

        for (var k in filters)
        {
            for (var i in form_data)
            {
                if (form_data[i].name == k)
                    form_data[i].value = filters[k](form_data[i].value);
            }
        }

        $.ajax({
            url: url,
            type: type,
            data: form_data,
            beforeSend: function() {
                formObject.removeClass('guardado');
                formObject.removeClass('error');
                formObject.addClass('loading');
                call.before();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                var e = {};
                e.jqXHR = jqXHR;
                e.textStatus = textStatus;
                e.errorThrown = errorThrown;

                call.error(e);

                var currentDate = new Date();
                var id = currentDate.getTime();

                var modal = "<div id='md-" + id + "' class='modal fade' tabindex='-1' role='dialog'>" +
                                "<div class='modal-dialog' role='document'>" +
                                    "<div class='modal-content'>" +
                                      "<div class='modal-header'>" +
                                        "<h4 class='modal-title'>" + jqXHR.statusText + "</h4>" +
                                        "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                                      "</div>" +
                                      "<div class='modal-body'>" +
                                        "<div class='alert alert-danger'>Ha ocurrido al procesar la petición!.</div>" +
                                        "Error <strong>" + jqXHR.status + "</strong> - " + jqXHR.statusText + "<br />" +
                                        "Status: " + textStatus + "<br />" +
                                        "readyState: " + jqXHR.readyState + "<br /><br />" +
                                        "<iframe style='width: 100%' id=" + id + "></iframe><br /><br />" +
                                      "</div>" +
                                    "</div>" +
                                  "</div>" +
                                "</div>";

                $("body").append(modal);

                var iframe = document.getElementById(id),
                    iframedoc = iframe.contentDocument || iframe.contentWindow.document;

                iframedoc.body.innerHTML = jqXHR.responseText;

                var box = $('#md-' + id);
                box.modal();
            },
            success: function(data)
            {
                $(box).html(data);
                call.success(data);
            },
            complete: function(data)
            {
                formObject.find("input").removeAttr("readonly");
                formObject.find("select").removeAttr("readonly");
                formObject.find("textarea").removeAttr("readonly");
                formObject.find("button[type='submit']").removeAttr("disabled");
                formObject.removeClass('loading');

                for (var i = preserve_readonly.length - 1; i >= 0; i--)
                {
                    $(preserve_readonly[i]).attr('readonly', 'readonly');
                }
            }
        });
    });

    $('[data-toggle="tooltip"]').tooltip();

    $("body").delegate("form[data-role='ajax-push-request']", "submit", function(event)
    {
        event.preventDefault();

        var that = $(this);

        var url = that.attr('action');
        var box = that.attr('data-response');
        var _html = that.attr('data-html');
        var data = that.attr('data-object');

        var call = eval(that.attr('data-callback')) || {};
        call.success = call.success || new Function();
        call.error = call.error || new Function();
        call.before = call.before || new Function();

        var form_data = that.serializeArray();

        var parsed = eval(data);

        for (var i in parsed)
        {
            form_data.push({ name: i, value: parsed[i] });
        }

        call.before();
        var comet = new JScriptRender.jquery.Comet({ url: url });

        var settings = {
            url: url,
            data: form_data,
            callback: {
                success: function(data)
                {
                    // Connection established
                    if (typeof data != "object")
                       data = $.parseJSON(data);

                    if (_html == "append")
                        $(box).append(data.contents);
                    else
                        $(box).html(data.contents);

                    call.success(data);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    var e = {};
                    e.jqXHR = jqXHR;
                    e.textStatus = textStatus;
                    e.errorThrown = errorThrown;

                    comet.disconnect();
                    call.error(e);
                },
                complete: function()
                {
                    // For each request
                },
                disconnect: function(){
                    console.info('disconnected');
                }
            }
        }

        comet.connect(settings);
    });

});
