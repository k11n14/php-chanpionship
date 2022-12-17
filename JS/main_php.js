console.log("main_php.js");

window.document.onkeydown = function (event) {
	if (event.key === "Enter") {
		// alert("やった！！！");
		window.location.href = "post.php";
	}
};
