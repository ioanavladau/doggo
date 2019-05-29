console.log("add dog page")

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

// DISABLE ADD DOG BUTTON IF THERE IS NO IMAGE UPLOADED

// $(document).ready(
//   function(){
//       $('input:file').change(
//           function(){
//               if ($(this).val()) {
//                   $('input:submit').attr('disabled',false);
//                   // or, as has been pointed out elsewhere:
//                   // $('input:submit').removeAttr('disabled'); 
//               } 
//           }
//         );
//   });


// TODO: AJAX CALL FOR SUBMITTING FORM WITH image
// IT PROBABLY NEEDS MORE PARAMETERS IN THE AJAX CALL
// https://makitweb.com/how-to-upload-image-file-using-ajax-and-jquery/
// https://stackoverflow.com/questions/4406348/how-to-add-data-via-ajax-serialize-extra-data-like-this

$('#frmAddDog').submit( function(evt){

  // var fd = new FormData();
  // var files = $('#fileToUpload')[0].files[0];
  // fd.append('file',files);
  evt.preventDefault();
  var formData = new FormData($(this)[0]);

  $.ajax({
      method:"POST",
      url:"apis/api-set-dog",
      data: formData,
      enctype: 'multipart/form-data',
      contentType: false,
      processData: false,
      cache: false,
      dataType:"JSON",
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
              title: "Add more information about your dog.",
              text: jData.message,
              icon: "warning",
          });
      }
  }).fail(function(){
      console.log('api-set-dog does not work')
  });

  // return false
})