
$( document ).ready(function($) {
	$("#ckeckButton" ).click(ckeckAll);
	$("#deleteButton" ).click(isDelete);
	$("#unblock" ).click(isBlock);
	$("#block" ).click(isBlock);

	function ckeckAll(){

	    var value = $('#ckeckButton').val();
	    if(value == "Выбрать все") {
	        $('form input:checkbox').prop('checked', true);
	        $('#ckeckButton').val("Сбросить все");
	    } else {
	        $('form input:checkbox').prop('checked', false); 
	        $('#ckeckButton').val("Выбрать все");
	    }
	    return false;
	}	

	function isDelete(){
		if(isCheckNull()){
			alert("Ничего не выбрано!");
			return false;
		} else {
			var answer = confirm ("Действительно удалить?");
			if(answer){
				return true;
			} else {
				return false;
			}
		}
	}

	function isBlock(){
		if(isCheckNull()){
			alert("Ничего не выбрано!");
			return false;
		}
	}

	function isCheckNull(){
		return $('input:checkbox:checked').length == 0;
	}

});

