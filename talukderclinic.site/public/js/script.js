$(document).ready(function(){

//Search

$(document).on("focus" , "#search" , function () {

        $(this).removeAttr('placeholder');

    });

    $(document).on("focusout" , "#search" , function () {

        if($(this).val() == ''){
            $(this).attr('placeholder' , "Enter HYIP domain");
        }

    });

});


