$('#frmLogin').submit( function(){

    $.ajax({
        method:"POST",
        url:"apis/api-login",
        data: $('#frmLogin').serialize(),
        dataType:"JSON"
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            // swal({
            //     title: "Congrats",
            //     text: "You have logged in",
            //     icon: "success",
            // });
            location.href = "profile?user="+jData.message
        }
        if(jData.status == 0){
            swal({
                title: "Sorry, we can't log you in",
                text: jData.message,
                icon: "warning",
            });

        }
        if(jData.status == -1){
            swal({
                title: "Sorry, we can't log you in",
                text: jData.message,
                icon: "warning",
            });

        }
        
    }).fail(function(){
        console.log('API does not work')
    });

    return false
})