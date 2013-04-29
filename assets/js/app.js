
// setup the interface
$(document).ready(function() {

    $('.ttip').tooltip();

	$("#peek-link, #format-switch").live("click", function() {
		showPeekData($(this));
		return false;
	});


	$("#object-window").live("click", function() {

        loading();

		var rets_resource = $(this).attr("data-resource");

		$.get(this_page, { action: 'objects', r_resource: rets_resource }, function(data) {
			$.modal.close();

			setTimeout(function () {
				$.modal("<div id='ajax-content'>" + data + "</div>", { overlayClose: true, minWidth:550 });
			}, 100);

		});
		return false;
	});


	jQuery("#resource-class-selector").live("change", function() {
		var selected_pair = "";

		jQuery("#resource-class-selector option:selected").each(function() {
			selected_pair = jQuery(this).val();
		});

		var selected_parts = selected_pair.split("|");
		var rets_resource = selected_parts[0];
		var rets_class = selected_parts[1];

		showResourceDetails(rets_resource, rets_class);
		return false;
	});


	$(".resource_class_link").live("click", function() {
		var rets_resource = $(this).data("resourceid");
		var rets_class = $(this).data("class");
		var keyfield = $(this).data("keyfield");
		showResourceDetails(rets_resource, rets_class,keyfield);
		return false;
	});

    $(".lookup_popup").live("click", function(e) {
        e.preventDefault();

        loading();
        var resource = $(this).data("resource");
        var lookup_name = $(this).data("lookup_name");
        $('.modal-header h3').text(resource+' : '+lookup_name+' Lookup Values');
        $('#myModal').modal('show');

        $.post(base_url+"users/lookup", {  resource: resource, lookup_name: lookup_name }, function(data) {
            setTimeout(function () {
                $("#myModal .modal-body").html(data);
            }, 100);
        });
        return false;
	});

    $("#object-popup").live("click", function(e) {
        e.preventDefault();

        loading();
        var resource = $(this).data("resource");

        $('.modal-header h3').text(resource+' Object Values');
        $('#myModal').modal('show');

        $.post(base_url+"users/object", {  resource: resource }, function(data) {
            setTimeout(function () {
                $("#myModal .modal-body").html(data);
            }, 100);
        });
        return false;
	});

	$("#extra-link").live("click", function() {
		$(".extra").each(function() {
			$(this).show('slow');
		});
		$(".extra-link-row").each(function() {
			$(this).hide();
		});

		return false;

	});


});



function showResourceDetails(rets_resource, rets_class, keyfield) {
	$("#resource_content").html("<p align='center'><b>Waiting for RETS Server Response...</b></p><p align='center'><img src='"+ base_url +"assets/img/loading.gif' /></p>");
	$(document).scrollTo( '#content_details', 800 );
	$.post(base_url+"users/details", { resource: rets_resource, class: rets_class,keyfield:keyfield }, function(data) {
		$("#resource_content").html(data);
		$(document).scrollTo( '#content_details', 800, {margin:true}  );
	});
}

function loading() {
    setTimeout(function () {
        $("#myModal .modal-body").html("<p align='center'><b>Waiting for RETS Server Response...</b></p><p align='center'><img src='"+ base_url +"assets/img/loading.gif' /></p>");
	}, 100);
}
