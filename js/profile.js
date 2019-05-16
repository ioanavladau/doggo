let sStartDate
let sEndDate
let sSelectedTime

$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left',
    locale: {
        "format": "MM/DD/YYYY",
      }
  }, function(start, end, label) {
    sStartDate = start.format('YYYY-MM-DD')
    sEndDate = end.format('YYYY-MM-DD')
    console.log(sStartDate)
    console.log(sEndDate)
  });
});

$('.available-time').click(function(){
    sSelectedTime = $(this).attr("id")
    console.log(sSelectedTime)
    $('.available-time').removeClass('time-active')
    $(this).addClass('time-active')
});



$('#add-availability').click(function(){
    //sStartDate
    //sEndDate
    //sSelectedTime


    $.ajax({
        method:"GET",
        url:"apis/api-pass-available-dates.php",
        data: {
            "sStartDate": sStartDate,
            "sEndDate" : sEndDate,
            "sTimeInterval": sSelectedTime
        },
        dataType:"JSON"
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            // swal({
            //     title: "You have signed up",
            //     text: "You can login now",
            //     icon: "success",
            //     buttons: {
            //         backToLogin: {
            //           text: "Close",
            //           value: "backToLogin",
            //         },
            //       },
            // });
            // $('#frmSignup')[0].reset()
            console.log('success')
        }else{
            // swal({
            //     title: "Can't sign you up!",
            //     text: jData.message,
            //     icon: "warning",
            // });
        }
    }).fail(function(){
        console.log('API does not work')
    });

    return false
})