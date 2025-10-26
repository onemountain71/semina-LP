// 画像の置換
document.addEventListener("DOMContentLoaded", function () {
	var setElem = document.querySelectorAll('.switch');
	var pcName = 'pc_';
	var spName = 'sp_';
	var replaceWidth = 767;

	function imgSize() {
		var windowWidth = window.innerWidth;

		setElem.forEach(function (img) {
			if (windowWidth >= replaceWidth) {
				img.src = img.src.replace(spName, pcName);
				img.style.visibility = 'visible';
			} else {
				img.src = img.src.replace(pcName, spName);
				img.style.visibility = 'visible';
			}
		});
	}

	window.addEventListener('resize', imgSize);
	imgSize(); // 初回実行
});



// SPメニュー開閉
document.addEventListener("DOMContentLoaded", function () {
	var toggleButton = document.querySelector('.sp-menu-toggle a');
	var menuModal = document.querySelector('.sp-menu-modal');
	var toOpen = document.querySelector('.to-open');
	var toClose = document.querySelector('.to-close');

	// 初期状態ではメニューを非表示
	menuModal.style.display = 'none';

	toggleButton.addEventListener('click', function (e) {
		e.preventDefault(); // デフォルトのリンク動作をキャンセル

		// メニューの表示・非表示を切り替え
		if (menuModal.style.display === 'none' || menuModal.style.display === '') {
			menuModal.style.display = 'block';
			toOpen.style.display = 'none';
			toClose.style.display = 'flex'; // Flexでアイコンとテキストを横並びに
			toggleButton.classList.add('isOpen'); // .isOpenクラスを追加
		} else {
			menuModal.style.display = 'none';
			toOpen.style.display = 'flex';
			toClose.style.display = 'none';
			toggleButton.classList.remove('isOpen'); // .isOpenクラスを削除
		}
	});
});




// ページトップボタンの表示・非表示機能
document.addEventListener("DOMContentLoaded", function () {
	var pagetop = document.querySelector('.pagetop');

	window.addEventListener('scroll', function () {
		if (window.scrollY > 100) {
			pagetop.style.display = 'block'; // ボタンを表示
		} else {
			pagetop.style.display = 'none'; // ボタンを非表示
		}
	});

	pagetop.addEventListener('click', function () {
		window.scrollTo({
			top: 0,
			behavior: 'smooth' // スムーズにスクロール
		});
	});
});

