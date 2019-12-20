$('#typedoc').select2();

var pdf=false;

function getFileExtension(filename){
  var ext = /^.+\.([^.]+)$/.exec(filename);
  return ext == null ? "" : ext[1];
}
function ValidateSingleInput(oInput) {
  // var _validFileExtensions = [".pdf", ".jpg", ".jpeg", ".png"];
  var _validFileExtensions = [".pdf"];
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    pdf=true;
                    break;
                }
            }

            if (!blnValid) {
                swal("Oops...", "File yang diupload harus .pdf", "error");
                oInput.value = "";
                pdf=false;
                return false;
            }
        }
    }
    return true;
}

function checkFileSize(inputFile) {
var max =  1024000; // 1MB

if (inputFile.files.length && inputFile.files[0].size > max) {
    swal("Oops...", "File terlalu besar (lebih dari 1MB) ! Mohon kompres/perkecil ukuran file", "error");
    inputFile.value = null; // Clear the field.
   }
}