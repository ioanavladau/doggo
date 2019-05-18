console.log("settings page")

function previewImage() {

  let preview = document.querySelector('#profile-photo-preview');
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




// $('#frmUploadProfilePhoto').submit( function(){

//   $.ajax({
//       method:"GET",
//       url:"apis/api-set-profile-photo",
//       data: $('#frmUploadProfilePhoto').serialize(),
//       dataType:"JSON"
//   }).done(function(jData){
//       console.log(jData)
//       if(jData.status == 1){
//         console.log(jData);
//       }
//       if(jData.status == 0){
//         console.log(jData);
//       }
//   }).fail(function(){
//       console.log('API set-profile-photo does not work')
//   });

//   return false
// })