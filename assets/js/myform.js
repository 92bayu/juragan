/*
function formatCurrency(num) {
	var p = num.toFixed(2).split(".");
	return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
		return  num + (i && !(i % 3) ? "," : "") + acc;
	}, "") + "." + p[1];
};
*/
$(document).ready(function(){
    $(document).on('keypress',".numeric",function (e) {
        if (e.which != 8 && e.which != 46 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    $(document).on('keypress',".fixed",function (e) {
        return false;
    });
    $(document).on('focus','.input-date',function(){
        $(this).datepick();
    });

    
    

});

