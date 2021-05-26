$('form').submit(function () { 

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
    
    function isFloat(n){
        return Number(n) === n && n % 1 !== 0;
    }

    $(this).find('input[data-validate="yes"]').each(function(){
        // Remove classes and <p> tags
        $(this).parents(".form-group").children('p').remove();
        $(".check").children('p').remove();
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
                    $(this).parents(".form-group").append(`<p class="text-danger">Este campo deve ter entre ${dataMin} a ${dataMax} caracteres.</p>`);
                }        
                break;

            case 'email':
                if(dataValue.length > dataMax || dataValue.length < dataMin) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append(`<p class="text-danger">Este campo tem de conter um e-mail válido.</p>`);
                }       
                break;
                
            case 'int':
                dataNumber = Number(dataValue);
                if(!Number.isInteger(dataNumber)) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append('<p class="text-danger">Este campo tem de ser preenchido apenas com números.</p>');
                }
                else
                {
                    if(dataMax == dataMin && (dataNumber > dataMax || dataNumber < dataMin))
                    {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                        $(this).parents(".form-group").append(`<p class="text-danger">Este campo pode ter até ${dataMax} unidades.</p>`);
                    }
                    else if(dataNumber > dataMax || dataNumber < dataMin) 
                    {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                        $(this).parents(".form-group").append(`<p class="text-danger">Este campo pode ter até ${dataMax} unidades.</p>`);
                    }   
                }
                break;

            case 'float':
                dataNumber = Number(dataValue);
                if(dataNumber > dataMax || dataNumber < dataMin) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append(`<p class="text-danger">Este campo pode ter até ${dataMax} unidades.</p>`);
                }
                break;

            case 'size':
                const regexSize = new RegExp('^([0-9]){3}x([0-9]){3}');
                if(!regexSize.test(dataValue)) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append(`<p class="text-danger">Este campo tem o formato inválido: <u>123x123</u>.</p>`);
                }  
                break;

            case 'postalcode':
                const regexPostal = new RegExp('^([0-9]){4}-([0-9]){3}');
                if(!regexPostal.test(dataValue)) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append(`<p class="text-danger">Este campo tem o formato inválido: <u>1234x123</u>.</p>`);
                }  
                break;

            case 'nif':
                if(dataValue != "" && dataValue != "PT999999990")
                {
                    if(dataValue.length > dataMax || dataValue.length < dataMin) 
                    {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                        $(this).parents(".form-group").append(`<p class="text-danger">Este campo deve estar vazio ou completo com 9 caracteres.</p>`);
                    }
                }
                break;

            case 'checkbox':
                let checkedbox = $('#termos:checkbox:checked').length;
                if(checkedbox == 0)
                {
                    validForm = false;
                    $(`<p class="text-danger">Para continuar, verifique que concorda com os termos e condições.</p>`).appendTo(".check");
                }
                break;

            case 'password':
                const regexPassword = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{8,})");
                if(!regexPassword.test(dataValue)) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append(`<p class="text-danger">A palavra-passe deve ter 8 caracteres, uma letra, um número e um caractere especial.</p>`);
                }       
                break;

            case 'confirmpassword':
                let password = $("#password").val();
                if (password != "")
                {
                    if(password != dataValue)
                    {
                        validForm = false;
                        $(this).addClass('form-validate-invalid');
                        $(this).parents(".form-group").append(`<p class="text-danger">As palavras-passe inseridas têm de ser iguais.</p>`);
                    }
                }
                break;

            case 'required':
                if(dataValue.length < dataMin) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append(`<p class="text-danger">Este campo deve ter ${dataMin} ou mais caracteres.</p>`);
                }        
                break;

            case 'select-colors':
                if(dataValue.length > dataMax || dataValue.length < dataMin) 
                {
                    validForm = false;
                    $(this).addClass('form-validate-invalid');
                    $(this).parents(".form-group").append(`<p class="text-danger">Selecione uma cor de forma a preencher este campo</p>`);
                }        
                break;

            default:
                break;
        }
    });

    return validForm;
});