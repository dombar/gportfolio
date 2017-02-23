function acertaData(){
var queryDate = $("#dtInc").val();
if(queryDate != null && queryDate.length > 0){
    dateParts = queryDate.match(/(\d+)/g)
    realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
	$('#datePickerInicial').datepicker({ dateFormat: 'dd/mm/yyyy' }); 
$('#datePickerInicial').datepicker('setDate', realDate);
};

var queryDateFim = $("#dtFim").val();
if(queryDateFim != null && queryDateFim.length > 0){
    datePartsFim = queryDateFim.match(/(\d+)/g);
    realDateFim = new Date(datePartsFim[0], datePartsFim[1] - 1, datePartsFim[2]);
	$('#datePickerFim').datepicker({ dateFormat: 'dd/mm/yyyy' }); 
$('#datePickerFim').datepicker('setDate', realDateFim);
};

var queryDateFimT = $("#dtFimT").val();
if(queryDateFimT != null && queryDateFimT.length > 0){
    datePartsFimT = queryDateFimT.match(/(\d+)/g);
    realDateFimT = new Date(datePartsFimT[0], datePartsFimT[1] - 1, datePartsFimT[2]);
	$('#datePickerFimT').datepicker({ dateFormat: 'dd/mm/yyyy' }); 
$('#datePickerFimT').datepicker('setDate', realDateFimT);
};

}
