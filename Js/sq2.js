document.addEventListener('DOMContentLoaded', function() {

    // --------------------------------------------CREATE MEDIC----------------------------------------------------------

  var guardarButton = document.getElementById("guardar-button");
  
  guardarButton.addEventListener("click", function() {
      console.log("i love everything you do.");
      var idNumber = document.querySelector('input[name="doc_id-number"]').value;
      var name = document.querySelector('input[name="doc_name"]').value;
      var age = document.querySelector('input[name="doc_age"]').value;
      var phoneNumber = document.querySelector('input[name="doc_phone-number"]').value;
      var email = document.querySelector('input[name="doc_email"]').value;
      var sex = document.querySelector('input[name="doc_sex"]').value;
      
      var datos = {
          idNumber: idNumber,
          name: name,
          age: age,
          phoneNumber: phoneNumber,
          email: email,
          sex: sex
      };
      
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "new_medic.php", true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText);
              console.log(datos);
          }
      };
      xhr.send(JSON.stringify(datos));
  });

    // ------------------------------------------ CREATE PATIENT----------------------------------------------

  var valo = document.getElementById("paciente-nuevo");
  
  valo.addEventListener("click", function() {
      
      console.log("when u call me fucking dumb for the stupid shit i do.");
      var pat_docType = document.querySelector('select[name="pat-id-type"]').value;
      var pat_idNumber = document.querySelector('input[name="pat_id-number"]').value;
      var pat_name = document.querySelector('input[name="pat_name"]').value;
      var pat_age = document.querySelector('input[name="pat_age"]').value;
      var pat_phoneNumber = document.querySelector('input[name="pat_phone-number"]').value;
      var pat_email = document.querySelector('input[name="pat_email"]').value;
      var pat_sex = document.querySelector('input[name="pat_sex"]').value;
      var pat_afiliation = document.querySelector('select[name="pat-afi"]').value;
     
      
      
      var daticos = {
          pat_idNumber: pat_idNumber,
          pat_name: pat_name,
          pat_age: pat_age,
          pat_phoneNumber: pat_phoneNumber,
          pat_email: pat_email,
          pat_sex: pat_sex,
          pat_docType: pat_docType,
          pat_afiliation: pat_afiliation
      };
      
      
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "new_patient.php", true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText);
              console.log(daticos);
          }
      };
      xhr.send(JSON.stringify(daticos));
  });

//   --------------------------------------------CREATE PRE-CITA--------------------------

    function horaClickCita() {

        let time;
        let date;
        let final;
        
        const now = new Date();

        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1
        const day = String(now.getDate()).padStart(2, '0');
        date = `${year}-${month}-${day}`;


        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        time = `${hours}:${minutes}:${seconds}`;

        final = `${date} ${time}`;
        
        return final;
    }

    var nananai = document.getElementById("cita-nueva");
    
    nananai.addEventListener("click", function() {
        
        console.log("no matter what they say.");
        console.log(horaClickCita());

        var cita_idNumber = document.querySelector('input[name="identi_cita"]').value;
        var cita_docType = document.querySelector('input[name="type_id_cita"]').value;
        var cita_name = document.querySelector('input[name="name_cita"]').value;
        var cita_age = document.querySelector('input[name="edad_cita"]').value;
        var cita_afiliation = document.querySelector('input[name="tipo_afiliacion_cita"]').value;
        var cita_typeCita = document.querySelector('select[name="tipo_cita"]').value;
        var cita_date = document.querySelector('input[name="fecha_cita"]').value;
        var cita_startTime = document.querySelector('select[name="hora_inicio"]').value;
        var cita_endTime = document.querySelector('select[name="hora_final"]').value;
        var cita_sendTime = horaClickCita();
        
        var cita = {
            cita_idNumber: cita_idNumber,
            cita_docType : cita_docType,
            cita_name : cita_name,
            cita_age : cita_age,
            cita_afiliation : cita_afiliation,
            cita_typeCita : cita_typeCita,
            cita_date : cita_date,
            cita_startTime : cita_startTime,
            cita_endTime : cita_endTime,
            cita_sendTime: cita_sendTime
        };
        
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "new_preagendamiento.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                console.log(cita);
            }
        };
        xhr.send(JSON.stringify(cita));
    });


//   --------------------------------------------CREATE PATOLOGIA--------------------------

    var instagram = document.getElementById("guardar-pato");
    
    instagram.addEventListener("click", function() {
        
        console.log("patico");
        var pato_name = document.querySelector('input[name="pato_name"]').value;
        var pato_score = document.querySelector('input[name="pato_score"]').value;
        
        var patos = {
            pato_name: pato_name,
            pato_score: pato_score
        };
        
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "new_patologia.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                console.log(patos);
            }
        };
        xhr.send(JSON.stringify(patos));
    });

//   --------------------------------------------CREATE CITA TYPE--------------------------

    var citatype = document.getElementById("guardar-citatype");
    
    citatype.addEventListener("click", function() {
        
        console.log("ostia tio");
        var typec_name = document.querySelector('input[name="name_citatype"]').value;
        
        var cita = {
            typec_name: typec_name
        };
        
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "new_citatype.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                console.log(cita);
            }
        };
        xhr.send(JSON.stringify(cita));
    });

    //   --------------------------------------------CREATE ESPECIALIDAD--------------------------

    var youaremyspecial = document.getElementById("guardar-espe");
    
    youaremyspecial.addEventListener("click", function() {
        
        console.log("YOU ARE MY SPECIAL");
        var special_name = document.querySelector('input[name="espe_name"]').value;
        
        var especial = {
            special_name : special_name
        };
        
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "new_especialidad.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                console.log(especial);
            }
        };
        xhr.send(JSON.stringify(especial));
    });

  // ----------------------------------------------DELETE---------------------------------

      document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete')) {
          var userId = event.target.dataset.userId;
          var userRole = event.target.getAttribute('data-role');
        
          console.log("user: "+ userId);
          console.log("rol: "+ userRole);
          // Send AJAX request to delete_user.php

          var byebye = {
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

                    var tableRow = document.getElementById("table_row_" + userId);
                    var patotableRow = document.getElementById("patotable_row_" + userId);
                    var tipoctableRow = document.getElementById("tipoctable_row_" + userId);
                    var specialtableRow = document.getElementById("specialtable_row_" + userId);
                    var roletableRow = document.getElementById("roletable_row_" + userId);
                    var precitatableRow = document.getElementById("precitatable_row_" + userId);
                    var citatableRow = document.getElementById("citatable_row_" + userId);

                    if (tableRow && (userRole == 'usuario' || userRole=='medico')) {
                        tableRow.remove();
                        console.log('chao');
                    }
                    else{
                        if (patotableRow && userRole == 'patologia') {
                            patotableRow.remove();
                            console.log('patochao');
                        }
                        else{
                            if (tipoctableRow && userRole == 'tipocita') {
                                tipoctableRow.remove();
                                console.log('tipocchao');
                            }
                            else{
                                if(specialtableRow && userRole == 'especialidad'){
                                    specialtableRow.remove();
                                    console.log('specialchao');
                                }
                                else{
                                    if(roletableRow && userRole == 'rol'){
                                        roletableRow.remove();
                                        console.log('rolchao');
                                    }
                                    else{
                                        if(precitatableRow && userRole == 'preagendamiento'){
                                            precitatableRow.remove();
                                            console.log('precitachao');
                                        }
                                        else{
                                            if (citatableRow && userRole == 'cita') {
                                                citatableRow.remove();
                                                console.log('citachao');
                                            }
                                        }
                                    }
                                }
                            } 
                        }
                    }

              } else {
                  console.error('Error deleting user:', xhr.statusText);
              }
          };

          xhr.onerror = function() {
              console.error('AJAX request failed');
          };

          xhr.send(JSON.stringify(byebye));
        }
      });
    
  // // --------------------------------------- MODAL ------------------------------

var overlay = document.getElementById('overlay')

// Event delegation for dynamically added buttons
document.addEventListener('click', function(event) {
    var target = event.target;
    if (target.matches('[data-modal-target]')) {
        var modal = document.querySelector(target.dataset.modalTarget);
        openModal(modal);
        console.log("uwuwuwu");
    } else if (target.matches('[data-close-button]')) {
        var modal = target.closest('.modal');
        closeModal(modal);
    }
});

function openModal(modal) {
    modal.classList.add('active');
    overlay.classList.add('active');
}

function closeModal(modal) {
    modal.classList.remove('active');
    overlay.classList.remove('active');
}
  

// -----------------------UPDATE USERS WHEN CLICK ON BUTTON-------------------------

    document.addEventListener("click", function(event) {
        // Get the modal id associated with this button
        if(event.target.classList.contains('save-button') && event.target.id === 'save-user') {
            // Get the modal id associated with this button
            var modalId = event.target.getAttribute('data-modal-id');
            
            // Find all input fields within the modal
            var modal = document.getElementById(modalId);
            var inputs = modal.querySelectorAll('input');

            // Prepare data object to send via AJAX
            var data = {};
            inputs.forEach(input => {
                data[input.name] = input.value;
            });

            // Send AJAX request to update user data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update.php", true);
            // Set Content-Type header for JSON data
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle successful response
                        alert('Data Updated');
                    } else {
                        // Handle error response
                        alert('Error occurred while updating data');
                    }
                }
            };
            xhr.send(JSON.stringify(data));
        }
    });

    // -----------------------UPDATE PRE-CITA-------------------------

    document.addEventListener("click", function(event) {
        // Get the modal id associated with this button
        if(event.target.classList.contains('save-button') && event.target.id === 'save-preagendamiento') {
            // Get the modal id associated with this button
            console.log("heroico insano")
            var modalId = event.target.getAttribute('data-modal-id');
            
            // Find all input fields within the modal
            var modal = document.getElementById(modalId);
            var inputs = modal.querySelectorAll('input, select');

            // Prepare data object to send via AJAX
            var appointment = {};
            inputs.forEach(input => {
                appointment[input.name] = input.value;
            });

            // Send AJAX request to update user data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_preagendamiento.php", true);
            // Set Content-Type header for JSON data
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle successful response
                        alert('Data Updated');
                    } else {
                        // Handle error response
                        alert('Error occurred while updating data');
                    }
                }
            };
            xhr.send(JSON.stringify(appointment));
        }
    });



// -----------------------UPDATE PATOLOGIA-------------------------

    document.addEventListener("click", function(event) {
        // Get the modal id associated with this button
        if(event.target.classList.contains('save-button') && event.target.id === 'save-patologia') {
            // Get the modal id associated with this button
            console.log("keiti sapa")
            var modalId = event.target.getAttribute('data-modal-id');
            
            // Find all input fields within the modal
            var modal = document.getElementById(modalId);
            var inputs = modal.querySelectorAll('input');

            // Prepare data object to send via AJAX
            var quack = {};
            inputs.forEach(input => {
                quack[input.name] = input.value;
            });

            // Send AJAX request to update user data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_patologia.php", true);
            // Set Content-Type header for JSON data
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle successful response
                        alert('Data Updated');
                    } else {
                        // Handle error response
                        alert('Error occurred while updating data');
                    }
                }
            };
            xhr.send(JSON.stringify(quack));
        }
    });

    // -----------------------UPDATE cita type-------------------------

    document.addEventListener("click", function(event) {
        // Get the modal id associated with this button
        if(event.target.classList.contains('save-button') && event.target.id === 'save-typecita') {
            // Get the modal id associated with this button
            console.log("am i your type??")
            var modalId = event.target.getAttribute('data-modal-id');
            
            // Find all input fields within the modal
            var modal = document.getElementById(modalId);
            var inputs = modal.querySelectorAll('input');

            // Prepare data object to send via AJAX
            var taip = {};
            inputs.forEach(input => {
                taip[input.name] = input.value;
            });

            // Send AJAX request to update user data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_citatype.php", true);
            // Set Content-Type header for JSON data
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle successful response
                        alert('Data Updated');
                    } else {
                        // Handle error response
                        alert('Error occurred while updating data');
                    }
                }
            };
            xhr.send(JSON.stringify(taip));
        }
    });

    // -----------------------UPDATE ESPECIALIDAD-------------------------

    document.addEventListener("click", function(event) {
        // Get the modal id associated with this button
        if(event.target.classList.contains('save-button') && event.target.id === 'save-especial') {
            // Get the modal id associated with this button
            console.log("especialll")
            var modalId = event.target.getAttribute('data-modal-id');
            
            // Find all input fields within the modal
            var modal = document.getElementById(modalId);
            var inputs = modal.querySelectorAll('input');

            // Prepare data object to send via AJAX
            var esp = {};
            inputs.forEach(input => {
                esp[input.name] = input.value;
            });

            // Send AJAX request to update user data
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_especialidad.php", true);
            // Set Content-Type header for JSON data
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle successful response
                        alert('Data Updated');
                    } else {
                        // Handle error response
                        alert('Error occurred while updating data');
                    }
                }
            };
            xhr.send(JSON.stringify(esp));
        }
    });

// -----------------AJAX-----------------

function tabla_medico() {
  $.ajax({
  url: "ajax_tabla_medico.php",
  type: "POST",
  data: $("#none").serialize(),
  success: function (respo) {
    $('#contain_tablas').html(respo);
  }
  });
}

function tabla_paciente() {
  $.ajax({
  url: "ajax_tabla_paciente.php",
  type: "POST",
  data: $("#none").serialize(),
  success: function (respo) {
    $('#contain_tablas_pac').html(respo);
  }
  });
}

function tabla_patologia() {
  $.ajax({
  url: "ajax_tabla_patologia.php",
  type: "POST",
  data: $("#none").serialize(),
  success: function (respo) {
    $('#contain_tablas_pato').html(respo);
  }
  });
}

function tabla_tipocitas() {
  $.ajax({
  url: "ajax_tabla_tipocitas.php",
  type: "POST",
  data: $("#none").serialize(),
  success: function (respo) {
    $('#contain_tablas_tipocita').html(respo);
  }
  });
}

function tabla_especialidades() {
  $.ajax({
  url: "ajax_tabla_especialidades.php",
  type: "POST",
  data: $("#none").serialize(),
  success: function (respo) {
    $('#contain_tablas_especialidad').html(respo);
  }
  });
}

function tabla_citas() {
  $.ajax({
  url: "ajax_tabla_citas.php",
  type: "POST",
  data: $("#none").serialize(),
  success: function (respo) {
    $('#contain_tabla_citas').html(respo);
  }
  });
}

function tabla_preagendamiento() {
  $.ajax({
  url: "ajax_tabla_preagendamiento.php",
  type: "POST",
  data: $("#none").serialize(),
  success: function (respo) {
    $('#contain_tabla_preagendamiento').html(respo);
  }
  });
}

// update modal paciente and doctor

$(".save-button, #save-user, #save-patologia, #save-typecita, #guardar-button, #paciente-nuevo, #guardar-pato, #guardar-citatype, #save-especial, #guardar-espe, #cita-nueva, #save-preagendamiento").click(function () {
    tabla_medico();
    tabla_paciente();
    tabla_patologia();
    tabla_tipocitas();
    tabla_especialidades();
    tabla_citas();
    tabla_preagendamiento();
});


});


function buscar_datos(url,data,respuesta){
    $.ajax({
        url: ""+url,
        type: "POST",
        data: $("#"+data).serialize(),
        success: function (respo) {
          $('#'+respuesta).html(respo);
        }
    });


}


function boton_(botonn){
    $("#"+botonn).click(function () {
        buscar_datos();
    });
}

function evento_click(url,data,respuesta,boton){
    buscar_datos(url,data,respuesta);
    boton_(boton);
}


