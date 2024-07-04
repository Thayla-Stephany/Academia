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


// Ao fazer logout, limpa o armazenamento local e desmarca todos os checkboxes na tabela
function logout() {
    localStorage.clear();
    var tabela = document.getElementById("table-row-selected");
    // ou var tabela = document.querySelector(".minha-classe-de-tabela");
    var checkboxes = tabela.getElementsByTagName("input");
    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].checked = false;
      var row = checkboxes[i].parentNode.parentNode;
      row.classList.remove('table-row-selected');
    }
}
