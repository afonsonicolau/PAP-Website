$('form').submit(function(){

    let validForm = true;

    $(this).find('textarea[data-validate="yes"]').each(function(){
        $(this).parent("div").children('p').remove();
        $(this).removeClass('form-validate-invalid');

        let dataMin = Number($(this).attr('data-min'));
        let dataMax = Number($(this).attr('data-max'));
        let dataValue = $(this).val();

        if (dataValue.length > dataMax || dataValue.length < dataMin) {
            validForm = false;
            $(this).addClass('form-validate-invalid');
            $(this).parent("div").append(`<p class="text-danger">Este campo deve ter entre ${dataMin} a ${dataMax} caracteres.</p>`);
        }
    });
    
    $(this).find('input[data-validate="yes"]').each(function(){
        $(this).parent("div").children('p').remove();
        $(this).removeClass('form-validate-invalid');

        let dataMin = Number($(this).attr('data-min'));
        let dataMax = Number($(this).attr('data-max'));
        let dataType = $(this).attr('data-type');
        let dataValue = $(this).val();

        switch (dataType) {
            case 'string':
                if(dataValue.length > dataMax || dataValue.length < dataMin) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parent("div").append(`<p class="text-danger">Este campo deve ter entre ${dataMin} a ${dataMax} caracteres.</p>`);
                }        
                break;

            case 'int':
                dataNumber = Number(dataValue);
                if(!Number.isInteger(dataNumber)) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parent("div").append('<p class="text-danger">Este campo tem de ser preenchido apenas com números.</p>');
                }
                else
                {
                    if(dataMax == dataMin && (dataValue.length > dataMax || dataValue.length < dataMin))
                    {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                        $(this).parent("div").append(`<p class="text-danger">Este campo deve conter ${dataMin} números.</p>`);
                    }
                    else if(dataValue.length > dataMax || dataValue.length < dataMin) 
                    {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                        $(this).parent("div").append(`<p class="text-danger">Este campo deve ter entre ${dataMin} a ${dataMax} números.</p>`);
                    }   
                }
                
                break;

            case 'float':
                if(dataValue.length > dataMax || dataValue.length < dataMin) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parent("div").append(`<p class="text-danger">Este campo deve ter entre ${dataMin} a ${dataMax} números.</p>`);
                }
                break;

            case 'size':
                const regexSize = new RegExp('^([0-9]){3}x([0-9]){3}');
                if(!regexSize.test(dataValue)) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parent("div").append(`<p class="text-danger">Este campo tem o formato inválido: <u>123x123</u>.</p>`);
                }  
                break;

            case 'postalcode':
                const regexPostal = new RegExp('^([0-9]){4}-([0-9]){3}');
                if(!regexPostal.test(dataValue)) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parent("div").append(`<p class="text-danger">Este campo tem o formato inválido: <u>1234x123</u>.</p>`);
                }  
                break;

            case 'nif':
                if(dataValue != "" && dataValue != "PT999999990")
                {
                    if(dataValue.length > dataMax || dataValue.length < dataMin) 
                    {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                        $(this).parent("div").append(`<p class="text-danger">Este campo deve estar vazio ou completo com 9 caracteres.</p>`);
                    }
                }
                break;

            default:
                break;
        }
    });

    return validForm;
});