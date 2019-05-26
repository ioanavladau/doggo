let sSearchDate
let sTimestampSearchDate
let sSelectedTime

$(function() {
    $('input[name="searchdate"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      minYear: 2019,
      maxYear: parseInt(moment().format('YYYY'),10),
      locale: {
        'format': 'MM/DD/YYYY',
      }
    }, function(start, end, label) {
        sSearchDate = start.format('YYYY-MM-DD')
        sTimestampSearchDate = (new Date(sSearchDate)).getTime()

        console.log('Search date in seconds: '+sTimestampSearchDate)
    });
  });

$('.available-time').click(function(){
    sSelectedTime = $(this).attr('id')
    console.log(sSelectedTime)
    $('.available-time').removeClass('time-active')
    $(this).addClass('time-active')
});



$('#searchForDate').click(function(){
    let dogSitterResults = document.querySelector("#dogSitterResults")
    dogSitterResults.innerHTML = ""
        
    $.ajax({
        method:'GET',
        url:'apis/api-get-dogsitters-with-the-date.php',
        data: {
            'sSearchDate': sTimestampSearchDate,
            'sSearchTimeInterval': sSelectedTime,
            'sUserEmail': window.sUserEmail,
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            let template = document.querySelector("#dogSitterTemplate").content
            let clone = template.cloneNode(true)
            let data = clone.querySelector("div")

            data.innerHTML = jData.message    
            dogSitterResults.appendChild(clone)
            
            console.log(jData.message)
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

// $('dog-sitter-card').click(function(){
    

// })


