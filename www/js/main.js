/**
 * Функция при загрузке страницы
 * 
 */
$(window).on('load', function () {

	//< Если модальное окно оповещения существует, то отображаем и 
	// сбрасываем сессионную переменную 
	if ($('#exampleModal3').length) {
		$('#exampleModal3').modal('show');
		$.ajax({
			type: 'GET',
			async: false,
			url: "/index/upd/",
			dataType: 'json',
			success: function (data) {
				//if(data['success']){
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
				//}
			}
		});
	}
	//>

	//< Инициализация всплывающей подсказки
	// Переопределение триггера на "наведение" для отключения заморозки при нажатии
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl, {
			trigger: 'hover'
		})
	});
	//>

	//< На странице контактов если кнопка добавления видима, тогда пустой контакт скрыт
	//if ($('#addEmail').length) {
	if ($('#addEmail').is(":visible")) {
		var arrChkBox = document.getElementsByName("emailAdd");
		$(arrChkBox).hide();
	}
	//}
	if ($('#addPhone').is(":visible")) {
		var arrChkBox = document.getElementsByName("phoneAdd");
		$(arrChkBox).hide();
	}
	if ($('#addAddress').is(":visible")) {
		var arrChkBox = document.getElementsByName("addressAdd");
		$(arrChkBox).hide();
	}
	if ($(window).width() < 992){
		//document.addEventListener('touchend', (event) => {
			//$('.tooltip').tooltip('hide');
			//$('.tooltip').removeClass('show');
			//console.log('Прикосновение закончено')
		//  })
	    $('#addressShow').removeClass('show');
	    $('#emailShow').removeClass('show');
	    $('#phoneShow').removeClass('show');
	}
	
	//> 
});

/**
 * При скрытии модального окна ввода имени и пароля очистка полей 
 */
$(function () {
	// Delegating to 'document' just in case.
	$(document).on("hidden.bs.modal", "#exampleModal", function () {
		$(this).find("#inputLogin").val(""); // Just clear the contents.
		$(this).find("#inputPass").val(""); // Just clear the contents.
		//$(this).find("#wishlist_").remove(); // Remove from DOM.
	});
});

/**
 * При скрытии модального окна регистрации очистка полей 
 */
$(function () {
	// Delegating to 'document' just in case.
	$(document).on("hidden.bs.modal", "#exampleModal2", function () {
		$(this).find("#inputLogin").val(""); // Just clear the contents.
		$(this).find("#inputPass").val(""); // Just clear the contents.
		$(this).find("#inputEmail").val(""); // Just clear the contents.
		$(this).find("#inputPhone").val(""); // Just clear the contents.
		//$(this).find("#inputLogin").remove(); // Remove from DOM.
	});
});

function strip_tags(str) {

	str = str.toString();

	return str.replace(/<\/?[^>]+>/gi, "");
}

/**
 * Загрузка количества товаров на странице 
 * 
 * @param {int} perPage количество товаров на странице
 */
function changeperpage(perPage) {
	var postData = {
		action: 'updateperpage',
		controller: 'products',
		perpage: perPage
	};
	$.ajax({
		type: 'GET',
		async: false,
		url: "/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			}
		}
	});
}

/**
 * Загрузка темы оформления страницы
 * 
 * @param {string} theme тема оформления страницы
 */
function changetheme(theme) {
	//alert(theme);
	if (theme) {
		var themenew = 'dark';
	} else {
		var themenew = 'light';
	}
	var postData = {
		theme: themenew
	};
	$.ajax({
		type: 'GET',
		async: false,
		url: "/index/updatetheme/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			}
		}
	});
}

/**
 * Загрузка формы отражения списка товаров
 * 
 * @param {boolean} theme форма отражения товаров (строки/таблица) 
 */
function changelayout(theme) {
	//alert(theme);
	if (theme) {
		var themenew = 'table';
	} else {
		var themenew = 'rows';
	}
	var postData = {
		layout: themenew
	};
	$.ajax({
		type: 'GET',
		async: false,
		url: "/index/updatelayout/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			}
		}
	});
}

/**
 * Добавить/Удалить в избранное
 * 
 * @param {int} productId Id продукта
 * @param {string} link       Ссылка на продукт
 * @param {int} add   Добавить/удалить 1/0 в избранное
 */
function addToBookmark(productId, link, add) {

	var objNameAdd = "#addwishlist_" + productId;
	var objNameRem = "#removewishlist_" + productId;
	var objWish = "#wishlist_" + productId;
	var userWishlist = "#userWishlist";

	//if (!$('#userWishlistFull').is(":visible")) {
	//	var wishlistCount = 0;
	//} else {
	var wishlistCount = Number(($(userWishlist).text())); 		
		//var wishlistCount = Number(($(userWishlist).text()).split('\n')[1]); 	
	//}
	
	if (add) {
		var postData = {
			productId: productId,
			link: link
		};

		//var postData = {
		//	user_wishlist: '{"0":{"' + productId + '":"' + link + '"}}',
		//	nomailing: 1
		//};
		$(objNameRem).hide();
		$('.tooltip').tooltip('hide');
		$(objNameAdd).show();
        if (wishlistCount == 0) {
			$("#userWishlistEmpty").hide();
			$("#userWishlistFull").show();
			$("#userWishlistEmptyf").hide();
			$("#userWishlistFullf").show();

			$(userWishlist).show();
		} 
		$(userWishlist).text(wishlistCount+1);
		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/addwishlist/",
			data: postData,
			dataType: 'json',
			success: function (data) {
				//if (data['success']) {
					//	alert("data['message']");
					//	document.location = '/';
					//} else {
					//	alert(data['message']);
				//}
			}
		});
	} else {
		var postDataDel = {
			productId: productId
		};
		
		$(objNameAdd).hide();
		$(".toltip").tooltip("hide");
		$(objNameRem).show();
		$(objWish).remove();
        if (wishlistCount <= 1) {
			$("#userWishlistFull").hide();
			$("#userWishlistEmpty").show();
			$("#userWishlistFullf").hide();
			$("#userWishlistEmptyf").show();

			$(userWishlist).hide();
		} 
		$(userWishlist).text(wishlistCount-1);

		//if (count == 1) {
		//$("#wishlistinput").remove(); 
		//$("#wishlistcup").remove();
		//}
		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/delwishlist/",
			data: postDataDel,
			dataType: 'json',
			success: function (data) {
				//if (data['success']) {
					//	alert("data['message']");
					//	document.location = '/';
					//} else {
					//	alert(data['message']);
				//}
			}
		});
	}
}

//< functions for contacts
/**
 * Сдвинуть контакт в таблице
 * 
 * @param {integer} number        порядковый номер контакта
 * @param {integer 0/1} direction направление сдвига 0 - вниз, 1 - вверх 
 * @param {string} type           тип контакта 
 */
function moveContact(number, direction, type) {
	var typeUp = type.charAt(0).toUpperCase() + type.slice(1);
	var objNameContent = "#" + type + "Contact" + number;
	var objNameComment = "#comment" + typeUp + number;
	var objNameKind = "#kind" + typeUp + number;
	var objMail = "#" + type + number;

	if (direction == 0) {
		var objNameContentNew = "#" + type + "Contact" + (number + 1);
		var objNameCommentNew = "#comment" + typeUp + (number + 1);
		var objNameKindNEW = "#kind" + typeUp + (number + 1);
		var objMailNew = "#" + type + (number + 1);
	} else {
		var objNameContentNew = "#" + type + "Contact" + (number - 1);
		var objNameCommentNew = "#comment" + typeUp + (number - 1);
		var objNameKindNEW = "#kind" + typeUp + (number - 1);
		var objMailNew = "#" + type + (number - 1);
	}

	if ($(objMailNew).is(":hidden")) {
		$(objMailNew).show();
		$(objMail).hide();
	}

	var emailContact = $(objNameContent).val();
	var commentEmail = $(objNameComment).val();
	var kindEmail = $(objNameKind).val();

	$(objNameContent).val($(objNameContentNew).val());
	$(objNameComment).val($(objNameCommentNew).val());
	$(objNameKind + ' option[value='+ $(objNameKindNEW).val()+']').prop('selected', true);

	$(objNameContentNew).val(emailContact);
	$(objNameCommentNew).val(commentEmail);
	$(objNameKindNEW + ' option[value='+ kindEmail+']').prop('selected', true);
}

/**
 * Скрывает контакт в таблице и очищает данные
 * 
 * @param {int} number        порядковый номер контакта
 * @param {string} type           тип контакта
 * @param {integer 0/1} val       если 1, тогда скрывается контакт для лобавления, 
 *                                показать кнопку для добавления    
 */
function removeContact(number, type, val = 0) {
	var typeUp = type.charAt(0).toUpperCase() + type.slice(1);
	var objNameContent = "#" + type + "Contact" + number;
	var objNameComment = "#comment" + typeUp + number;

	$(objNameContent).val('');
	$(objNameComment).val('');
	$("#" + type + number).hide();
	if (val == 1) {
		$("#add" + typeUp).show();
	}
}

/**
 * Показывает контакт для добавления и скрывает кнопку
 * 
 * @param {integer} number        порядковый номер контакта
 * @param {string} type           тип контакта
 */
function showContact(number, type) {
	var typeUp = type.charAt(0).toUpperCase() + type.slice(1);
	$("#" + type + number).show();
	$("#add" + typeUp).hide();
}

/**
 * Сохранить контакты
 * 
 * @param {integer} number        общее количество контактов
 * @param {string} type           тип контакта
 */
function saveContact(number, type) {
	var typeUp = type.charAt(0).toUpperCase() + type.slice(1);
	var emails = [];
	for (let i = 0; i <= number; i++) {
		var objNameContent = "#" + type + "Contact" + i;
		var objNameComment = "#comment" + typeUp + i;
		var objNameKind = "#kind" + typeUp + i;

		var сomment = $(objNameComment).val();
		var сont = $(objNameContent).val();
		var kind = $(objNameKind).val();
		
		сont = $.trim(сont);
		сomment = $.trim(сomment);
		kind = $.trim(kind);

		if (type == 'email') {
			var ch = сont.search("@");
		} else if (type == 'phone') {
			var сont = сont.replace(/[^0-9]/gi, ''); 
            if (сont == '') {
				var ch = 0;
			} else {
				var ch = 1;
			}
		} else {
			if (сont == '') {
				var ch = 0;
			} else {
				var ch = 1;
			}
		}
		if (ch > 0) {
			arr = {
				content: сont,
				comment: сomment,
				view_contact: kind
			};
			emails.push(arr);
		}
	}
	var jarr = JSON.stringify(emails);
	var postData = {};
	postData[type] = jarr;
	postData['register'] = 'Y';
	$.ajax({
		type: 'POST',
		async: false,
		url: "/restuser/updatecontact/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			}
		}
	});
}

function getJsonContact(number, type) {
	var typeUp = type.charAt(0).toUpperCase() + type.slice(1);
	var emails = [];
	for (let i = 0; i <= number; i++) {
		var objNameContent = "#" + type + "Contact" + i;
		var objNameComment = "#comment" + typeUp + i;
		var objNameKind = "#kind" + typeUp + i;

		var сomment = $(objNameComment).val();
		var сont = $(objNameContent).val();
		var kind = $(objNameKind).val();
		
		сont = $.trim(сont);
		сomment = $.trim(сomment);
		kind = $.trim(kind);

		if (type == 'email') {
			var ch = сont.search("@");
		} else if (type == 'phone') {
			var сont = сont.replace(/[^0-9]/gi, ''); 
            if (сont == '') {
				var ch = 0;
			} else {
				var ch = 1;
			}
		} else {
			if (сont == '') {
				var ch = 0;
			} else {
				var ch = 1;
			}
		}
		if (ch > 0) {
			arr = {
				content: сont,
				comment: сomment,
				view_contact: kind
			};
			emails.push(arr);
		}
	}
	var jarr = JSON.stringify(emails);

    return jarr;
}

function saveContacts(num1, num2, num3) {

	var postData = {};
	postData['register'] = 'Y';

	var jarr1 = getJsonContact(num1, 'email');
	postData['email'] = jarr1;
	var jarr2 = getJsonContact(num2, 'phone');
	postData['phone'] = jarr2;
	var jarr3 = getJsonContact(num3, 'address');
	postData['address'] = jarr3;

	$.ajax({
		type: 'POST',
		async: false,
		url: "/restuser/updatecontact/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			//if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			//}
		}
	});
	
}
//>

//< functions for support
function chooseSupport() {
	let support_id = $('#selectSupport').val();
	location.href='/user/support/?token=' + support_id;
}

function sendSupport(support_id, user_id, token) {

	let question = $('#questionSupport').val();
	let name = $('#nameSupport').val();
	let email = $('#emailSupport').val();

	let postData = {
		support_id: support_id,
		question: question,
		name: name,
		email: email,
		user_id: user_id,
		token: token
	};
	$.ajax({
		type: 'GET',
		async: false,
		url: "/restuser/addquestion/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			}
		}
	});
}

function sendSupportAdm(support_id, user_id, token, email) {

	let question = $('#questionSupportAdm').val();
	//let name = $('#nameSupport').val();
	//let email = $('#emailSupport').val();

	let postData = {
		support_id: support_id,
		question: question,
	    user_id: user_id,
		email: email,
		token: token
	};
	$.ajax({
		type: 'GET',
		async: false,
		url: "/restuser/addquestionadm/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			}
		}
	});
}

function deactiveSupport(support_id) {

	let postData = {
		support_id: support_id
	};

	$.ajax({
		type: 'GET',
		async: false,
		url: "/restuser/deactivequestion/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				//	alert("data['message']");
				//	document.location = '/';
				//} else {
				//	alert(data['message']);
			}
		}
	});
}

//>

/**
 * Добавить/Удалить в корзину
 *
 * @param {int} productId Id продукта
 * @param {int} add   Добавить/удалить 1/0 в избранное
 */
function addToCart(productId, add, image = "", name = "", price = 0.0,
				                                      link = '', date_available = '') {

	var objNameAdd = "#addcart_" + productId;
	var objNameRem = "#removecart_" + productId;
	var objWish = "#cart_" + productId;
	var userWishlist = "#userCart";

	var wishlistCount = Number(($(userWishlist).text()));

	if (add) {
		var postData = {
			product_id: productId,
			image: image,
			name: name,
			price: price,
			link: link,
			date_available: date_available
			};

		$(objNameRem).hide();
		$('.tooltip').tooltip('hide');
		$(objNameAdd).show();
		if (wishlistCount == 0) {
			$("#userCartEmpty").hide();
			$("#userCartFull").show();
			$("#userCartEmptyf").hide();
			$("#userCartFullf").show();

			$(userWishlist).show();
		}
		$(userWishlist).text(wishlistCount+1);
		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/addcart/",
			data: postData,
			dataType: 'json',
			success: function (data) {
	    	}
		});
	} else {
		var postDataDel = {
			product_id: productId
		};

		$(objNameAdd).hide();
		$(".toltip").tooltip("hide");
		$(objNameRem).show();
		$(objWish).remove();
		if (wishlistCount <= 1) {
			$("#userCartFull").hide();
			$("#userCartEmpty").show();
			$("#userCartFullf").hide();
			$("#userCartEmptyf").show();

			$(userWishlist).hide();
		}
		$(userWishlist).text(wishlistCount-1);

		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/delcart/",
			data: postDataDel,
			dataType: 'json',
			success: function (data) {
			}
		});
	}
}

function updCart(productId, quantity, increase, ar = '') {
	let arr = ar.split(' ,');
	let quantityNew = 0;
	let wishlistCount = Number(($("#userCart").text()));

	if (increase == 0) {
		if (quantity > 0) {
			quantityNew = quantity;
		} else {
			quantityNew = 0;
			$('#quantityId_' + productId).val(0);
			$('#trCart_' + productId).hide();
		}
	} else {
		if (increase == 1) {
			quantityNew = Number($('#quantityId_' + productId).val())+1;
			$('#quantityId_' + productId).val(quantityNew);
		} else {
			quantityNew = Number($('#quantityId_' + productId).val())-1;
			if (quantityNew > 0) {
				$('#quantityId_' + productId).val(quantityNew);
			} else {
				quantityNew = 0;
				$('#quantityId_' + productId).val(0);
				$('#trCart_' + productId).hide();
			}
		}
	}
	if (quantityNew > 0) {
		let postData = {
			product_id: productId,
			quantity: quantityNew
		};
		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/updcart/",
			data: postData,
			dataType: 'json',
			success: function (data) {
			}
		});
	} else {
		// удалить из корзины
		if (wishlistCount <= 1) {
			$("#userCartFull").hide();
			$("#userCartEmpty").show();
			$("#userCart").hide();
		}
		$("#userCart").text(wishlistCount-1);
		let objNameAdd = "#addcart_" + productId;
		let objNameRem = "#removecart_" + productId;
		$(objNameAdd).hide();
		$(objNameRem).show();

		let postDataDel = {
			product_id: productId
		};
		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/delcart/",
			data: postDataDel,
			dataType: 'json',
			success: function (data) {
			}
		});
	}
    // обновить сумму
	let sum = 0;
	$.each(arr, function(key, value){
		quan = Number($('#quantityId_' + value).val());
		pric = Number($('#priceId_' + value).text());
		sum = sum + quan * pric;
	});
	$('#sumCartId').text(number_format(sum, 2, '.', '') );
	let discount = Number($('#cartDiscountId').text());
	if (discount > 0) {
		$('#sumCartDiscountId').text(number_format((sum / 100 * (100 - discount)), 2, '.', ''));
	}
}

/***
 number - исходное число
 decimals - количество знаков после разделителя
 dec_point - символ разделителя
 thousands_sep - разделитель тысячных
 ***/
function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
			return '' + (Math.round(n * k) / k)
				.toFixed(prec);
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
			.join('0');
	}
	return s.join(dec);
}

function updCartOrd(productId, quantity, increase, price, ar = '') {
	let arr = ar.split(' ,');
	let quantityNew = 0;
	let wishlistCount = Number(($("#userCart").text()));

	if (increase == 0) {
		if (quantity > 0) {
			quantityNew = quantity;
		} else {
			quantityNew = 0;
			$('#quantityId_' + productId).val(0);
			$('#trCart_' + productId).hide();

			$('#quantityIdOrd_' + productId).val(0);
			$('#trCartOrd_' + productId).hide();
		}
	} else {
		if (increase == 1) {
			quantityNew = Number($('#quantityIdOrd_' + productId).val())+1;
			$('#quantityId_' + productId).val(quantityNew);

			$('#quantityIdOrd_' + productId).val(quantityNew);
		} else {
			quantityNew = Number($('#quantityIdOrd_' + productId).val())-1;
			if (quantityNew > 0) {
				$('#quantityId_' + productId).val(quantityNew);

				$('#quantityIdOrd_' + productId).val(quantityNew);
			} else {
				quantityNew = 0;
				$('#quantityId_' + productId).val(0);
				$('#trCart_' + productId).hide();

				$('#quantityIdOrd_' + productId).val(0);
				$('#trCartOrd_' + productId).hide();
			}
		}
	}
    let sumNew = Number(price)*quantityNew;
	$('#sumIdOrd_' + productId).text(number_format(sumNew, 2, '.', ''));

	if (quantityNew > 0) {
		let postData = {
			product_id: productId,
			quantity: quantityNew
		};
		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/updcart/",
			data: postData,
			dataType: 'json',
			success: function (data) {
			}
		});
	} else {
		// удалить из корзины
		if (wishlistCount <= 1) {
			$("#userCartFull").hide();
			$("#userCartEmpty").show();
			$("#userCart").hide();
		}
		$("#userCart").text(wishlistCount-1);
		let objNameAdd = "#addcart_" + productId;
		let objNameRem = "#removecart_" + productId;
		$(objNameAdd).hide();
		$(objNameRem).show();

		let postDataDel = {
			product_id: productId
		};
		$.ajax({
			type: 'POST',
			async: false,
			url: "/restuser/delcart/",
			data: postDataDel,
			dataType: 'json',
			success: function (data) {
			}
		});
	}
	// обновить сумму
	let sum = 0;
	let shippingDateNew = new Date();
	$.each(arr, function(key, value){
		quan = Number($('#quantityIdOrd_' + value).val());
		pric = Number($('#priceIdOrd_' + value).text());
		if (quan > 0) {
			let shippingDateStr = $('#dateIdOrd_' + value).text();
			let year = shippingDateStr.substring(6, 10);
			let manth = Number(shippingDateStr.substring(3, 5));
			let day = shippingDateStr.substring(0, 2);
			let shippingDate = new Date(year, manth - 1, day);
			if (shippingDate > shippingDateNew) shippingDateNew = shippingDate;
		}
		sum = sum + quan * pric;
	});
	$('#sumCartId').text(number_format(sum, 2, '.', '') );

	$('#sumCartIdOrd').text(number_format(sum, 2, '.', '') );
	let discount = Number($('#cartDiscountIdOrd').text());
	if (discount > 0) {
		$('#sumCartDiscountId').text(number_format((sum / 100 * (100 - discount)), 2, '.', ''));

		$('#sumCartDiscountIdOrd').text(number_format((sum / 100 * (100 - discount)), 2, '.', ''));
	}
	$('#dateCartIdOrd').text(shippingDateNew.toLocaleDateString());

}

function selectСontact(val, name)
{
	$('#' + name + 'OrdId').val(val);
}
















/**
 *Функции от shop.local 
 */

/**
 *  Функция добавления товара в корзину
 *  
 *  @param integer itemId ID продукта
 *  @return в случае успеха обновятся данные корзины на странице
 */
/*function addToCart(itemId) {
	console.log("js - addToCart()");
	$.ajax({
		type: 'POST',
		async: false,
		url: "/cart/addtocart/" + itemId + '/',
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				$('#cartCntItems').html(data['cntItems']);

				$('#addCart_' + itemId).hide();
				$('#removeCart_' + itemId).show();
			}
		}
	});
}
*/
/**
 * Удаление продукта из корзины
 * 
 * @param integer itemId ID продукта
 * @return в случае успеха обновятся данные корзины на странице
 */
function removeFromCart(itemId) {
	console.log("js - removeFromCart(" + itemId + ")");
	$.ajax({
		type: 'POST',
		async: false,
		url: "/cart/removefromcart/" + itemId + '/',
		dataType: 'json',
		success: function (data) {
			if (data['success']) {

				$('#cartCntItems').html(data['cntItems']);

				$('#addCart_' + itemId).show();
				$('#removeCart_' + itemId).hide();
			}
		}
	});
}

/**
 * Подсчет стоимости купленного товара
 * 
 * @param integer itemId ID продукта
 * 
 */
function conversionPrice(itemId) {
	var newCnt = $('#itemCnt_' + itemId).val();
	var itemPrice = $('#itemPrice_' + itemId).attr('value');
	var itemRealPrice = newCnt * itemPrice;

	$('#itemRealPrice_' + itemId).html(itemRealPrice);
}

/**
 * Получение данных с формы
 * 
 */
function getData(obj_form) {
	var hData = {};
	$('input, textarea, select', obj_form).each(function () {
		if (this.name && this.name != '') {
			hData[this.name] = this.value;
			console.log('hData[' + this.name + '] = ' + hData[this.name]);
		}
	});
	return hData;
};

/**
 * Регистрация нового пользователя
 * 
 */
function registerNewUser() {
	var postData = getData('#registerBox');

	$.ajax({
		type: 'POST',
		async: false,
		url: "/user/register/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				alert('Регистрация прошла успешно');

				//> блок в левом столбце
				$('#registerBox').hide();

				$('#userLink').attr('href', '/user/');
				$('#userLink').html(data['userName']);
				$('#userBox').show();
				//<

				//> страница заказа
				$('#loginBox').hide();
				$('#btnSaveOrder').show();
				//<
			} else {
				alert(data['message']);
			}
		}
	});
}

/**
 * Авторизация пользователя
 * 
 */
function login() {
	var email = $('#loginEmail').val();
	var pwd = $('#loginPwd').val();

	var postData = "email=" + email + "&pwd=" + pwd;

	$.ajax({
		type: 'POST',
		async: false,
		url: "/user/login/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				$('#registerBox').hide();
				$('#loginBox').hide();

				$('#userLink').attr('href', '/user/');
				$('#userLink').html(data['displayName']);
				$('#userBox').show();

				//> заполняем поля на странице заказа
				$('#name').val(data['name']);
				$('#phone').val(data['phone']);
				$('#adress').val(data['adress']);
				//<

				$('#btnSaveOrder').show();

			} else {
				alert(data['message']);
			}

		}
	});
}

/**
 * разлогиневание пользователя
 * 
 */
function logout() {
	console.log("js - logout()");
	$.ajax({
		type: 'POST',
		async: false,
		url: "/user/logout/",
		dataType: 'json',
		success: function (data) {
			window.location.href = '/';
		}
	});
	//window.location.href = '/';

}

/**
 * Показывать или прятать форму регистрации
 * 
 */
function showRegisterBox() {
	if ($("#registerBoxHidden").css('display') != 'block') {
		$("#registerBoxHidden").show();
	} else {
		$("#registerBoxHidden").hide();
	}
}

/**
 * Обновление данных пользователя
 * 
 */
function updateUserData() {
	console.log("js - updateUserData()");
	var phone = $('#newPhone').val();
	var adress = $('#newAdress').val();
	var pwd1 = $('#newPwd1').val();
	var pwd2 = $('#newPwd2').val();
	var curPwd = $('#curPwd').val();
	var name = $('#newName').val();

	var postData = {
		phone: phone,
		adress: adress,
		pwd1: pwd1,
		pwd2: pwd2,
		curPwd: curPwd,
		name: name
	};

	$.ajax({
		type: 'POST',
		async: false,
		url: "/user/update/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				$('#userLink').html(data['userName']);
				alert(data['message']);
			} else {
				alert(data['message']);
			}
		}

	});

}

/**
 * Сохранение заказа
 * 
 */
function saveOrder() {
	var postData = getData('form');
	$.ajax({
		type: 'POST',
		async: false,
		url: "/cart/saveorder/",
		data: postData,
		dataType: 'json',
		success: function (data) {
			if (data['success']) {
				alert(data['message']);
				document.location = '/';
			} else {
				alert(data['message']);
			}
		}
	});
}

/**
 * Показывать или прятать данные о заказе
 * 
 */
function showProducts(id) {
	var objName = "#purchasesForOrderId_" + id;
	if ($(objName).css('display') != 'table-row') {
		$(objName).show();
	} else {
		$(objName).hide();
	}
}