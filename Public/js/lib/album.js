/**
 * Form - common
 *
 * @author zhangcheng zhang5474jj@163.com
 * @version $Id$
 * @package
 * @license http://opensource.org/licenses/MIT     The MIT License (MIT)
 * @copyright Copyright (c) 2014, ZhangCheng 2014-10-22
 **/
VIP.namespace('Album');
VIP.Album = {
	m_data : [],
	m_key : [],
	/**
 	 *	@callback(data)
	 *	@param type  1) > 0 next  2) <0 prev
	 *	@id id
	 *  
	 **/
	findData : function(type,id,callback) {
		var id = id
		if(type > 0){ id = id + 1}else{ id = id - 1}
		if (isUndefined(this.m_data[id]))
		{
			$.ajax({
			    type:"POST",
	            url:VIP.Base()+"/album/detail",
	            data:"id="+id,
	            async:true,
	            dataType:"json",
	            success:function(obj){
	            	this.m_data[id] = obj.data
	            }
			});
		}
		
		callback(this.m_data[id])
		
	},
	selectData : function(page,userid){

	},
	_callback : function(){
		VIPLog("_callback")
	},
	_clean : function(){
		VIPLog("_clean")
	}
};