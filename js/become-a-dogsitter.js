$('#frmBecomeDogsitter').submit( function(){

  $.ajax({
      method:"GET",
      url:"apis/api-set-dogsitter",
      data: $('#frmBecomeDogsitter').serialize(),
      dataType:"JSON"
  }).done(function(jData){
      console.log(jData)
      if(jData.status == 1){
        console.log(jData);
        swal({
            title: "Congrats!",
            text: "You can now start adding availability dates from your profile page.",
            icon: "success",
        }).then(function() {
          location.href = 'profile';
        });
      }
      if(jData.status == 0){
          swal({
              title: "There was a problem with your submission. Please try again.",
              text: jData.message,
              icon: "warning",
          });

      }
  }).fail(function(){
      console.log('API become-a-dogsitter does not work')
  });

  return false
})