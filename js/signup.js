$('#frmSignup').submit( function(){

    $.ajax({
        method:"POST",
        url:"apis/api-signup",
        data: $('#frmSignup').serialize(),
        dataType:"JSON"
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            swal({
                title: "You have signed up",
                text: "You can login now",
                icon: "success",
                buttons: {
                    backToLogin: {
                      text: "Close",
                      value: "backToLogin",
                    },
                  },
            }).then(function() {
                location.href = 'login';
              }) 
        }else{
            swal({
                title: "Can't sign you up!",
                text: jData.message,
                icon: "warning",
            });
        }
    }).fail(function(){
        console.log('API does not work')
    });

    return false
})