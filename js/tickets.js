function imageExists(image_url){
    var http = new XMLHttpRequest();
    http.open('HEAD', image_url, false);
    http.send();
    if(http.status != 404){ return true; }else{ return false; }
}

function ialert(text)
{
  document.getElementById('ialert').innerHTML = text;
}

function fileTicket(elem,id,a,img,progress) {
    var count = document.getElementById(elem).files.length;
          //document.getElementById('details').innerHTML = "";
          for (var index = 0; index < count; index ++)
          {
                 var file = document.getElementById(elem).files[index];
                 var fileSize = 0;
                 if (file.size > 1024 * 1024)
                        fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
                 else
                        fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
                 //document.getElementById('details').innerHTML += 'Name: ' + file.name + '<br>Size: ' + fileSize + '<br>Type: ' + file.type;
                 //document.getElementById('details').innerHTML += '<p>';
          }
         //ialert("1. File Upload : "+img);
         uploadTicket(elem,id,a,img,progress);
  }

 function uploadTicket(elem,id,a,img,progress) {
    var fd = new FormData();
          var count = document.getElementById(elem).files.length;
          for (var index = 0; index < count; index ++)
          {
                 var file = document.getElementById(elem).files[index];
                 fd.append('myFile', file);
          }
    var xhr = new XMLHttpRequest();
    xhr.upload.addEventListener("progress", uploadTicketProgress, false);
    xhr.addEventListener("load", uploadTicketComplete, false);
    xhr.addEventListener("error", uploadTicketFailed, false);
    xhr.addEventListener("abort", uploadTicketCanceled, false);
    xhr.open("POST", "saveTicket.php?id="+id+"&imgname="+a);
    xhr.onload = function () {
      console.log('DONE: ', xhr.status);
      if(xhr.status==200){
        document.getElementById(img).src = "images/tickets/"+id+"/"+a;
        //ialert("images/tickets/"+id+"/"+a);
     }
    };
    xhr.send(fd);

  }

 /* 
function fileCaim(elem,id,a,img,progress) {
  var count = document.getElementById(elem).files.length;
        //document.getElementById('details').innerHTML = "";
        for (var index = 0; index < count; index ++)
        {
               var file = document.getElementById(elem).files[index];
               var fileSize = 0;
               if (file.size > 1024 * 1024)
                      fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
               else
                      fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
               //document.getElementById('details').innerHTML += 'Name: ' + file.name + '<br>Size: ' + fileSize + '<br>Type: ' + file.type;
               //document.getElementById('details').innerHTML += '<p>';
        }
       uploadCaim(elem,id,a,img,progress);
}

function uploadCaim(elem,id,a,img,progress) {
  var fd = new FormData();
        var count = document.getElementById(elem).files.length;
        for (var index = 0; index < count; index ++)
        {
               var file = document.getElementById(elem).files[index];
               fd.append('myFile', file);
        }
  var xhr = new XMLHttpRequest();
  xhr.upload.addEventListener("progress", uploadTicketProgress, false);
  xhr.addEventListener("load", uploadTicketComplete, false);
  xhr.addEventListener("error", uploadTicketFailed, false);
  xhr.addEventListener("abort", uploadTicketCanceled, false);
  xhr.open("POST", "saveCaim.php?id="+id+"&imgname="+a);
  xhr.onload = function () {
    console.log('DONE: ', xhr.status);
    if(xhr.status==200){
      document.getElementById(img).src = "images/caims/"+id+"/"+a;
   }
  };
  xhr.send(fd);

}
*/

 function uploadTicketProgress(evt) {
    if (evt.lengthComputable) {
      var percentComplete = Math.round(evt.loaded * 100 / evt.total);
      document.getElementById("progress").innerHTML = percentComplete.toString() + '%';
    }
    else {
      document.getElementById("progress").innerHTML = 'unable to compute';
    }
  }

 function uploadTicketComplete(evt) {
   //alert(evt.target.responseText);
   document.getElementsByClassName("cover")[0].style.display='block';
   document.getElementById("imgshow1").src += `?v=${new Date().getTime()}`;
   document.getElementById("imgshow2").src += `?v=${new Date().getTime()}`;
   document.getElementById("imgshow3").src += `?v=${new Date().getTime()}`;
   document.getElementById("imgshow4").src += `?v=${new Date().getTime()}`;
   setTimeout(function(){ 
   document.getElementsByClassName("cover")[0].style.display='none';
    }, 3000);
  }

 function uploadTicketFailed(evt) {
    alert("There was an error attempting to upload the file.");
  }

 function uploadTicketCanceled(evt) {
    alert("The upload has been canceled by the user or the browser dropped the connection.");
  }

  function ReloadTicketIMG(evt) {
    document.getElementById("imgshow1").src += `?v=${new Date().getTime()}`;
    document.getElementById("imgshow2").src += `?v=${new Date().getTime()}`;
    document.getElementById("imgshow3").src += `?v=${new Date().getTime()}`;
    document.getElementById("imgshow4").src += `?v=${new Date().getTime()}`;
   }

function imgZoom(src,title){
        Swal.fire({
      html: title,
      imageUrl: src+=`?v=${new Date().getTime()}`,
      imageWidth: '100%',
      imageHeight: '100%',
      imageAlt: 'Picture',
      showConfirmButton: false,
      timer: 5500
      });
}
  
function gotoFoot() {
  $("html, body").animate({ scrollTop: $(document).height() }, 1000);
}
