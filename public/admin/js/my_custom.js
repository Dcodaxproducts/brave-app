$(document).ready(function() {
	$("#title").keyup(function(){
		var Text = $(this).val();
		Text = Text.toLowerCase();
		Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
		$("#slug").val(Text); 
	});

	$('#first_name').keyup(function(){
		var slug = $(this).val();
		slug = slug.toLowerCase();
		slug = slug.replace(/[^a-zA-Z0-9]+/g,'-');
		$('#slug').val(slug);
	});

	if ($("#mymce").length > 0) {
		tinymce.init({
			selector: "textarea#mymce",
			theme: "modern",
			height: 300,
			plugins: ["image code",
			"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"save table contextmenu directionality emoticons template paste textcolor",
			],

			toolbar: 'undo redo | link image | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview media fullpage | forecolor backcolor emoticons',
			  // enable title field in the Image dialog
			  image_title: true, 
			  // enable automatic uploads of images represented by blob or data URIs
			  automatic_uploads: true,
			  // add custom filepicker only to Image dialog
			  file_picker_types: 'image',
			  file_picker_callback: function(cb, value, meta) {
			  	var input = document.createElement('input');
			  	input.setAttribute('type', 'file');
			  	input.setAttribute('accept', 'image/*');

			  	input.onchange = function() {
			  		var file = this.files[0];
			  		var reader = new FileReader();

			  		reader.onload = function () {
			  			var id = 'blobid' + (new Date()).getTime();
			  			var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
			  			var base64 = reader.result.split(',')[1];
			  			var blobInfo = blobCache.create(id, file, base64);
			  			blobCache.add(blobInfo);

			        // call the callback and populate the Title field with the file name
			        cb(blobInfo.blobUri(), { title: file.name });
			    };
			    reader.readAsDataURL(file);
			};

			input.click();
		}
	});
	}

	// Switchery
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	$('.js-switch').each(function() {
		new Switchery($(this)[0], $(this).data());
	});
	
	$('#myTable').DataTable();
	var table = $('#example').DataTable({
		"columnDefs": [{
			"visible": false,
			"targets": 2
		}],
		"order": [
		[2, 'asc']
		],
		"displayLength": 25,
		"drawCallback": function(settings) {
			var api = this.api();
			var rows = api.rows({
				page: 'current'
			}).nodes();
			var last = null;
			api.column(2, {
				page: 'current'
			}).data().each(function(group, i) {
				if (last !== group) {
					$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
					last = group;
				}
			});
		}
	});
	    // Order by the grouping
	    $('#example tbody').on('click', 'tr.group', function() {
	    	var currentOrder = table.order()[0];
	    	if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
	    		table.order([2, 'desc']).draw();
	    	} else {
	    		table.order([2, 'asc']).draw();
	    	}
	    });

	    // Files upload mefia gallery
	    $('.dropify').dropify();

	    // Translated
	    $('.dropify-fr').dropify({
	        messages: {
	            default: 'Glissez-déposez un fichier ici ou cliquez',
	            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
	            remove: 'Supprimer',
	            error: 'Désolé, le fichier trop volumineux'
	        }
	    });

	    // Used events
	    var drEvent = $('#input-file-events').dropify();

	    drEvent.on('dropify.beforeClear', function(event, element) {
	        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
	    });

	    drEvent.on('dropify.afterClear', function(event, element) {
	        alert('File deleted');
	    });

	    drEvent.on('dropify.errors', function(event, element) {
	        console.log('Has Errors');
	    });

	    var drDestroy = $('#input-file-to-destroy').dropify();
	    drDestroy = drDestroy.data('dropify')
	    $('#toggleDropify').on('click', function(e) {
	        e.preventDefault();
	        if (drDestroy.isDropified()) {
	            drDestroy.destroy();
	        } else {
	            drDestroy.init();
	        }
	    });

	    // For select 2
	    $(".select2").select2();
	    $('.selectpicker').selectpicker();

	    $('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });

	    $(document).on('click','.gallery',function(){
	    	// alert($(this).is(':checked'))
	    	if($(this).is(':checked')){
	    		// alert('checked')
	    		$(this).parents('.gallery-parent').siblings().find('input[type="checkbox"]').attr("checked",false);
	    	}
	    	// $(this).parents('.gallery-parent').siblings()
	    	// alert('xfgfg')
	    });

	    $(document).on('click','.add_media',function(){
	    	
	    });

	});
