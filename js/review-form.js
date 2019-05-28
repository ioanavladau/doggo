let iRating

function isHover(e) {
    return (e.parentElement.querySelector(':hover') === e);
}
  
  
let oneStar = document.querySelector('[data-star="1"]')
let twoStar = document.querySelector('[data-star="2"]')
let threeStar = document.querySelector('[data-star="3"]')
let fourStar = document.querySelector('[data-star="4"]')
let fiveStar = document.querySelector('[data-star="5"]')
console.log(fiveStar)


$(document).ready(function(){
    $(fiveStar).mouseover(function(){
        $(oneStar).children().children().children().css("fill", "#f4db27");
        $(twoStar).children().children().children().css("fill", "#f4db27");
        $(threeStar).children().children().children().css("fill", "#f4db27");
        $(fourStar).children().children().children().css("fill", "#f4db27");
    });
    $(fiveStar).mouseout(function(){
        $(oneStar).children().children().children().css("fill", "#E0E0E0");
        $(twoStar).children().children().children().css("fill", "#E0E0E0");
        $(threeStar).children().children().children().css("fill", "#E0E0E0");
        $(fourStar).children().children().children().css("fill", "#E0E0E0");
    });


    $(fourStar).mouseover(function(){
        $(oneStar).children().children().children().css("fill", "#f4db27");
        $(twoStar).children().children().children().css("fill", "#f4db27");
        $(threeStar).children().children().children().css("fill", "#f4db27");
        $(fiveStar).children().children().children().removeClass('yellow-star');
    });
    $(fourStar).mouseout(function(){
        $(oneStar).children().children().children().css("fill", "#E0E0E0");
        $(twoStar).children().children().children().css("fill", "#E0E0E0");
        $(threeStar).children().children().children().css("fill", "#E0E0E0");
    });


    $(threeStar).mouseover(function(){
        $(oneStar).children().children().children().css("fill", "#f4db27");
        $(twoStar).children().children().children().css("fill", "#f4db27");
        $(fourStar).children().children().children().removeClass('yellow-star');
        $(fiveStar).children().children().children().removeClass('yellow-star');
    });
    $(threeStar).mouseout(function(){
        $(oneStar).children().children().children().css("fill", "#E0E0E0");
        $(twoStar).children().children().children().css("fill", "#E0E0E0");
    });


    $(twoStar).mouseover(function(){
        $(oneStar).children().children().children().css("fill", "#f4db27");
        $(threeStar).children().children().children().removeClass('yellow-star');
        $(fourStar).children().children().children().removeClass('yellow-star');
        $(fiveStar).children().children().children().removeClass('yellow-star');
    });
    $(twoStar).mouseout(function(){
        $(oneStar).children().children().children().css("fill", "#E0E0E0");
    });


    $(oneStar).mouseover(function(){
        $(twoStar).children().children().children().removeClass('yellow-star');
        $(threeStar).children().children().children().removeClass('yellow-star');
        $(fourStar).children().children().children().removeClass('yellow-star');
        $(fiveStar).children().children().children().removeClass('yellow-star');
    });
});



$('.review-star').click(function(){
    iRating = this.dataset.star
    console.log(iRating)
    
    let currEl
    for(i=1; i<= iRating; i++){
        $('[data-star="'+i+'"]').children().children().children().addClass("yellow-star")
    }
    
})

if(iRating==undefined){
    iRating = 0
}

$('.submit-review').click(function(){
    // console.log('Ratig outside of the review star onclick: '+iRating)
    // console.log(window.iBookingFk)
    // console.log(window.iDogsitterfk)
    // console.log(window.sUserEmail)
    // console.log($('#txtReview').val())
    // console.log(iRating)

    let sReviewText = $('#txtReview').val()

    $.ajax({
        method:'GET',
        url:'apis/api-set-review-booking.php',
        data: {
            'iBookingFk': window.iBookingFk,
            'iDogsitterfk': window.iDogsitterfk,
            'sUserEmail': window.sUserEmail,
            'iRating': iRating,
            'sReviewText': sReviewText
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            console.log(jData.message)
            window.location.href = "bookings"
        }
    }).fail(function(){
        console.log('api-set-review-booking does not work')
        // window.location.href = "bookings"
    })
    return false;
})

    