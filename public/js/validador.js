/*!
 * accounting.js v0.4.1, copyright 2014 Open Exchange Rates, MIT license, http://openexchangerates.github.io/accounting.js
 */
(function(p,z){function q(a){return!!(""===a||a&&a.charCodeAt&&a.substr)}function m(a){return u?u(a):"[object Array]"===v.call(a)}function r(a){return"[object Object]"===v.call(a)}function s(a,b){var d,a=a||{},b=b||{};for(d in b)b.hasOwnProperty(d)&&null==a[d]&&(a[d]=b[d]);return a}function j(a,b,d){var c=[],e,h;if(!a)return c;if(w&&a.map===w)return a.map(b,d);for(e=0,h=a.length;e<h;e++)c[e]=b.call(d,a[e],e,a);return c}function n(a,b){a=Math.round(Math.abs(a));return isNaN(a)?b:a}function x(a){var b=c.settings.currency.format;"function"===typeof a&&(a=a());return q(a)&&a.match("%v")?{pos:a,neg:a.replace("-","").replace("%v","-%v"),zero:a}:!a||!a.pos||!a.pos.match("%v")?!q(b)?b:c.settings.currency.format={pos:b,neg:b.replace("%v","-%v"),zero:b}:a}var c={version:"0.4.1",settings:{currency:{symbol:"$",format:"%s%v",decimal:".",thousand:",",precision:2,grouping:3},number:{precision:0,grouping:3,thousand:",",decimal:"."}}},w=Array.prototype.map,u=Array.isArray,v=Object.prototype.toString,o=c.unformat=c.parse=function(a,b){if(m(a))return j(a,function(a){return o(a,b)});a=a||0;if("number"===typeof a)return a;var b=b||".",c=RegExp("[^0-9-"+b+"]",["g"]),c=parseFloat((""+a).replace(/\((.*)\)/,"-$1").replace(c,"").replace(b,"."));return!isNaN(c)?c:0},y=c.toFixed=function(a,b){var b=n(b,c.settings.number.precision),d=Math.pow(10,b);return(Math.round(c.unformat(a)*d)/d).toFixed(b)},t=c.formatNumber=c.format=function(a,b,d,i){if(m(a))return j(a,function(a){return t(a,b,d,i)});var a=o(a),e=s(r(b)?b:{precision:b,thousand:d,decimal:i},c.settings.number),h=n(e.precision),f=0>a?"-":"",g=parseInt(y(Math.abs(a||0),h),10)+"",l=3<g.length?g.length%3:0;return f+(l?g.substr(0,l)+e.thousand:"")+g.substr(l).replace(/(\d{3})(?=\d)/g,"$1"+e.thousand)+(h?e.decimal+y(Math.abs(a),h).split(".")[1]:"")},A=c.formatMoney=function(a,b,d,i,e,h){if(m(a))return j(a,function(a){return A(a,b,d,i,e,h)});var a=o(a),f=s(r(b)?b:{symbol:b,precision:d,thousand:i,decimal:e,format:h},c.settings.currency),g=x(f.format);return(0<a?g.pos:0>a?g.neg:g.zero).replace("%s",f.symbol).replace("%v",t(Math.abs(a),n(f.precision),f.thousand,f.decimal))};c.formatColumn=function(a,b,d,i,e,h){if(!a)return[];var f=s(r(b)?b:{symbol:b,precision:d,thousand:i,decimal:e,format:h},c.settings.currency),g=x(f.format),l=g.pos.indexOf("%s")<g.pos.indexOf("%v")?!0:!1,k=0,a=j(a,function(a){if(m(a))return c.formatColumn(a,f);a=o(a);a=(0<a?g.pos:0>a?g.neg:g.zero).replace("%s",f.symbol).replace("%v",t(Math.abs(a),n(f.precision),f.thousand,f.decimal));if(a.length>k)k=a.length;return a});return j(a,function(a){return q(a)&&a.length<k?l?a.replace(f.symbol,f.symbol+Array(k-a.length+1).join(" ")):Array(k-a.length+1).join(" ")+a:a})};if("undefined"!==typeof exports){if("undefined"!==typeof module&&module.exports)exports=module.exports=c;exports.accounting=c}else"function"===typeof define&&define.amd?define([],function(){return c}):(c.noConflict=function(a){return function(){p.accounting=a;c.noConflict=z;return c}}(p.accounting),p.accounting=c)})(this);
/*
 * @Harold CastaÃ±eda Alviz - 2014
 *Solo validaciones de campos contenidos en un determinado elemento por su Id
 *Retorna falso para cuando al menos un elemento falla en la validacion. Verdadero cuando ninguno falla.
 */
var system_validarcampos = function(div_contenedor,mostrar_mensaje = 1){
    var Eventos = 0;
    //Se borrarn todos los elementos para luego re-evaluarlos
    jQuery("#" + div_contenedor + " .invalid-feedback").remove();
    //Validacion de inputs
    jQuery("#" + div_contenedor + " input").each(function(index) {
        //Validacion de vacio
        var MensajeError = '';
        if(jQuery(this).hasClass('system_validador_vacio')){
            //Se valida que no este vacio.
            if(jQuery(this).val()=="" || jQuery(this).val()==" "){
                jQuery(this).addClass('is-invalid');
                MensajeError = "No debe estar vacio";
                Eventos++;
            }else{
                if(MensajeError===""){ jQuery(this).removeClass('is-invalid'); }
            }

            //Si el elemento contiene el atributo MaxLength, se valida que la cadena que contiene el elemento no sea mas larga que lo permitido.
            if(jQuery(this).attr("maxlength")!=null){
                if(jQuery(this).attr("maxlength")!=0){
                    if(jQuery(this).val().length > jQuery(this).attr("maxlength")){
                        jQuery(this).addClass('is-invalid');
                        MensajeError = MensajeError + " - El texto es muy largo. Máximo: " + jQuery(this).attr("maxlength");
                        Eventos++;
                    }else{
                        if(MensajeError==""){
                            if(MensajeError===""){ jQuery(this).removeClass('is-invalid');  }
                        }
                    }
                }
            }
        }
        //Si es validacion email
        if(jQuery(this).hasClass('system_validador_email')){
            expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!expr.test(jQuery(this).val()) ){
                MensajeError = MensajeError + " - " +  "Email inválido";
                Eventos++;
            }else{
                if(MensajeError===""){ jQuery(this).removeClass('is-invalid'); }
            }
        }

        //Si en el campo solo deben ir números
        if(jQuery(this).hasClass('system_validador_numerico')){
            expr = /^([0-9])*$/;
            if (!expr.test(accounting.unformat(jQuery(this).val(),"")) ){
                jQuery(this).addClass('is-invalid');
                MensajeError = MensajeError + " - " +  "Solo números";
                Eventos++;
            }else{
                if(MensajeError===""){ jQuery(this).removeClass('is-invalid'); }
            }
        }

        //Si en el campo solo deben ir formato URL
        if(jQuery(this).hasClass('system_validador_url')){
            expr = /^([0-9])*$/;
            if (!expr.test(jQuery(this).val()) ){
                MensajeError = MensajeError + " - " +  "URL inválida";
                Eventos++;
            }else{
                if(MensajeError===""){ jQuery(this).removeClass('is-invalid'); }
            }
        }

        //Validacion de un nombre de usuario.
        if(jQuery(this).hasClass('system_validador_nombreusuario')){
            expr = /^[a-zA-Z0-9.\-_$@*!]{3,30}$/;
            if (!expr.test(jQuery(this).val()) ){
                MensajeError = MensajeError + " - " +  "Usuario inválido";
                Eventos++;
            }else{
                if(MensajeError===""){ jQuery(this).removeClass('is-invalid'); }
            }
        }
        //Si en el campo solo es formato fecha tipo: DD/MM/AAAA
        if(jQuery(this).hasClass('system_validador_fecha')){
            var campo = jQuery(this).val();
            var RegExPattern = /^\d{2,4}\-\d{1,2}\-\d{1,2}$/;
            if ((campo.match(RegExPattern)) && (campo!='')) {
                if(MensajeError===""){ jQuery(this).removeClass('is-invalid'); }
            } else {
                jQuery(this).addClass('is-invalid');
                MensajeError = MensajeError + " - " +  "Formato fecha incorrecto (DD/MM/AAAA)";
                Eventos++;
            }
        }

        if(mostrar_mensaje==1){ jQuery(this).after('<span class="error invalid-feedback">' + MensajeError + '</span>'); }
    });
    //Validacion de Select
    jQuery("#" + div_contenedor + " select").each(function(index) {
        if(jQuery(this).hasClass('system_validador_vacio')){
            if(jQuery(this).val()=="" || jQuery(this).val()==" "){
                if(mostrar_mensaje==1){ jQuery(this).parent().append('<span class="error invalid-feedback">Seleccione una opción</span>'); }
                jQuery(this).addClass('is-invalid');
                Eventos++;
            }else{
                jQuery(this).removeClass('is-invalid');
            }
        }
    });

    //Validacion de Textare
    jQuery("#" + div_contenedor + " textarea").each(function(index) {
        if(jQuery(this).hasClass('system_validador_vacio')){
            if(jQuery(this).val()=="" || jQuery(this).val()==" "){
                if(mostrar_mensaje==1){ jQuery(this).parent().append('<span class="error invalid-feedback">No debe estar vacío.</span>'); }
                jQuery(this).addClass('is-invalid');
                Eventos++;
            }else{
                jQuery(this).removeClass('is-invalid');
            }
        }
    })

    //Validamos que la variable evento sea cero.
    if(Eventos==0){ return true; }else{ return false; }
};

var system_validarcamposbody = function(mostrar_mensaje){
    var Eventos = 0;
    //Se borrarn todos los elementos para luego re-evaluarlos
    jQuery("body #system_validador").remove();
    //Validacion de inputs
    jQuery("body input").each(function(index) {
        //Validacion de vacio
        var MensajeError = '';
        if(jQuery(this).hasClass('system_validador_vacio')){
            if(jQuery(this).val()=="" || jQuery(this).val()==" "){
                MensajeError = "No debe estar vacío";
                Eventos++;
            }else{
                if(MensajeError===""){                    jQuery(this).removeClass('is-invalid');                }
            }
        }
        //Si es validacion email
        if(jQuery(this).hasClass('system_validador_email')){
            expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!expr.test(jQuery(this).val()) ){
                MensajeError = MensajeError + " - " +  "Emai inválido";
                Eventos++;
            }else{
                if(MensajeError===""){                    jQuery(this).removeClass('is-invalid');                }
            }
        }

        if(mostrar_mensaje==1){ jQuery(this).after('<span class="error invalid-feedback">' + MensajeError + '</span>'); }
        jQuery(this).addClass('is-invalid');
    });
    //Validacion de Select
    jQuery("body select").each(function(index) {
        if(jQuery(this).val()=="" || jQuery(this).val()==" "){
            if(mostrar_mensaje==1){ jQuery(this).parent().append('<span class="error invalid-feedback">Seleccione una opción</span>'); }
            jQuery(this).addClass('is-invalid');
            Eventos++;
        }else{
            if(MensajeError===""){                    jQuery(this).removeClass('is-invalid');                }
        }
    });

    //Validamos que la variable evento sea cero.
    if(Eventos==0){ return true; }else{ return false; }
};

//Validacion de entrada solo numerica. Aplica para todas las clases marcadas con: system_validador_numerico
jQuery("body").on("keydown",".system_validador_numerico", function(event){ if(event.shiftKey) { event.preventDefault(); } if (event.keyCode == 13 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9){ console.log("enter"); } else { if (event.keyCode < 95) { if (event.keyCode < 48 || event.keyCode > 57){ event.preventDefault(); } } else { if (event.keyCode < 96 || event.keyCode > 105){ event.preventDefault(); } } } ;});
jQuery('.system_validador_numerico').on('change', function () { if((jQuery(this).val() == "")) { jQuery(this).val(0); } });
jQuery('.system_validador_numerico').focus(function () { jQuery(this).val(accounting.unformat(jQuery(this).val(),"")); jQuery(this).select() });

jQuery('.system_validador_numformato').on('blur', function () { jQuery(this).val(accounting.formatMoney(jQuery(this).val()));  });
jQuery('.system_validador_numformato').focus(function () { jQuery(this).val(accounting.unformat(jQuery(this).val(),"")); jQuery(this).select() });


jQuery(document).on('focus', '.system_validador_numformato', function () { jQuery(this).val(accounting.unformat(jQuery(this).val(),"")); jQuery(this).select() });
jQuery(document).on('blur', '.system_validador_numformato', function () { jQuery(this).val(accounting.formatMoney(jQuery(this).val())); });

jQuery(document).on('change', '.system_validador_numerico', function () { if((jQuery(this).val() == "")) { jQuery(this).val(0); } });
jQuery(document).on('focus', '.system_validador_numerico', function () { jQuery(this).val(accounting.unformat(jQuery(this).val(),"")); jQuery(this).select() });

jQuery('.system_validador_numerico_decimal').on('change', function () { if((jQuery(this).val() == "")) { jQuery(this).val(0); } });
jQuery('.system_validador_numerico_decimal').focus(function () { jQuery(this).val(accounting.unformat(jQuery(this).val(),"")); jQuery(this).select() });

jQuery(document).on('change', '.system_validador_numerico_decimal', function () { if((jQuery(this).val() == "")) { jQuery(this).val(0); } });
jQuery(document).on('focus', '.system_validador_numerico_decimal', function () { jQuery(this).val(accounting.unformat(jQuery(this).val(),"")); jQuery(this).select() });

jQuery("body").on("keydown",".system_validador_numerico_decimal", function(event){
    cadena = jQuery(event.target).val();
    if(cadena.indexOf('.')==-1)
    {
        if (event.keyCode == 13 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 35 || event.keyCode == 39 || event.keyCode == 40){
        } else {
            if ((event.keyCode < 95) && (event.keyCode!=9) && (event.keyCode!=16)) {
                if (event.keyCode < 48 || event.keyCode > 57){
                    event.preventDefault();
                }
            } else {
                if ((event.keyCode == 110) || (event.keyCode == 190)){
                    return;
                }
                if ((event.keyCode < 96 || event.keyCode > 105)){
                    event.preventDefault();
                }
            }
        } ;
    }
    else
    {
        if (event.keyCode == 13 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 35 || event.keyCode == 39 || event.keyCode == 40){
        } else {
            if (event.keyCode < 95) {
                if (event.keyCode < 48 || event.keyCode > 57){
                    event.preventDefault();
                }
            } else {

                if ((event.keyCode < 96 || event.keyCode > 105)){
                    event.preventDefault();
                }
            }
        } ;
    };
});

jQuery(document).ready(function() {
    jQuery("body input").each(function(index) {
        if(jQuery(this).hasClass('system_validador_numformato')){
            jQuery(this).val(accounting.formatMoney(jQuery(this).val()));
        }
    });
    jQuery("body span").each(function(index) {
        if(jQuery(this).hasClass('system_validador_numformato')){
            jQuery(this).text(accounting.formatMoney(jQuery(this).text()));
        }
    });
});
function SystemValidatorEmail(Email){ expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; if (!expr.test(Email) ){ return false; }else{ return true; }}


function existeFecha(fecha){
    var fechaf = fecha.split("/");
    var day = fechaf[0];
    var month = fechaf[1];
    var year = fechaf[2];
    var date = new Date(year,month,'0');
    if((day-0)>(date.getDate()-0)){
          return false;
    }
    return true;
}

/* valida dos fechas y calcula el numero de dias */
function DiasRangoFechas(FechaInicial, FechaFinal){
    var aFecha1 = FechaInicial.split('-');
    var aFecha2 = FechaFinal.split('-');
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]);
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    return dias;
}

var limpiarCampos = function(obj_contenedor, excepcionId){
    var Eventos = 0;
    //Se borrarn todos los elementos para luego re-evaluarlos
    jQuery("#" + obj_contenedor + " .invalid-feedback").remove();
    //Validacion de inputs
    jQuery("#" + obj_contenedor + " input").each(function(index) {
        if(jQuery(this).hasClass('system_validador_vacio')){
            jQuery(this).val("");
        }
        //Si es validacion email
        if(jQuery(this).hasClass('system_validador_email')){
            jQuery(this).val("");
        }

        //Si en el campo solo deben ir números
        if(jQuery(this).hasClass('system_validador_numerico')){
            jQuery(this).val("0");
        }

        //Si en el campo solo deben ir formato URL
        if(jQuery(this).hasClass('system_validador_url')){
            jQuery(this).val("");
        }

        //Validacion de un nombre de usuario.
        if(jQuery(this).hasClass('system_validador_nombreusuario')){
            jQuery(this).val("");
        }
        //Si en el campo solo es formato fecha tipo: DD/MM/AAAA
        if(jQuery(this).hasClass('system_validador_fecha')){
            jQuery(this).val("");
        }
    });

    jQuery("#" + obj_contenedor + " select").each(function(index) {
        jQuery(this).val("");
    });

    jQuery("#" + obj_contenedor + " textarea").each(function(index) {
        jQuery(this).val("");
    })
};

jQuery('.validarInputsTextOtherName').on('keypress', function(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    let valor = $(this).val();

    //no permite ingresar mas de 20 caracteres
    if (valor.length >= 50) {
        return false;
    }

    // permite la barra espaciadora y la tecla de borrar
    if (tecla == 32 || tecla == 8) {
        return true;
    }

    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
});

jQuery('.validarInputsText').on('keypress', function(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    let valor = $(this).val();

    //no permite ingresar mas de 20 caracteres
    if (valor.length >= 20) {
        return false;
    }

    // permite la barra espaciadora y la tecla de borrar
    if (tecla == 32) {
        return true;
    }

    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
});

jQuery('.validarInputsTextIdentification').on('keypress', function(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    let valor = $(this).val();

    //no permite ingresar mas de 20 caracteres
    if (valor.length >= 20) {
        return false;
    }

    // permite la barra espaciadora y la tecla de borrar
    if (tecla == 8) {
        return true;
    }

    patron = /[A-Za-z0-9-]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
});

