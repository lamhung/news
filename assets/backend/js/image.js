function insertImage(url) {
    CKEDITOR.instances['textarea_editor'].insertHtml("<img class='img-responsive' src='"+url+"' />");
}

function insertThumb(url)
{
    CKEDITOR.instances['textarea_editor'].insertHtml("<img class='img-responsive' src='"+url+"' />");
}

function deleteImage(url, thumb) {
    String.prototype.replaceAll = function(target, replacement) {
	  return this.split(target).join(replacement);
	};//Dịnh nghĩa repaceAll

	var content = CKEDITOR.instances['textarea_editor'].getData();
	//console.log(content);
	
	var new_content = content.replaceAll('<img class="img-responsive" src="'+url+'" />',"");
	//content.replace('<img src="'+url+'" />',"");
	
	new_content = new_content.replaceAll('<img class="img-responsive" src="'+thumb+'" />',"");

	//console.log(new_content);
	CKEDITOR.instances['textarea_editor'].setData(new_content);
	return true;
	//replace image = ""
	//CKEDITOR contn = conmtent
}