$('form').submit(function(){

    let validForm = true;

    $(this).find('textarea[data-validate="yes"]').each(function(){
        $(this).removeClass('form-validate-invalid');

        let dataMin = Number($(this).attr('data-min'));
        let dataMax = Number($(this).attr('data-max'));
        let dataValue = $(this).val();

        if (dataValue.length > dataMax || dataValue.length < dataMin) {
            validForm = false;
            $(this).addClass('form-validate-invalid')
        }
    });
    
    $(this).find('input[data-validate="yes"]').each(function(){
        $(this).removeClass('form-validate-invalid');

        let dataMin = Number($(this).attr('data-min'));
        let dataMax = Number($(this).attr('data-max'));
        let dataType = $(this).attr('data-type');
        let dataValue = $(this).val();

        switch (dataType) {
            case 'string':
                if (dataValue.length > dataMax || dataValue.length < dataMin) {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                }        
                break;

            case 'int':
                dataNumber = Number(dataValue);
                if (!Number.isInteger(dataNumber)) {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                }
                else
                {
                    if (dataValue.length > dataMax || dataValue.length < dataMin) {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                    }   
                }
                
                break;

            case 'float':
                if (dataValue.length > dataMax || dataValue.length < dataMin) {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                }
                break;

            case 'size':
                const regexSize = new RegExp('^([0-9]){3}x([0-9]){3}');
                if (!regexSize.test(dataValue)) {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                }  
                break;

            case 'postalcode':
                const regexPostal = new RegExp('^([0-9]){4}-([0-9]){3}');
                if (!regexPostal.test(dataValue)) {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                }  
                break;
            case 'nif':
                if(dataValue != "" && dataValue != "PT999999990")
                {
                    console.log(dataValue)
                    if (dataValue.length > dataMax || dataValue.length < dataMin) {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                    }
                }
                break;
        
            default:
                break;
        }
    });

    return validForm;
});