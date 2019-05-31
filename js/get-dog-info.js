console.log("show dog info")

function previewImage() {

  let preview = document.querySelector('#dog-image-preview');
  let file    = document.querySelector('input[type=file]').files[0];
  let reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}

window.onload = function(){
  const urlParams = new URLSearchParams(window.location.search);
  const dogId = urlParams.get('id');

  $.ajax({
      method:'GET',
      url:'apis/api-get-dog-edit-page.php',
      data: {
          'sUserEmail': window.sUserEmail,
          'id': dogId
      },
      dataType:'JSON'
  }).done(function(jData){
      console.log(jData)
      if(jData.status == 1){
         $(".about-text #dog-name").text(jData.message.sDogName);
         $(".about-text #dog-breed").text(jData.message.sDogBreed);
         $("#dog-image-preview").attr('src', jData.message.sDogImageUrl);

        if($("#txtiDogWeight").is("input")){
          $("#txtiDogWeight").val(jData.message.iDogWeight);
        } else {
          $("#txtiDogWeight").text(jData.message.iDogWeight);
        }


         if(jData.message.bDogSpayedNeutered == 1){
          $("input[name='rbDogSpayedNeutered']:first").prop('checked', true);
         } else {
          $("input[name='rbDogSpayedNeutered']:last").prop('checked', true);
         }

         if(jData.message.bDogMicrochipped == 1){
          $("input[name='rbDogMicrochipped']:first").prop('checked', true);
         } else {
          $("input[name='rbDogMicrochipped']:last").prop('checked', true);
         }

         if(jData.message.bDogFriendly == 1){
          $("input[name='rbDogFriendlyWithOtherDogs']:first").prop('checked', true);
         } else {
          $("input[name='rbDogFriendlyWithOtherDogs']:last").prop('checked', true);
         }

         
        if($("#txtsDogSpecialRequirements").is("input")){
            $("#txtsDogSpecialRequirements").val(jData.message.sDogSpecialRequirements);
        }
          else {
            if(jData.message.sDogSpecialRequirements == ''){
              $("#txtsDogSpecialRequirements").text("No special requirements specified");
            } else {
              $("#txtsDogSpecialRequirements").text(jData.message.sDogSpecialRequirements);
            }
          }


        if($("#txtsDogVetContact").is("input")){
          $("#txtsDogVetContact").val(jData.message.sDogVetContact);
        }
          else {
            if(jData.message.sDogVetContact == ''){
              $("#txtsDogVetContact").text("No vet contact specified");
            } else {
              $("#txtsDogVetContact").text(jData.message.sDogVetContact);
            }
        }


          
        if($("#txtsDogAbout").is("input")){
          $("#txtsDogAbout").val(jData.message.sDogAbout);
        }
          else {
            if(jData.message.sDogAbout == ''){
              $("#txtsDogAbout").text("No about specified");
            } else {
              $("#txtsDogAbout").text(jData.message.sDogAbout);
            }
        }


        if($("#txtsDogCareInstructions").is("input")){
          $("#txtsDogCareInstructions").val(jData.message.sDogCareInstructions);
        }
          else {
            if(jData.message.sDogCareInstructions == ''){
              $("#txtsDogCareInstructions").text("No care instructions specified");
            } else {
              $("#txtsDogCareInstructions").text(jData.message.sDogCareInstructions);
            }
        }

        //  if(jData.message.sDogCareInstructions == ''){
        //   $("#txtsDogCareInstructions").text("No care instructions specified");
        //   } else {
        //     $("#txtsDogCareInstructions").text(jData.message.sDogSpecialRequirements);
        //   }
      }else{
        $("#dog-info").text("status 0");
      }
  }).fail(function(){
      console.log('api-get-dog-edit-page does not work')
  });

  return false
} 