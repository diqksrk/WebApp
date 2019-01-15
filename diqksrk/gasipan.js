"use strict";

document.observe("dom:loaded", function() {
	$("enter").observe("click", commentClick);
	var id=$("title").getAttribute("value");
	new Ajax.Request("gadetail.php", {
		method: "get",
		parameters: {"boardid": id},
		onSuccess: displayList,
		onFailure: ajaxFailure,
		onException: ajaxFailure
	});
});

function commentClick() {
	var boardid=$("title").getAttribute("value");
	var comment=$('review').value;
	new Ajax.Request("gadetail.php", {
		method: "get",
		parameters: {"userid": "Tester", "boardid": boardid, "comment":comment},
		onSuccess: displayList,
		onFailure: ajaxFailure,
		onException: ajaxFailure
	});
}

function removeExistingListItem(){
	while ($("commentlist").firstChild){
		$("commentlist").removeChild($("commentlist").firstChild);
	}
}

function displayList(ajax) {
	var i=0;
	removeExistingListItem();
  	var data=JSON.parse(ajax.responseText);
 	for (var i=0; i<data.reviews.length; i++){
 		var div=document.createElement("div");
 		var pname=document.createElement("p");
 		var preview=document.createElement("p");
 		var rbutton=document.createElement("button");
 		div.setAttribute("class", "comment");
 		pname.setAttribute("class", "name_comment");
 		preview.setAttribute("class", "review_comment");
 		rbutton.setAttribute("id", data.reviews[i].id);
 		rbutton.setAttribute("class", "rbutton");
 		rbutton.setAttribute("value", data.reviews[i].id);
 		rbutton.setAttribute("name", data.reviews[i].userid);
 		rbutton.innerHTML="삭제";
 		pname.appendChild(document.createTextNode(data.reviews[i].userid));
 		preview.appendChild(document.createTextNode(data.reviews[i].review));
 		div.appendChild(pname);
 		div.appendChild(preview);
 		div.appendChild(rbutton);
 		$("commentlist").appendChild(div);
 		$(data.reviews[i].id).observe("click", delreview);
 	}

}

function delreview(){
	var id=this.getAttribute("value");
	var boardid=$("title").getAttribute("value");
	var userid=this.getAttribute("name");
	new Ajax.Request("gadetail.php", {
		method: "get",
		parameters: {"userid": userid, "boardid": boardid, "id":id,"delete": "on", "curuserid":"Tester"},
		onSuccess: displayList,
		onFailure: ajaxFailure,
		onException: ajaxFailure
	});
}

function ajaxFailure(ajax, exception) {
	if (exception) {
		$("errors").innerHTML = "Exception during Ajax request: <br />\n <br />\n" + exception;
		throw exception;
	} else {
		$("errors").innerHTML = "Error making Ajax request: <br />\n <br />\n" +
			"Server status: <br />\n" + ajax.status + 
			(ajax.statusText ? (" (" + ajax.statusText + ")<br />\n <br />\n") : "") + 
			(ajax.responseText ? ("Server response text: <br />\n" + ajax.responseText) : "");
	}
}