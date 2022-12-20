console.log("main_php.js");

function doReloadWithCache() {
	// キャッシュを利用してリロード
	window.location.reload(false);
}

window.addEventListener("load", function () {
	// ページ表示完了した5秒後にリロード
	// setTimeout(doReloadWithCache, 500);
});
