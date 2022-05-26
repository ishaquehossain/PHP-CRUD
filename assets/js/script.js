
//alert('Hello');
document.addEventListener('DOMContentLoaded', function(){
	console.log('loaded');
	
	var deleteLink = document.querySelectorAll('.delete');

	for (var i = 0; i < deleteLink.length; i++) {
    deleteLink[i].addEventListener('click', function(event) {
        if (!confirm("Do you want to delete " + this.title)) {
            event.preventDefault();
        }
    });
}
});




