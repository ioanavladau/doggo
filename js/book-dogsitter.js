// var sData = $('#frmBookDogsitter').serializeArray();
 
// sData.push({name: "sUserEmail", value: window.sUserEmail}, 
//            {name: "sDogSitterId", value: window.sDogSitterId});

// console.log(sData)

$('#frmBookDogsitter').submit( function(){

    $.ajax({
        method:"GET",
        url:"apis/api-book-dogsitter.php",
        data: $('#frmBookDogsitter').serialize()+"&sUserEmail=" + window.sUserEmail + "&sDogSitterId=" + window.sDogSitterId + "&sTime=" + window.sTimeInterval + "&sDate=" + window.sSearchDate,
        // data: sData,
        dataType:"JSON"
    }).done(function(jData){
        // console.log(jData)
        if(jData.status == 1){
          console.log(jData);
          swal({
              title: "Success",
              text: "You contacted the dog sitter",
              icon: "success",
              button: "Go to bookings",
          }).then(function() {
            location.href = 'bookings';
          });
        }
        if(jData.status == 0){
            // swal({
            //     title: "There was a problem with your submission. Please try again.",
            //     text: jData.message,
            //     icon: "warning",
            // });
  
        }
    }).fail(function(){
        console.log('API book-dogsitter does not work')
    });
  
    return false
  })