console.log("main_php.js");

window.document.onkeydown = function (event) {
	if (event.key === "Enter") {
		// alert("やった！！！");
		window.location.href = "post.php";
	}
};

function doReloadWithCache() {
	// キャッシュを利用してリロード
	window.location.reload(false);
}

window.addEventListener("load", function () {
	// ページ表示完了した5秒後にリロード
	// setTimeout(doReloadWithCache, 500);
});
