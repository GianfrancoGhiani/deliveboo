import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


// modale per il bottone delete
//seleziono tutti gli elementi con la classe .mt-delete
const deleteSubmitButtons = document.querySelectorAll('.delete-button');

//ciclo su ogni bottone e gli aggiungo l'evento click 
deleteSubmitButtons.forEach((button) => {
   button.addEventListener('click', (event) => {
   
   //blocco la propagazione dell'evento
   event.preventDefault();

   //prendo il nome del prodotto dal bottone data-item-title={{$product->name}} per metterlo come titolo nella modale
   const dataTitle = button.getAttribute('data-item-title');

   //prendo la modale che ha display none
   const modal = document.getElementById('deleteModal');

   //creo un nuovo oggetto modal di bootstrap
   const bootstrapModal = new bootstrap.Modal(modal);
   //mostro la modale 
   bootstrapModal.show();


   const modalItemTitle = modal.querySelector('#modal-item-title');
   modalItemTitle.textContent = dataTitle;

   const buttonDelete = modal.querySelector('button.btn-danger');

   buttonDelete.addEventListener('click', () => {
         button.parentElement.submit();
      })
   })
});

//funzione per la preview dell'immagine da caricare

const previewImage = document.getElementById('image_url');
previewImage.addEventListener('change', (event) =>{
    var oFReader = new FileReader();
    oFReader.readAsDataURL(previewImage.files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
});

//questo non so cosè
// $("#menu-toggle").click(function(e) {
//     e.preventDefault();
//     $("#wrapper").toggleClass("toggled");
//  });
//  $("#menu-toggle-2").click(function(e) {
//     e.preventDefault();
//     $("#wrapper").toggleClass("toggled-2");
//     $('#menu ul').hide();
//  });
 
//  function initMenu() {
//     $('#menu ul').hide();
//     $('#menu ul').children('.current').parent().show();
//     //$('#menu ul:first').show();
//     $('#menu li a').click(
//        function() {
//           var checkElement = $(this).next();
//           if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
//              return false;
//           }
//           if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
//              $('#menu ul:visible').slideUp('normal');
//              checkElement.slideDown('normal');
//              return false;
//           }
//        }
//     );
//  }
//  $(document).ready(function() {
//     initMenu();
//  });