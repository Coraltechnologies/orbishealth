$(document).ready(function()
	{
$('#single_cal3').on("change", ageCount);

		function ageCount() {
			document.getElementById('ageId').value = "";
			var birthday = new Date(document.getElementById("single_cal3").value);
			var today = new Date(),
			age = (
				(today.getMonth() > birthday.getMonth())
				||
				(today.getMonth() == birthday.getMonth() && today.getDate() >= birthday.getDate())
				) ? today.getFullYear() - birthday.getFullYear() : today.getFullYear() - birthday.getFullYear() - 1;
			var months = today.getMonth() - birthday.getMonth();
			if (months < 0)
				months += 11;
			var days = today.getDate() - birthday.getDate();
			if (days < 0) {
				birthday.setMonth(birthday.getMonth() + 1, 0);
				days = birthday.getDate() - birthday.getDate() + today.getDate();
				--months;
			}

			document.getElementById('ageId').value = age + "yrs " + months + " month " + days + " days";

		}






	

		function clearGP()
		{
			var r = confirm("Are you sure want to clear all data?");
			if(r == true)
			{
				$('.input_fields_wrap2').find('input[type=text]').val('');
				$('.input_fields_wrap2').find('textarea').val('');
				pdCheck2();
			}

		}
		function clearFamily()
		{
			var r = confirm("Are you sure want to clear all data?");
			if(r == true)
			{
				$('.input_fields_wrap1').find('input[type=text]').val('');
				$('.input_fields_wrap1').find('textarea').val('');
				pdCheck1();
			}

		}
		
	});
	/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/

$(document).ready(function(){
	$('.filterable .btn-filter').click(function(){
		var $panel = $(this).parents('.filterable'),
		$filters = $panel.find('.filters input'),
		$tbody = $panel.find('.table tbody');
		if ($filters.prop('disabled') == true) {
			$filters.prop('disabled', false);
			$filters.first().focus();
		} else {
			$filters.val('').prop('disabled', true);
			$tbody.find('.no-result').remove();
			$tbody.find('tr').show();
		}
	});

	$('.filterable .filters input').keyup(function(e){
		/* Ignore tab key */
		var code = e.keyCode || e.which;
		if (code == '9') return;
		/* Useful DOM data and selectors */
		var $input = $(this),
		inputContent = $input.val().toLowerCase(),
		$panel = $input.parents('.filterable'),
		column = $panel.find('.filters th').index($input.parents('th')),
		$table = $panel.find('.table'),
		$rows = $table.find('tbody tr');
		/* Dirtiest filter function ever ;) */
		var $filteredRows = $rows.filter(function(){
			var value = $(this).find('td').eq(column).text().toLowerCase();
			return value.indexOf(inputContent) === -1;
		});
		/* Clean previous no-result if exist */
		$table.find('tbody .no-result').remove();
		/* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
		$rows.show();
		$filteredRows.hide();
		/* Prepend no-result row if all rows are filtered */
		if ($filteredRows.length === $rows.length) {
			$table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
		}
	});


/*
 var max_fields = 6; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap2"); //Fields wrapper
                var add_button = $(".add_field_button2"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function (e) { //on add input button click
                	e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="my"><div class="row"> <div class="col-md-11 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">GP Details / Contact Info</div> <div class="panel-body"> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Practice Name</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input id="pracNameGP" onblur="pdCheck2()" type="text" class="form-control" placeholder="Practice Name"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Doctor</label> <input type="text" class="form-control" placeholder="Doctor"> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="+123 4567 890"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="+123 4567 890"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email 1</label> <div class="form-group"> <input type="text" class="form-control" id="inputSuccess4" placeholder="Email 1"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email 2</label> <div class="form-group"> <input type="text" class="form-control" id="inputSuccess4" placeholder="Email 2"> </div> </div> </div> </div> </div> </div> <div class="col-sm-1 col-md-1"> <div class="form-group"> <label>Action</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field2 btn btn-success btn-sm"><span class="glyphicon glyphicon-minus"></span></button> </div> <div class="col-md-12 col-sm-12 col-xs-12"> <br> <button type="button" onclick="clearGP()" class="btn btn-success btn-sm"> <i class="fa fa-eraser"></i> </button> </div> </div> </div> <div class="col-md-11 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div> <div class="panel-body"> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="5" placeholder="Address 1"></textarea> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Post code</label> <div class="input-group"> <input type="text" class="form-control" placeholder="123456"> <span class="input-group-btn"> <button class="btn btn-secondary" type="button">Go!</button> </span> </div> </div> <div class="form-group"> <label>City / Town</label> <input type="text" class="form-control" placeholder="City / Town"> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>County / State</label> <input type="text" class="form-control" placeholder="County / State"> </div> <div class="form-group"> <label>Country</label> <input type="text" class="form-control" placeholder="Country"> </div> </div> </div> </div> </div> </div></div>'); //add input box                                                                                                           

                    }
                });

                $(wrapper).on("click", ".remove_field2", function (e) { //user click on remove text

                	var r = confirm("Are you sure want to delete?");
                	if (r == true)
                	{
                		e.preventDefault();
                		$(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                		x--;
                	}
                });


*/




            });
$(function () {
	$('.multiselect-ui').multiselect({
		includeSelectAllOption: true
	});
});



/*$(document).ready(function () {
 var max_fields = 6; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap1"); //Fields wrapper
                var add_button = $(".add_field_button1"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function (e) { //on add input button click
                	e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="panel panel-default"> <div class="panel-heading">Family</div> <div class="panel-body"> <div class="row"><div class="col-md-8 col-sm-6 col-xs-12 profile-details"><div class="row"><div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper "><div class="form-group"><label>Name</label><input type="text" class="form-control" id="namePF" placeholder="Name"></div></div><div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper "><div class="form-group"><label>DOB</label><div class="xdisplay_inputx form-group has-feedback"><input type="text" onblur="ageCount1()" class="form-control" id="single_cal4" placeholder="date" aria-describedby="inputSuccess2Status4"></div></div></div><div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"><div class="form-group"><label>Age</label><input type="text" id="ageId" class="form-control" placeholder="Age"></div></div><div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"><div class="form-group"><label>Relationship</label><select class="form-control"><option>Choose..</option><option>Father</option><option>Mother</option><option>Brother</option><option>Sister</option><option>Cousin</option><option>Grand Father</option><option>Grand Mother</option><option>Family</option></select></div></div><div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"><div class="form-group"><label>Contact No</label><input type="text" class="form-control" placeholder="Contact no"></div></div><div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"><div class="form-group"><label>Action</label><br/><button type="button" class="remove_field1 btn btn-success"><span class="glyphicon glyphicon-minus"></span></button>&nbsp;&nbsp;<button style="margin-right:4px;" onclick="clearFamily()" type="button" class="btn btn-success btn-sm"><i class="fa fa-eraser"></i></button></div></div></div></div><div class="col-md-4 col-sm-6 col-xs-12"><div class="form-group"><label>Address</label><textarea class="form-control" rows="8" placeholder="Address"></textarea></div></div></div> </div> </div>'); //add input box                                                                                                           

                    }
                });
                $(wrapper).on("click", ".remove_field1", function (e) { //user click on remove text

                	var r = confirm("Are you sure want to delete?");
                	if (r == true)
                	{
                		e.preventDefault();
                		$(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                		x--;
                	}
                })
            });
*/
/*$(document).ready(function () {
var max_fields = 3; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap4"); //Fields wrapper
                var add_button = $(".add_field_button4"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function (e) { //on add input button click
                	e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="my"><div class="row"> <div class="col-md-11 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Carer Details / Contact Info</div> <div class="panel-body"> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Company Name</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="Company Name" id="compNameC" onblur="pdCheck4()"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Name</label> <input type="text" class="form-control" placeholder="Name"> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="+123 4567 890"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="+123 4567 890"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email 1</label> <div class="form-group"> <input type="text" class="form-control" id="inputSuccess4" placeholder="Email 1"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email 2</label> <div class="form-group"> <input type="text" class="form-control" id="inputSuccess4" placeholder="Email 2"> </div> </div> </div> </div> </div> </div> <div class="col-sm-1 col-md-1"> <div class="form-group"> <label>Action</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field4 btn btn-success btn-sm"><span class="glyphicon glyphicon-minus"></span></button> </div> <div class="col-md-12 col-sm-12 col-xs-12"> <br> <button type="button" onclick="clearCR()" class="btn btn-success btn-sm"> <i class="fa fa-eraser"></i> </button> </div> </div> </div> <div class="col-md-11 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div> <div class="panel-body"> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="5" placeholder="Address"></textarea> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Post code</label> <div class="input-group"> <input type="text" class="form-control" placeholder="123456"> <span class="input-group-btn"> <button class="btn btn-secondary" type="button">Go!</button> </span> </div> </div> <div class="form-group"> <label>City / Town</label> <input type="text" class="form-control" placeholder="City / Town"> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>County / State</label> <input type="text" class="form-control" placeholder="County / State"> </div> <div class="form-group"> <label>Country</label> <input type="text" class="form-control" placeholder="Country"> </div> </div> </div> </div> </div> </div></div>'); //add input box                                                                                                           

                    }
                });

                $(wrapper).on("click", ".remove_field4", function (e) { //user click on remove text

                	var r = confirm("Are you sure want to delete?");
                	if (r == true)
                	{
                		e.preventDefault();
                		$(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                		x--;
                	}
                })
            });   


/*$(document).ready(function () {
  var max_fields = 3; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap3"); //Fields wrapper
                var add_button = $(".add_field_button3"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function (e) { //on add input button click
                	e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="my"><div class="row"> <div class="col-md-11 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Chemist Details / Contact Info</div> <div class="panel-body"> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Chemist Name</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="Chemist Name" id="chemNameCD" onblur="pdCheck3()"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label> <div class="input-group"> <span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="+123 4567 890"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <div class="input-group"><span class="input-group-addon"> <input type="checkbox"> </span> <input type="text" class="form-control" placeholder="+123 4567 890"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email 1</label> <div class="form-group"> <input type="text" class="form-control" id="inputSuccess4" placeholder="Email 1"> </div> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email 2</label> <div class="form-group"> <input type="text" class="form-control" id="inputSuccess4" placeholder="Email 2"> </div> </div> </div> </div> </div> </div> <div class="col-sm-1 col-md-1"> <div class="form-group"> <label>Action</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field3 btn btn-success btn-sm"><span class="glyphicon glyphicon-minus"></span></button> </div> <div class="col-md-12 col-sm-12 col-xs-12"> <br> <button type="button" onclick="clearCD()" class="btn btn-success btn-sm"> <i class="fa fa-eraser"></i> </button> </div> </div> </div> <div class="col-md-11 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div> <div class="panel-body"> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="foplusrm-group"> <label>Address</label> <textarea class="form-control" rows="5" placeholder="Address"></textarea> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Post code</label> <div class="input-group"> <input type="text" class="form-control" placeholder="123456"> <span class="input-group-btn"> <button class="btn btn-secondary" type="button">Go!</button> </span> </div> </div> <div class="form-group"> <label>City / Town</label> <input type="text" class="form-control" placeholder="City / Town"> </div> </div> <div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>County / State</label> <input type="text" class="form-control" placeholder="County / State"> </div> <div class="form-group"> <label>Country</label> <input type="text" class="form-control" placeholder="Country"> </div> </div> </div> </div> </div> </div> </div>'); //add input box                                                                                                           

                    }
                });

                $(wrapper).on("click", ".remove_field3", function (e) { //user click on remove text

                	var r = confirm("Are you sure want to delete?");
                	if (r == true)
                	{
                		e.preventDefault();
                		$(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                		x--;
                	}
                })

            });   
*/
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();   
});   


	function printDiv(printDiv) {
		var printContents = document.getElementById(printDiv).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;
	}

	function chkfiles() {

		var chk = document.getElementById("chkallfiles").checked;

		var item = document.getElementById("multiaction");

		if (chk == true)
		{
			var chkall = document.getElementsByClassName("files");

			item.style.display = "block";

			for (var i = 0; i <= chkall.length; i++)
			{
				chkall[i].checked = true;
			}
		} else if (chk == false) {

			item.style.display = "none";

			var chkall = document.getElementsByClassName("files");
			for (var i = 0; i <= chkall.length; i++)
			{
				chkall[i].checked = false;
			}
		}
	}


	jQuery(document).ready(function($) {

		//$("footer").find(".container").css({"width": "78%", "margin": "auto", "margin-right": "0"});

		$("#patient-result").hide();
		$("#patient-search-btn").on("click", function(){
			$("#patient-result").show();
		});
		$(".hide-panel").on("click", function(){
			$("#patient-result").hide();
		});

            // Start the Filter Section (All, Current and Repeat Setion)

            $(".pres-btn").click(function () {
            	var value = $(this).attr("data-filter");
            	if (value == "all") {
            		$(".filter").show("1000");
            	}
            	else {
            		$(".filter").not("." + value).hide("1000");
            		$(".filter").filter("." + value).show("1000");
            	}
            });

            // End of the FIlter Section //

            // New Prescriptions page Add & Remove Section //

            $("#add-more").click(function () {
            	var html = $(".copy-fields").html();
            	$(".after-add-more").after(html);
            });
            //here it will remove the current value of the remove button which has been pressed
            $("body").on("click", ".remove", function () {
            	$(this).parents(".control-group").remove();
            });

        });
	$( function() {
		$( "#single_cal3" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	} );


	 // start the Distance & Minutes hide show jquery //

	 $("#section-minutes").click(function () {
	 	$(".minutes-box").show();
	 	$('#section-distance').show();
	 	$('#section-minutes').hide();
	 	$('.distance-box').hide();
	 });
	 $("#section-distance").click(function () {
	 	$(".minutes-box").hide();
	 	$('#section-distance').hide();
	 	$('#section-minutes').show();
	 	$('.distance-box').show();
	 });

        // End the Distance & Minutes hide show jquery //

        // Start Distance Charts //

       Highcharts.chart('container', {
        	chart: {
        		type: 'areaspline'
        	},
        	credits: {
        		enabled: false
        	},
        	title: {
        		text: 'Month View',
        		style: {
        			color: '#EB9532',
        			fontWeight: 'bold'
        		}
        	},
        	xAxis: {
        		categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        	},
        	yAxis: {
        		min: 0, max: 3000,
        		title: {
        			text: 'Distance'
        		}
        	},
        	plotOptions: {
        		line: {
        			dataLabels: {
        				enabled: true
        			},
        			enableMouseTracking: false
        		}
        	},
        	series: [{
        		name: 'Distance',
        		data: [100, 2000, 2800,400, 900, 2500, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        	}]
        });

 
    	jQuery(document).ready(function($) {

    		$("#patient-result").hide();
    		$("#patient-search-btn").on("click", function(){
    			$("#patient-result").show();
    		});
    		$(".hide-panel").on("click", function(){
    			$("#patient-result").hide();
    		});


    	});

        // start the Distance & Minutes hide show jquery //

        $(document).ready(function () {
        	$("#smoke-date-btn").click(function () {
        		$("#dateViewcharts").show();
        		$("#dayViewcharts").hide();
        		$("#weekViewcharts").hide();
        		$("#monthViewcharts").hide();
        		$("#yearViewcharts").hide();
        	});
        	$("#smoke-day-btn").click(function () {
        		$("#dateViewcharts").hide();
        		$("#dayViewcharts").show();
        		$("#weekViewcharts").hide();
        		$("#monthViewcharts").hide();
        		$("#yearViewcharts").hide();
        	});
        	$("#smoke-week-btn").click(function () {
        		$("#dateViewcharts").hide();
        		$("#dayViewcharts").hide();
        		$("#weekViewcharts").show();
        		$("#monthViewcharts").hide();
        		$("#yearViewcharts").hide();
        	});
        	$("#smoke-month-btn").click(function () {
        		$("#dateViewcharts").hide();
        		$("#dayViewcharts").hide();
        		$("#weekViewcharts").hide();
        		$("#monthViewcharts").show();
        		$("#yearViewcharts").hide();
        	});
        	$("#smoke-year-btn").click(function () {
        		$("#dateViewcharts").hide();
        		$("#dayViewcharts").hide();
        		$("#weekViewcharts").hide();
        		$("#monthViewcharts").hide();
        		$("#yearViewcharts").show();
        	});

        });

        // End the Distance & Minutes hide show jquery //


        // Start Date View Smoking //

        Highcharts.chart('smokeDateview', {
        	chart: {
        		type: 'areaspline'
        	},
        	credits: {
        		enabled: false
        	},
        	title: {
        		text: 'Date View',
        		style: {
        			color: '#EB9532',
        			fontWeight: 'bold'
        		}
        	},
        	xAxis: {
        		type: 'category',
        		labels: {
        			rotation: -60,
        			style: {
        				fontSize: '13px'
        			}
        		}
        	},
        	yAxis: {
        		min: 0, max: 25,
        		rotation: -10,
        		title: {
        			text: 'Number of Cigarette'
        		}
        	},
        	legend: {
        		enabled: false
        	},
        	tooltip: {
        		pointFormat: 'Cigarette in : <b>{point.y:.1f} Day</b>'
        	},
        	series: [{
        		name: 'Population',
        		data: [
        		[1, 0],
        		[2, 10],
        		[3, 5],
        		[4, 8],
        		[5, 3],
        		[6, 6],
        		[7, 12],
        		[8, 1],
        		[9, 5],
        		[10, 8],
        		[11, 2],
        		[12, 16],
        		[13, 5],
        		[14, 9],
        		[15, 7],
        		[16, 6],
        		[17, 1],
        		[18, 8],
        		[19, 2],
        		[20, 5],
        		[21, 10],
        		[22, 4],
        		[23, 1],
        		[24, 9],
        		[25, 3],
        		[26, 9],
        		[27, 18],
        		[28, 12],
        		[29, 9],
        		[30, 3]
        		],
        	}]
        });

        // End of the Date View Smoking //

        // Start Day View Smoking //

        Highcharts.chart('smokeDayview', {
        	chart: {
        		type: 'areaspline'
        	},
        	credits: {
        		enabled: false
        	},
        	title: {
        		text: 'Day View',
        		style: {
        			color: '#EB9532',
        			fontWeight: 'bold'
        		}
        	},
        	xAxis: {
        		type: 'category',
        		labels: {
        			rotation: -60,
        			style: {
        				fontSize: '13px'
        			}
        		}
        	},
        	yAxis: {
        		min: 0, max: 25,
        		rotation: -10,
        		title: {
        			text: 'Number of Cigarette'
        		}
        	},
        	legend: {
        		enabled: false
        	},
        	tooltip: {
        		pointFormat: 'Cigarette in : <b>{point.y:.1f} Day</b>'
        	},
        	series: [{
        		name: 'Population',
        		data: [
        		[1, 0],
        		[2, 10],
        		[3, 5],
        		[4, 8],
        		[5, 3],
        		[6, 6],
        		[7, 12],
        		[8, 1],
        		[9, 5],
        		[10,8],
        		[11, 2],
        		[12, 16],
        		[13, 5],
        		[14, 9],
        		[15, 7],
        		[16, 6],
        		[17, 1],
        		[18, 8],
        		[19, 2],
        		[20, 5],
        		[21, 10],
        		[22, 4],
        		[23, 1],
        		[24, 9],
        		[25, 3],
        		[26, 9],
        		[27, 18],
        		[28, 12],
        		[29, 9],
        		[30, 3]
        		],
        	}]
        });
        // End of the Day View Smoking //


        // Start week View Smoking //

        Highcharts.chart('smokeWeekview', {
        	chart: {
        		type: 'areaspline'
        	},
        	credits: {
        		enabled: false
        	},
        	title: {
        		text: 'Week View',
        		style: {
        			color: '#EB9532',
        			fontWeight: 'bold'
        		}
        	},
        	xAxis: {
        		type: 'category',
        		labels: {
        			rotation: -60,
        			style: {
        				fontSize: '13px'
        			}
        		}
        	},
        	yAxis: {
        		min: 0, max: 30,
        		rotation: -10,
        		title: {
        			text: 'Number of Cigarette'
        		}
        	},
        	legend: {
        		enabled: false
        	},
        	tooltip: {
        		pointFormat: 'Cigarette in : <b>{point.y:.1f} Day</b>'
        	},
        	series: [{
        		name: 'Week',
        		data: [
        		['Monday' , 0],
        		['Tuesday' , 16],
        		['Wednesday' , 6],
        		['Thursday' , 13],
        		['Thursday' , 4],
        		['Friday' , 19],
        		['Saturday' , 7],
        		['Sunday', 20]

        		],
        	}]
        });

        // End of the Week View Smoking //

        // Start Month View Smoking //

        Highcharts.chart('smokeMonthview', {
        	chart: {
        		type: 'areaspline'
        	},
        	credits: {
        		enabled: false
        	},
        	title: {
        		text: 'Month View',
        		style: {
        			color: '#EB9532',
        			fontWeight: 'bold'
        		}
        	},
        	xAxis: {
        		type: 'category',
        		labels: {
        			rotation: -60,
        			style: {
        				fontSize: '13px'
        			}
        		}
        	},
        	yAxis: {
        		min: 0, max: 30,
        		rotation: -10,
        		title: {
        			text: 'Number of Cigarette'
        		}
        	},
        	legend: {
        		enabled: false
        	},
        	tooltip: {
        		pointFormat: 'Cigarette in : <b>{point.y:.1f} Day</b>'
        	},
        	series: [{
        		name: 'Month',
        		data: [
        		['January', 1],
        		['February', 6],
        		['March', 13],
        		['April', 4],
        		['May', 19],
        		['June', 7],
        		['July', 20],
        		['August', 16],
        		['September', 6],
        		['October', 13],
        		['November', 4],
        		['December', 19]

        		],
        	}]
        });

        // End of the Month View Smoking //

        // Start Year View Smoking //

        Highcharts.chart('smokeYearview', {
        	chart: {
        		type: 'areaspline'
        	},
        	credits: {
        		enabled: false
        	},
        	title: {
        		text: 'Year View',
        		style: {
        			color: '#EB9532',
        			fontWeight: 'bold'
        		}
        	},
        	xAxis: {
        		type: 'category',
        		labels: {
        			rotation: -60,
        			style: {
        				fontSize: '13px'
        			}
        		}
        	},
        	yAxis: {
        		min: 0, max: 30,
        		rotation: -10,
        		title: {
        			text: 'Number of Cigarette'
        		}
        	},
        	legend: {
        		enabled: false
        	},
        	tooltip: {
        		pointFormat: 'Cigarette in : <b>{point.y:.1f} Day</b>'
        	},
        	series: [{
        		name: 'Month',
        		data: [
        		['January', 1],
        		['February', 6],
        		['March', 13],
        		['April', 4],
        		['May', 19],
        		['June', 7],
        		['July', 20],
        		['August', 16],
        		['September', 6],
        		['October', 13],
        		['November', 4],
        		['December', 19]

        		],
        	}]
        });

        // End of the year View Smoking //
    
    // Start Distance Charts //

    Highcharts.chart('containerDiet', {
    	chart: {
    		type: 'areaspline'
    	},
    	credits: {
    		enabled: false
    	},
    	title: {
    		text: 'Month View',
    		style: {
    			color: '#EB9532',
    			fontWeight: 'bold'
    		}
    	},
    	xAxis: {
    		categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    	},
    	yAxis: {
    		min: 0, max: 2000,
    		title: {
    			text: 'Chicken'
    		}
    	},
    	plotOptions: {
    		line: {
    			dataLabels: {
    				enabled: true
    			},
    			enableMouseTracking: false
    		}
    	},
    	series: [{
    		name: 'Chicken',
    		data: [10, 50, 130, 100, 20, 500, 20, 90, 5, 10, 200, 100]
    	}]
    });
  