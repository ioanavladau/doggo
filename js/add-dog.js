$('#frmAddDog').submit( function(){

  $.ajax({
      method:"POST",
      url:"apis/api-set-dog",
      data: $('#frmAddDog').serialize(),
      dataType:"JSON"
  }).done(function(jData){
      console.log(jData)
      if(jData.status == 1){
        console.log(jData);
        swal({
            title: "Congrats!",
            text: "Dog added to your profile",
            icon: "success",
        })
        .then(function() {
          location.href = 'profile';
        });
      }
      if(jData.status == 0){
          swal({
              title: "There was a problem adding a dog. Please try again.",
              text: jData.message,
              icon: "warning",
          });

      }
  }).fail(function(){
      console.log('api-set-dog does not work')
  });

  return false
})