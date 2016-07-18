/**
Postal Code + City editable input.
Internally value stored as {postalCode: "97426", city: "Trois Bassins"}
@class postalCode
@extends abstractinput
@final
@example
<a href="#" id="postalCode" data-type="postalCode" data-pk="1">awesome</a>
<script>
$(function(){
    $('#postalCode').editable({
        url: '/post',
        title: 'Enter Postal Code and City #',
        value: {
            postalCode: '97426',
            codeInsee: '97423',
            addressLocality : 'Trois Bassins'
        }
    });
});
</script>
**/
(function ($) {
    "use strict";
    var searchValue;

    var searchCity = function () {
      console.log("search City");
      var timeout;
      searchValue = $('.editableform #postalCode').val();
      if(searchValue.length == 5) {
        if (! $("#cityDiv").is(":visible")) {
          $("#city").empty();
          runShowCity();
        }
      } else {
        $("#cityDiv").slideUp("medium");
        $("#city").empty();
      }
    };

    var runShowCity = function() {
      var citiesByPostalCode = getCitiesByPostalCode(searchValue);
      
      if (citiesByPostalCode.length == 0 ){
        $("#postalCodeError").show();
        return;
      } else {
        $("#postalCodeError").hide();
      }

      var oneValue = "";
      console.table(citiesByPostalCode);
      $.each(citiesByPostalCode,function(i, value) {
          $("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
          oneValue = value.value;
      });
      
      if (citiesByPostalCode.length == 1) {
        $("#city").val(oneValue);
      }

      if (citiesByPostalCode.length >0) {
            $("#cityDiv").slideDown("medium");
          } else {
            $("#cityDiv").slideUp("medium");
          }
    };
    
    var bindPostalCodeAction = function () {
      console.log("Bind Postal Code");
      $('.editableform #postalCode').keyup(function(e){
        searchCity();
      }).change(function(e){
        searchCity();
      });
      searchCity();
    };

    var PostalCode = function (options) {
        this.init('postalCode', options, PostalCode.defaults);
    };

    //inherit from Abstract input
    $.fn.editableutils.inherit(PostalCode, $.fn.editabletypes.abstractinput);

    $.extend(PostalCode.prototype, {
        /**
        Renders input from tpl
        @method render() 
        **/        
        render: function() {
           this.$input = this.$tpl.find('input');
        },
        
        /**
        Default method to show value in element. Can be overwritten by display option.
        
        @method value2html(value, element) 
        **/
        value2html: function(value, element) {
            if(!value) {
                $(element).empty();
                return; 
            }
            var html = $('<div>').text(value.postalCode).html() + ' ' + $('<div>').text(value.addressLocality).html();
            console.log("value2html " + html);
            $(element).html(html); 
        },
        
        /**
        Gets value from element's html
        
        @method html2value(html) 
        **/        
        html2value: function(html) {        
          /*
            you may write parsing method to get value by element's html
            e.g. "Moscow, st. Lenina, bld. 15" => {city: "Moscow", street: "Lenina", building: "15"}
            but for complex structures it's not recommended.
            Better set value directly via javascript, e.g. 
            editable({
                value: {
                    city: "Moscow", 
                    street: "Lenina", 
                    building: "15"
                }
            });
          */ 
          return null;  
        },
      
       /**
        Converts value to string. 
        It is used in internal comparing (not for sending to server).
        
        @method value2str(value)  
       **/
       value2str: function(value) {
           var str = '';
           if(value) {
               for(var k in value) {
                   str = str + k + ':' + value[k] + ';';  
               }
           }
           return str;
       }, 
       
       /*
        Converts string to value. Used for reading value from 'data-value' attribute.
        
        @method str2value(str)  
       */
       str2value: function(str) {
           /*
           this is mainly for parsing value defined in data-value attribute. 
           If you will always set value by javascript, no need to overwrite it
           */
           return str;
       },                
       
       /**
        Sets value of input.
        
        @method value2input(value) 
        @param {mixed} value
       **/         
       value2input: function(value) {
           if(!value) {
             return;
           }
           this.$input.filter('[name="postalCode"]').val(value.postalCode);
           this.$input.filter('[name="city"]').val(value.city);
       },
       
       /**
        Returns value of input.
        
        @method input2value() 
       **/          
       input2value: function() { 
           var selectCity = document.getElementById("city");
           if (selectCity.options.length > 0) {
              var cityLabel = selectCity.options[selectCity.selectedIndex].text;
              var codeInsee = selectCity.options[selectCity.selectedIndex].value;
              return {
                postalCode: this.$input.filter('[name="postalCode"]').val(), 
                codeInsee: codeInsee,
                addressLocality : cityLabel
              };
            } else {
              return {
                postalCode: "", 
                codeInsee: "",
                addressLocality : ""
              };
            }
       },        
       
        /**
        Activates input: sets focus on the first field.
        
        @method activate() 
       **/        
       activate: function() {
            bindPostalCodeAction();
            this.$input.filter('[name="postalCode"]').focus();
       },  
       
       /**
        Attaches handler to submit form in case of 'showbuttons=false' mode
        
        @method autosubmit() 
       **/       
       autosubmit: function() {
           this.$input.keydown(function (e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                }
           });
       }       
    });

    PostalCode.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl: '<div class="editable-address"><label><span>PostalCode : </span><input type="text" name="postalCode" class="input-small" id="postalCode"></label></div>'+
              '<div id="postalCodeError" style="display: none;"><span class="error">Unknown Postal Code</span></div>'+
             '<div class="editable-address" id="cityDiv" style="display: none"><label><span>City : </span><select name="city" class="input-small" id="city"><option></option></label></div>',
        inputclass: ''
    });

    $.fn.editabletypes.postalCode = PostalCode;

}(window.jQuery));