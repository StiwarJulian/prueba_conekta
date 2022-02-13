(function($){
    $.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_-]+)\])*$/,
                "key":      /[a-zA-Z0-9_-]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_-]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            if(jQuery('[name="' + this.name + '"]').hasClass('system_validador_numformato')){
                merge = accounting.unformat(this.value);
            }

            if(jQuery('[name="' + this.name + '"]').hasClass('system_validador_numerico_decimal')){
                merge = accounting.unformat(this.value);
            }

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };
})(jQuery);

/*construye url query a partir de una clase html*/
var Http_Query = function (Clase) {
    var params = "&";
    jQuery('.' + Clase).each(function () {
        if (jQuery(this).attr('name') != undefined) {
            if (jQuery(this).attr('type') === "checkbox") {
                params = params + jQuery(this).attr('name') + "=" +jQuery(this).prop("checked") + "&";
            }else{
                if(jQuery('[name="' + this.name + '"]').hasClass('system_validador_numformato')){
                    params = params + jQuery(this).attr('name') + "=" + accounting.unformat(this.value); + "&";
                }else if(jQuery('[name="' + this.name + '"]').hasClass('system_validador_numerico_decimal')){
                    params = params + jQuery(this).attr('name') + "=" + accounting.unformat(this.value); + "&";
                }else{
                    params = params + jQuery(this).attr('name') + "=" + jQuery(this).val() + "&";
                }
            }
        }
    });
    return params;
};

function notificarUsuario(mensaje = "", tipo = "info", titulo = "Informativo") {
    var mensajeFinal = "";

    if (Array.isArray(mensaje)) {
        for (i = 0; i < mensaje.length; i++) {
            if(mensaje[i] != undefined){
                mensajeFinal = "- " + mensaje[i] + "<br>" + mensajeFinal;
            }
        }
    }

    if (mensajeFinal.length > 20) {
        Swal.fire("", mensajeFinal, tipo);
    } else {
        Swal.fire(mensajeFinal, "", tipo);
    }
}
function getDataForm(obj){ return jQuery("#" + obj).serializeArray(); }
function getDataJson(obj){ return jQuery("#" + obj).serializeObject(); }
