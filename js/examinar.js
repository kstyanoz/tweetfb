function doIt() {

	  pic = $('#file-input').val();
	  $('#pathpic').val(pic);
	  $('#foto').css("display","block");
	 
       var reader = new FileReader();

        reader.onload = (function(e) {

        var MAX_WIDHT = 641,
			MAX_HEIGHT = 481;
            var img = new Image();
            img.src = e.target.result;
           // alert( img.src);
            var width = img.width,
                height = img.height;
			//alert("Informacion imagen: "+width + "*" + height)
			
        if(width < MAX_WIDHT) {
		
            var c = document.getElementById("foto");
			
            var ctx = c.getContext("2d");
            ctx.drawImage(img,0,0,200,200);
             var dataURL = c.toDataURL();
			// alert(dataURL);
             /* var urlobj = document.getElementById("obj").src;
             document.getElementById("txtim").value =urlobj;*/

            ctx.clearRect(0, 0, c.width, c.height);
			var ctx = c.getContext("2d");
            ctx.drawImage(img,0,0,200,200);
             var dataURL = c.toDataURL();
			 
			 /*imageObj = document.getElementById("obj");
             imageObj.src = dataURL;*/
			 /*document.getElementById("per_b64Foto").value = dataURL ;*/
              
           }else{ alert("Tamaño maximo 640*480");  }
         }
       );
        reader.readAsDataURL(document.getElementById('file-input').files[0]);
     }