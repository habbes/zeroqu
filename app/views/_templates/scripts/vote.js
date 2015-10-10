$('.vote-form').on('submit', function(e){
	var id = this.candidate.value;
	if(!id){
		alert("Please select candidate.");
		return false;
	}

	var candidate = document.getElementById("candidate"+id);
	return confirm("Confirm vote: " + candidate.getAttribute("data-name") + " for " + this.getAttribute('data-positionTitle'));
});