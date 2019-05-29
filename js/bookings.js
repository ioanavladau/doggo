

// window.addEventListener("load", function() {
    
// });

window.onload = function(){

    let sBookingType = 'upcoming'
    // store tabs variable
    
    console.log(sBookingType)
    $.ajax({
        method:'GET',
        url:'apis/api-get-bookings.php',
        data: {
            'sUserEmail': window.sUserEmail,
            'sBookingType': sBookingType
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            $('#booking-row').append(jData.message);
        }else if(jData.status == 2){
            $('#booking-row-two').append(jData.message);
        }else if(jData.status == 3){
            $('#booking-row-three').append(jData.message);
        }
    }).fail(function(){
        console.log('api-get-bookings does not work')
    });

    $.ajax({
        method:'GET',
        url:'apis/api-get-requests.php',
        data: {
            'sUserEmail': window.sUserEmail
        },
        dataType:'JSON'
    }).done(function(jData){
        
        if(jData.status == 1){
            // console.log(jData.message)
            $('#booking-requests').append($(jData.message));
        }
    }).fail(function(){
        console.log('api-get-requests does not work')
    });

    $.ajax({
        method:'GET',
        url:'apis/api-get-accepted-requests.php',
        data: {
            'sUserEmail': window.sUserEmail
        },
        dataType:'JSON'
    }).done(function(jData){
        
        if(jData.status == 1){
            // console.log(jData.message)
            $('#accepted-booking-requests').append($(jData.message));
        }
    }).fail(function(){
        console.log('api-get-accepted-requests does not work')
    });

    $.ajax({
        method:'GET',
        url:'apis/api-get-declined-requests.php',
        data: {
            'sUserEmail': window.sUserEmail
        },
        dataType:'JSON'
    }).done(function(jData){
        
        if(jData.status == 1){
            // console.log(jData.message)
            $('#declined-booking-requests').append($(jData.message));
        }
    }).fail(function(){
        console.log('api-get-declined-requests does not work')
    });
    
}   

$('#pending, #archived, #upcoming').click(function(){
    // store tabs variable
    myTabs = document.querySelectorAll("ul.nav-tabs > li");
    function myTabClicks(tabClickEvent) {
        for (i = 0; i < myTabs.length; i++) {
            myTabs[i].classList.remove("active");
        }
        clickedTab = tabClickEvent.currentTarget;
        clickedTab.classList.add("active");
        tabClickEvent.preventDefault();
        sBookingType = clickedTab.getAttribute("id");
        myContentPanes = document.querySelectorAll(".tab-pane");
        for (i = 0; i < myContentPanes.length; i++) {
            myContentPanes[i].classList.remove("active");
        }
        anchorReference = tabClickEvent.target;
        activePaneId = anchorReference.getAttribute("href");
        activePane = document.querySelector(activePaneId);
        activePane.classList.add("active");



        console.log(sBookingType)
        $.ajax({
            method:'GET',
            url:'apis/api-get-bookings.php',
            data: {
                'sUserEmail': window.sUserEmail,
                'sBookingType': sBookingType
            },
            dataType:'JSON'
        }).done(function(jData){
            console.log(jData)
            if(jData.status == 1){
                $('#booking-row').empty();
                $('#booking-row').append(jData.message);
            }else if(jData.status == 2){
                $('#booking-row-two').empty();
                $('#booking-row-two').append(jData.message);
            }else if(jData.status == 3){
                $('#booking-row-three').empty();
                $('#booking-row-three').append(jData.message);
            }
        }).fail(function(){
            console.log('api-get-bookings does not work')
        });

       


    }
    for (i = 0; i < myTabs.length; i++) {
        myTabs[i].addEventListener("click", myTabClicks)
    }

    
})


$("body").on("click", ".accept-btn", function(){
let iBookingId = this.dataset.bookingid

$.ajax({
    method:'GET',
    url:'apis/api-confirm-booking.php',
    data: {
        'iBookingId': iBookingId
    },
    dataType:'JSON'
}).done(function(jData){
    console.log(jData)
    if(jData.status == 1){
        console.log(jData.message)
        location.reload()
        // $('#booking-row tbody').empty();
        // $('#booking-row tbody').append(jData.message);
    }
}).fail(function(){
    console.log('api-confirm-bookings does not work')
});
});


$("body").on("click", ".decline-btn", function(){
let iBookingId = this.dataset.bookingid
let iBookingdate = this.dataset.bookingdate
let iDogsitterfk = this.dataset.dogsitterfk

$.ajax({
    method:'GET',
    url:'apis/api-decline-booking.php',
    data: {
        'iBookingId': iBookingId,
        'iBookingdate': iBookingdate,
        'iDogsitterfk': iDogsitterfk
    },
    dataType:'JSON'
}).done(function(jData){
    console.log(jData)
    if(jData.status == 1){
        console.log(jData.message)
        location.reload()
    }
}).fail(function(){
    console.log('api-decline-bookings does not work')
});
});


$("body").on("click", ".cancel-booking", function(event){
    let iBookingId = this.dataset.bookingid
    let iBookingdate = this.dataset.bookingdate
    let iDogsitterfk = this.dataset.dogsitterfk
       
    $.ajax({
        method:'GET',
        url:'apis/api-delete-booking.php',
        data: {
            'iBookingId': iBookingId,
            'iBookingdate': iBookingdate,
            'iDogsitterfk': iDogsitterfk
        },
        dataType:'JSON'
    }).done(function(jData){
        console.log(jData)
        if(jData.status == 1){
            console.log(jData.message)
            location.reload()

        }
    }).fail(function(){
        console.log('api-delete-booking does not work')
    })
    
})


$("body").on("click", ".leave-a-review", function(){

    let iBookingFk = this.dataset.bookingfk
    let iDogsitterfk = this.dataset.dogsitterfk

    window.location.href = "review-form?bookingfk="+iBookingFk+"&dogsitterfk="+iDogsitterfk


    
})