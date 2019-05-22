

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

    return false
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
                $('#booking-row tbody').empty();
                $('#booking-row tbody').append(jData.message);
            }else if(jData.status == 2){
                $('#booking-row-two tbody').empty();
                $('#booking-row-two tbody').append(jData.message);
            }else if(jData.status == 3){
                $('#booking-row-three tbody').empty();
                $('#booking-row-three tbody').append(jData.message);
            }
        }).fail(function(){
            console.log('api-get-bookings does not work')
        });

        return false


    }
    for (i = 0; i < myTabs.length; i++) {
        myTabs[i].addEventListener("click", myTabClicks)
    }

    
})