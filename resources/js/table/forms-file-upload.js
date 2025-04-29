/**
 * File Upload
 */

'use strict';

(function () {

    // ? Start your code from here

    // Basic Dropzone
    // --------------------------------------------------------------------
    const imgUpload = document.querySelector('#img-upload');
    const imagePreview = document.querySelector('#image-preview');

    if (imgUpload && imagePreview) {
        imgUpload.addEventListener('change', function (e) {
            let fileReader = new FileReader();
            fileReader.readAsDataURL(e.target.files[0]);
            fileReader.onloadend = function () {

                imagePreview.src = fileReader.result;
            }
        });
        imagePreview.addEventListener('click', function (e) {
            imgUpload.click();
        });
    }

    const deleteItem = document.querySelector('.delete-item');
    // Suspend User javascript
    if (deleteItem) {
        deleteItem.onclick = function () {
            Swal.fire({
                title: 'Es-tu sûr?',
                text: "Vous voulez vraiment supprimer cette donnée?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimez la donnée !',
                cancelButtonText: 'Annuler',
                customClass: {
                    confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
                    cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    /**
                     *
                     * @type {HTMLFormElement}
                     */
                   const target = document.getElementById(deleteItem.dataset.target);
                  if (target) {
                      target.submit();
                  }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                   //
                }
            });
        };
    }
})();
