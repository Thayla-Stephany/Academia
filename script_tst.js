
//mensagem de feedback


        // Atrasar a remoção da mensagem por 5 segundos
        setTimeout(function() {
            var mensagem = document.querySelector('.mensagem');
            if (mensagem) {
                mensagem.remove(); // Remover o elemento que contém a mensagem
            }
        }, 5000); // 5000 milissegundos = 5 segundos
 

    //Marcar checkbox da ficha do aluno e deixar marcado mesmo dando refrash na pagina (F5)
        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        for (var i = 0; i < checkboxes.length; i++) {
          checkboxes[i].addEventListener('change', function() {
            var row = this.parentNode.parentNode;
            if (this.checked) {
              row.classList.add('table-row-selected');
              localStorage.setItem(row.getAttribute('data-row-id'), 'selected');
            } else {
              row.classList.remove('table-row-selected');
              localStorage.removeItem(row.getAttribute('data-row-id'));
            }
          });
        
          // Load the saved state of checkboxes on page load
          var rowId = checkboxes[i].getAttribute('id');
          var rowState = localStorage.getItem(rowId);
          if (rowState === 'selected') {
            var row = checkboxes[i].parentNode.parentNode;
            row.classList.add('table-row-selected');
            checkboxes[i].checked = true;
          }
        }