//Sidebar-nav

jQuery(document).ready(function() {
	$(".openbtn").click(function(){
    document.getElementById("mySidenav").style.width = "250px";
	});

	$(".closebtn").click(function(){
		document.getElementById("mySidenav").style.width = "0px";
	});
});
