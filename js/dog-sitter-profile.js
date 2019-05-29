window.onload = function(){
    $.ajax({
        method:'GET',
        url:'apis/api-get-available-dates.php',
        data: {
            'sUserEmail': window.sHeaderDogSitterEmail
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            let aAvailableDates = jData.message.split(',');
            console.log(aAvailableDates)

            aAvailableDates.forEach(function(availableDate){
                console.log(availableDate)
                let foundelement = $("tr").find("td[data-date='" + availableDate +"']")
                foundelement.addClass('green-date')

              });

        }else{

        }
    }).fail(function(){
        console.log('api-get-available-dates does not work')
    });


    $.ajax({
        method:'GET',
        url:'apis/api-get-reviews.php',
        data: {
            'sUserEmail': window.sHeaderDogSitterEmail
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            console.log(jData.message)
            $('#reviews-box').append(jData.message);
        }else{

        }
    }).fail(function(){
        console.log('api-get-reviews does not work')
    });

    return false
} 