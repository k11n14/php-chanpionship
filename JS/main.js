console.log("Hello World!");
// alert("Hello World!");

window.document.onkeydown = function (event) {
	if (event.key === "Enter") {
		// alert("やった！！！");
		window.location.href = "post.php";
	}
};

const canvas = document.getElementById("post_canvas");

canvas.width = 120;
canvas.height = 120;

if (canvas.getContext) {
	const context = canvas.getContext("2d");
	//左から20上から40の位置に、幅50高さ100の四角形を描く
	context.fillRect(canvas.width / 2, canvas.height / 2, 20, 20);

	context.strokeStyle = "rgb(00,00,255)";
	context.fillStyle = "rgb(255,00,00)";
}
