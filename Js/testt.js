var openModalButton  = document.querySelectorAll('[data-modal-target]')
var closeModalButton  = document.querySelectorAll('[data-close-button]')
var overlay = document.getElementById('overlay')

openModalButton.forEach(button => {
  button.addEventListener('click', () => {
    var modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
    console.log("uwuwuwu");
  })
})

// overlay.addEventListener('click', () => {
//   const modals = document.querySelectorAll('.modal.active')
//   modals.forEach(modal => {
//     closeModal(modal)
//   })
// })

// ↑↑↑↑↑↑↑↑↑↑
// when click on overlay (background) it closes the modal

closeModalButton.forEach(button => {
  button.addEventListener('click', () => {
    var modal = button.closest('.modal')
    closeModal(modal)
  })
})

function openModal(modal) {
  modal.classList.add('active')
  overlay.classList.add('active')
}

function closeModal(modal) {
  modal.classList.remove('active')
  overlay.classList.remove('active')
             $.ajax({
              url: "modificar.php",
              type: "POST",
              data: $("#none").serialize(),
              success: function (respo) {
                $('#contain_tablas').html(respo);
                 
              }
          });

}



  // ----------------------------------------------DELETE---------------------------------

  var deleteButtons = document.querySelectorAll('.delete');

  deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
          var userId = this.dataset.userId;
          var userRole = button.getAttribute('data-role');

          console.log("chaooo "+ userId);

          console.log("holaaaa "+ userRole);
          // Send AJAX request to delete_user.php

          var chao = {
            userId : userId,
            userRole: userRole
          }
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'delete.php', true);
          xhr.setRequestHeader('Content-Type', 'application/json');

          xhr.onload = function() {
              if (xhr.status === 200) {
                  // Delete the table row from the DOM
                  console.log(xhr.responseText);
                  var tableRow = document.getElementById('table_row_' + userId);
                  if (tableRow) {
                      tableRow.remove();
                  }
              } else {
                  console.error('Error deleting user:', xhr.statusText);
              }
          };

          xhr.onerror = function() {
              console.error('AJAX request failed');
          };

          xhr.send(JSON.stringify(chao));
      });
  });
