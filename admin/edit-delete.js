var editMode = false;
var deleteMode = false;

function SwitchEditMode(id) {
    if(!deleteMode) {
        var editLink = document.getElementById(id.concat('edit')).firstChild;
        var deleteLink = document.getElementById(id.concat('delete')).firstChild;

        if(!editMode) { //Enter Edit Mode
            editMode = true;
            editLink.innerHTML = 'A';
            var msg = 'Edytujesz rekord o ID:\n';   //TODO: Zaimplementować odpowiedni funkcjonalność
            alert(msg.concat(id));                  //      edytowania rekordów wyświetlanych w tabeli
            SwitchEditMode(id);
        } else { //Exit Delete Mode
            editMode = false;
            editLink.innerHTML = 'E';
        }
    }
}

function SwitchDeleteMode(id) {
    if(!editMode) {
        var editLink = document.getElementById(id.concat('edit')).firstChild;
        var deleteLink = document.getElementById(id.concat('delete')).firstChild;

        if(!deleteMode) { //Enter Delete Mode
            deleteMode = true;
            deleteLink.innerHTML = '?';
            if(confirm("Czy na pewno chcesz usunąć cały ten rekord z bazy danych?\nUWAGA: Tej operacji nie będzie można cofnąć!")) {
                document.getElementById(id).className = 'deletedRecord'; //TODO: Zaimplementować odpowiednie polecenie SQL
            }
            SwitchDeleteMode(id);
        } else { //Exit Delete Mode
            deleteMode = false;
            deleteLink.innerHTML = 'U';
        }
    }
}
