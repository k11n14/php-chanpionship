console.log("Hello World!");
// alert("Hello World!");

window.document.onkeydown = function(event) {
	if (event.key === "Enter") {
		// alert("やった！！！");
		window.location.href = "post.php";
	}
}