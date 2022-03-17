
    $(document).ready(function(){

	var $modal = $('#modal');

	var image = document.getElementById('sample_image');

	var cropper;

	$('#upload_image').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 4/4,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:250,
			height:250
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
              
				var base64data = reader.result;
				// var fileSelect = $(this).val();
				$.ajax({
					url:'{{route("logocropImg")}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
                        // let text = text.replace("public/upload/", "");
						$modal.modal('hide');
						$('#uploaded_image').attr('src', 'http://localhost/santara/'+data);
						// $('#upload_image').val(data);
						$('#logo').val(data);
						// $('#upload_image').attr('src', data);
						// console.log(base64data);
						// console.log(base64data);
                        // console.log(data);
					}
				});
			};
		});
	});








	var $modal2 = $('#modal2');

	var image2 = document.getElementById('sample_image2');

	$('#upload_image2').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image2.src = url;
			$modal2.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal2.on('shown.bs.modal', function() {
		cropper = new Cropper(image2, {
			aspectRatio: 2,
			viewMode: 3,
			preview:'.preview2'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop2').click(function(){
		canvas = cropper.getCroppedCanvas({
			width: 1366,
            height: 497
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
              
				var base64data = reader.result;
				// var fileSelect = $(this).val();
				$.ajax({
					url:'{{route("covercropImg")}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
                        // let text = text.replace("public/upload/", "");
						$modal2.modal('hide');
						$('#uploaded_image2').attr('src', 'http://localhost/santara/'+data);
						// $('#upload_image').val(data);
						$('#cover').val(data);
						// $('#upload_image').attr('src', data);
						// console.log(base64data);
						// console.log(base64data);
                        // console.log(data);
					}
				});
			};
		});
	});
	


	var $modal3 = $('#modal3');

	var image3 = document.getElementById('sample_image3');

	$('#upload_image3').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image3.src = url;
			$modal3.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal3.on('shown.bs.modal', function() {
		cropper = new Cropper(image3, {
			aspectRatio: 4/3,
			viewMode: 3,
			preview:'.preview3'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop3').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:300
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
              
				var base64data = reader.result;
				// var fileSelect = $(this).val();
				$.ajax({
					url:'{{route("galericropImg")}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
                        // let text = text.replace("public/upload/", "");
						$modal3.modal('hide');
						$('#uploaded_image3').attr('src', 'http://localhost/santara/'+data);
						// $('#upload_image').val(data);
						$('#galeri').val(data);
						// $('#upload_image').attr('src', data);
						// console.log(base64data);
						// console.log(base64data);
                        // console.log(data);
					}
				});
			};
		});
	});
	




	var $modal4 = $('#modal4');

	var image4 = document.getElementById('sample_image4');

	$('#upload_image4').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image4.src = url;
			$modal4.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal4.on('shown.bs.modal', function() {
		cropper = new Cropper(image4, {
			aspectRatio: 4/4,
			viewMode: 3,
			preview:'.preview4'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop4').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
              
				var base64data = reader.result;
				// var fileSelect = $(this).val();
				$.ajax({
					url:'{{route("ownercropImg")}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
                        // let text = text.replace("public/upload/", "");
						$modal4.modal('hide');
						$('#uploaded_image4').attr('src', 'http://localhost/santara/'+data);
						// $('#upload_image').val(data);
						$('#owner').val(data);
						// $('#upload_image').attr('src', data);
						// console.log(base64data);
						// console.log(base64data);
                        // console.log(data);
					}
				});
			};
		});
	});
	








	
	
});
