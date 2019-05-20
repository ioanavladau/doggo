let sStartDate
let sEndDate
let sSelectedTime
let sTimestampStartDate
let sTimestampEndDate

// $(document).ready(function() {
//     if(window.sUserEmail) {
//         $("#is-dog-sitter").text('You are a dogsitter')}
//     else {
//         $("#is-dog-sitter").hide();
//     }
// });

$(function() {
$('input[name="daterange"]').daterangepicker({
    opens: 'left',
    locale: {
        'format': 'MM/DD/YYYY',
    }
}, function(start, end, label) {
    sStartDate = start.format('YYYY-MM-DD')
    sEndDate = end.format('YYYY-MM-DD')
    sTimestampStartDate = (new Date(sStartDate)).getTime()
    sTimestampEndDate = (new Date(sEndDate)).getTime()

    console.log('Start date in seconds: '+sTimestampStartDate)
    console.log('End date in seconds: '+sTimestampEndDate)
});
});



$('.available-time').click(function(){
    sSelectedTime = $(this).attr('id')
    console.log(sSelectedTime)
    $('.available-time').removeClass('time-active')
    $(this).addClass('time-active')
});

$('#add-availability').click(function(){
    //sStartDate
    //sEndDate
    //sSelectedTime


    $.ajax({
        method:'GET',
        url:'apis/api-pass-available-dates.php',
        data: {
            'sStartDate': sTimestampStartDate,
            'sEndDate' : sTimestampEndDate,
            'sTimeInterval': sSelectedTime,
            'sUserEmail': window.sUserEmail
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            swal({
                title: 'Available period added',
                // text: 'You can login now',
                icon: 'success',
            });
            // $('#frmSignup')[0].reset()
            console.log('success')
        }else{
            // swal({
            //     title: 'Can't sign you up!',
            //     text: jData.message,
            //     icon: 'warning',
            // });
        }
    }).fail(function(){
        console.log('API does not work')
    });

    return false
})

// window.onload = function(){
    // Button click doesn't return json response from the api
$('button.fc-prev-button').click(function(){
    $.ajax({
        method:'GET',
        url:'apis/api-get-available-dates.php',
        data: {
            'sUserEmail': window.sUserEmail
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            let aAvailableDates = jData.message.split(',');
            console.log(aAvailableDates)

            // if ($('.fc-day').dataset.date == "2019-05-19"){
            //     console.log('hiya')
            // }else{
            //     console.log('byeya')
            // }
            // availableDate = 2019-05-20
            // let foundelement = $("tr").find("td[data-date='" + availableDate +"']")
            //     foundelement.addClass('red')

            aAvailableDates.forEach(function(availableDate){
                console.log(availableDate)
                let foundelement = $("tr").find("td[data-date='" + availableDate +"']")
                foundelement.addClass('red')
                
                // let targetTd = $('.fc-day').data("date", "2019-05-19")
                // targetTd.addClass('red')

              });
            // swal({
            //     title: 'Available period added',
            //     // text: 'You can login now',
            //     icon: 'success',
            // });
            // $('#frmSignup')[0].reset()
            // console.log(jData.message)
        }else{
            // swal({
            //     title: 'Can't sign you up!',
            //     text: jData.message,
            //     icon: 'warning',
            // });
        }
    }).fail(function(){
        console.log('api-get-available-dates does not work')
    });

    return false
})