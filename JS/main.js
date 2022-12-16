console.log("Hello World!");

const textMsg = document.getElementById("Test");
// コンソールにテキストを表示
console.log(textMsg.textContent);

window.document.onkeydown = function (event) {
	if (event.key === "Enter") {
		// alert("やった！！！");
		window.location.href = "post.php";
	}
};

// 要素への参照を取得
const like_count = document.getElementById("Like_count");
// コンソールにテキストを表示
console.log(like_count.textContent);
// const like_canvas = like_count.textContent;
// console.log(like_canvas);




// const canvas = document.getElementById("Post_canvas");
const canvas = document.getElementsByClassName("post_canvas");

canvas.width = 120;
canvas.height = 120;

// if (canvas.getContext) {
const context = canvas.getContext("2d");
//左から20上から40の位置に、幅50高さ100の四角形を描く
// context.fillRect(canvas.width / 2, canvas.height / 2, 20, 20);

// 円の中心座標: (100,100)
// 半径: 50
// 開始角度: 0度 (0 * Math.PI / 180)
// 終了角度: 360度 (360 * Math.PI / 180)
// 方向: true=反時計回りの円、false=時計回りの円
context.arc(
	canvas.width / 2,
	canvas.height / 2,
	like_count.textContent,
	(0 * Math.PI) / 180,
	(360 * Math.PI) / 180,
	false
);
// 塗りつぶしの色
context.fillStyle = "red";

// 塗りつぶしを実行
context.fill();

// 線の色
// context.strokeStyle = "purple";

// 線の太さ
// context.lineWidth = 8;

// 線を描画を実行
// context.stroke();

context.strokeStyle = "rgb(00,00,255)";
context.fillStyle = "rgb(255,00,00)";
// }
