VIP.namespace("Image")
VIP.Image = {
	
	load = function( filename,func,path){
		var img = new Image()
		path = path or "/Public/img/"
		img.src = path + filename
		img.on
		return img
	},
	callback = function(func,filename){
		if(isFunction(func))
		{
			func(filename)
		}
	}
	
	
	
}