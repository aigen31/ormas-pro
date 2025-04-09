jQuery(document).ready(function ($) {
	if ($(".post__list")[0]) {
		$(".post__list").not(".slick-initialized").slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			prevArrow: document.querySelector(".post .slick-prev"),
			nextArrow: document.querySelector(".post .slick-next"),
			responsive: [
				{
					breakpoint: 768,
					settings: { slidesToShow: 2, slidesToScroll: 1 }
				},
				{
					breakpoint: 450,
					settings: { slidesToShow: 1, slidesToScroll: 1 }
				}
			]
		});
	}

	if ($(".news-slider")[0]) {
		$(".news-slider").slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			dots: false,
			prevArrow: document.querySelector(".news-text .slick-prev"),
			nextArrow: document.querySelector(".news-text .slick-next")
		});
	}

	if ($(".party__list")[0]) {
		$(".party__list").not(".slick-initialized").slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			centerMode: true,
			arrows: true,
			dots: true,
			prevArrow: document.querySelector(".party .slick-prev"),
			nextArrow: document.querySelector(".party .slick-next")
		});
	}

	if ($(".party__list-item-text-more")[0]) {
		$(".party__list-item-text-more").on("click", function () {
			$(".party__poopup:nth-child(" + $(this).data("number") + ")").removeClass("hidden");
			$(document).mouseup(function (e) {
				var div = $(".party__poopup");
				if (!div.is(e.target) && div.has(e.target).length === 0) {
					div.addClass("hidden");
				}
			});
		});
	}

	if ($(".neuropsychology-slider__list")[0]) {
		$(".neuropsychology-slider__list").not(".slick-initialized").slick({
			infinite: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			centerMode: false,
			arrows: true,
			dots: true,
			prevArrow: document.querySelector(".neuropsychology-slider .slick-prev"),
			nextArrow: document.querySelector(".neuropsychology-slider .slick-next"),
			responsive: [
				{
					breakpoint: 680,
					settings: { slidesToShow: 1, slidesToScroll: 1 }
				}
			]
		});
	}

	if ($(".reviews__list")[0]) {
		$(".reviews__list").slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: true,
			dots: true,
			prevArrow: document.querySelector(".reviews .slick-prev"),
			nextArrow: document.querySelector(".reviews .slick-next"),
			responsive: [
				{
					breakpoint: 768,
					settings: { slidesToShow: 2, slidesToScroll: 1 }
				},
				{
					breakpoint: 450,
					settings: { slidesToShow: 1, slidesToScroll: 1 }
				}
			]
		});
	}

	if ($(".image-popup-vertical-fit")[0]) {
		$(".image-popup-vertical-fit").magnificPopup({
			type: "image",
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: "mfp-no-margins mfp-with-zoom",
			image: { verticalFit: true },
			zoom: {
				enabled: true,
				duration: 300
			}
		});
	}

	function eyeIconClick() {
		$(".icon__eye").click(function () {
			$(this).hide();
			$(this).prev().prev().hide();
		});
	}
	eyeIconClick();

	$(".reviews__list").on("breakpoint", function () {
		eyeIconClick();
	});



	$(".services__list-item-right-button").on("click", function () {
		$(".how-work__poopup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$("body").css({ overflow: "hidden" });
		$(".how-work__poopup").find(".poopup__inputs").show();
		$(".how-work__poopup").find(".poopup__title").html("Записаться");
		$(".how-work__poopup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(".services-type").val($(this).data("type"));
		$(".services-type-email_title").val($(this).data("email"));
		$(document).click(function (e) {
			var div = $(".how-work__poopup");
			var divsvg = $(".how-work__poopup-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	$(".services__inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;

		$(".services__inputs .poopup__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(".services__inputs .poopup__inputs-checkbox input").prop("checked") === false) {
			$(".services__inputs .poopup__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".services__inputs .poopup__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".services__inputs .poopup__inputs-input").each(function () {
				$(this).val("");
			});
			$(".services__inputs .poopup__inputs-checkbox input").prop("checked", false);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
			$(".how-work__poopup").find(".poopup__inputs").hide();
			$(".how-work__poopup").find(".poopup__title").html("Спасибо за обращение!");
			$(".how-work__poopup").find(".poopup__description").html("Наш администратор вскоре с Вами свяжется!");
		}
	});

	$(".how-work__poopup-svg").click(function () {
		$(".how-work__poopup").addClass("hidden");
		$(".consultation-overlay").addClass("hidden");
		$("body").css({ overflow: "auto" });
	});
	$(".consultation-overlay").click(function () {
		$(".how-work__poopup").addClass("hidden");
		$(".consultation-overlay").addClass("hidden");
		$("body").css({ overflow: "auto" });
	});

	// Второй блок, судя по коду, тоже использует ту же jQuery

	$(".icon__close ").on("click", function () {
		$(this).parent().addClass("hidden");
	});
	$(".signup__poopup-svg").click(function () {
		$(".signup__poopup").addClass("hidden");
	});

	document.querySelectorAll(".phone-mask").forEach(function (element) {
		IMask(element, {
			mask: "+{7}(000)000-00-00"
		});
	});

	$(".signup__inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;

		$(".signup__inputs .signup__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if (!$("#signupCheckbox").prop("checked")) {
			$(".signup__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".signup__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".signup__inputs .signup__inputs-input").each(function () {
				$(this).val("");
			});
			$(".signup__inputs-checkbox input").prop("checked", false);
			// Здесь отправка на request.php
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
			$(".signup__poopup").removeClass("hidden");
		}

		$(document).click(function (e) {
			var div = $(".signup__poopup");
			var divsvg = $(".signup__poopup-svg");
			if ((!div.is(e.target) && div.has(e.target).length === 0) || divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	// Форма useful-main-form

	$(".useful-main-form").submit(function (event) {
		event.preventDefault();
		var formData = $(this).serialize();
		if ($(this).find("input").val().length === 0) {
			$(this).find("input").addClass("error");
		} else {
			$(this).find("input").removeClass("error");
			$(this).find("input").val("");
			$(".useful__right-button--more").text("Мы отправим Вам материалы в ближайшее время!");
			$(".useful__right-button--more").prop("disabled", true);
			setTimeout(function () {
				$(".useful__right-button--more").text("Скачать");
				$(".useful__right-button--more").prop("disabled", false);
			}, 5000);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
		}
	});

	// Certificates
	if ($(".certificates")[0]) {
		if ($(".certificates__list")[0]) {
			$(".certificates__list").slick({
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				arrows: true,
				dots: true,
				prevArrow: document.querySelector(".certificates .slick-prev"),
				nextArrow: document.querySelector(".certificates .slick-next"),
				responsive: [
					{
						breakpoint: 768,
						settings: { slidesToShow: 2, slidesToScroll: 1 }
					},
					{
						breakpoint: 450,
						settings: { slidesToShow: 1, slidesToScroll: 1 }
					}
				]
			});
		}
	}

	if ($(".image-popup-vertical-fit")[0]) {
		$(".image-popup-vertical-fit").magnificPopup({
			type: "image",
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: "mfp-no-margins mfp-with-zoom",
			image: { verticalFit: true },
			zoom: {
				enabled: true,
				duration: 300
			}
		});
	}

	function eyeIconClickSecond() {
		if ($(".icon__eye-second")[0]) {
			$(".icon__eye-second").click(function () {
				$(this).hide();
				$(this).prev().prev().hide();
			});
		}
	}
	eyeIconClickSecond();

	if ($(".certificates__list")[0]) {
		$(".certificates__list").on("breakpoint", function () {
			eyeIconClickSecond();
		});
	}

	// Popup консультации

	$(".poopup-consultation__close").click(function () {
		$(".poopup-consultation__poopup").addClass("consultation-hide");
		$(".consultation__inputs").removeClass("consultation-hide");
		$(".consultation__text").removeClass("consultation-hide");
		$(".greeting").removeClass("active");
		$(".container").removeClass("active");
		$(".consultation").removeClass("active");
	});

	// Повторно подключение масок (возможно тот же скрипт)
	if (document.getElementById("phone-mask1")) {
		IMask(document.getElementById("phone-mask1"), { mask: "+{7}(000)000-00-00" });
	}
	if (document.querySelector(".phone-mask-service")) {
		IMask(document.querySelector(".phone-mask-service"), { mask: "+{7}(000)000-00-00" });
	}
	if (document.getElementById("phone-mask2")) {
		IMask(document.getElementById("phone-mask2"), { mask: "+{7}(000)000-00-00" });
	}
	if (document.getElementById("phone-mask3")) {
		IMask(document.getElementById("phone-mask3"), { mask: "+{7}(000)000-00-00" });
	}

	$(".consultation__inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;

		$(".consultation__inputs .consultation__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(".signup__inputs-checkbox input").prop("checked") === false) {
			$(".signup__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".signup__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".consultation__inputs .consultation__inputs-input").each(function () {
				$(this).val("");
			});
			$(".signup__inputs-checkbox input").prop("checked", false);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
			$(".poopup-consultation__poopup").removeClass("consultation-hide");
			$(".consultation__inputs").addClass("consultation-hide");
			$(".consultation__text").addClass("consultation-hide");
			$(".greeting").addClass("active");
			$(".container").addClass("active");
			$(".consultation").addClass("active");
		}
	});

	// Форма в footer

	$(".footer .footer__popup-svg").click(function () {
		$(".footer .footer__popup").addClass("hidden");
	});
	$(".footer__top-line-column-inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;

		if ($(".footer .footer__top-line-column-inputs-textarea").val().length === 0) {
			$(".footer .footer__top-line-column-inputs-textarea").addClass("error");
		} else {
			$(".footer .footer__top-line-column-inputs-textarea").removeClass("error");
		}

		$(".footer .footer__top-line-column-inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(".footer .footer__top-line-column-inputs-checkbox input").prop("checked") === false) {
			$(".footer .footer__top-line-column-inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".footer .footer__top-line-column-inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".footer .footer__top-line-column-inputs-input").each(function () {
				$(this).val("");
			});
			$(".footer .footer__top-line-column-inputs-textarea").val("");
			$(".footer .footer__top-line-column-inputs-checkbox input").prop("checked", false);
			$(".footer .footer__popup").removeClass("hidden");
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
		}

		$(document).click(function (e) {
			var div = $(".footer .footer__popup");
			var divsvg = $(".footer .footer__popup-svg");
			if ((!div.is(e.target) && div.has(e.target).length === 0) || divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	// Логика бургер-меню
	$(".header__burger").click(function () {
		$(".header__burger-poopup").addClass("active");
		$(".header__separate").addClass("active");
	});

	var defaultNavigationHtml = $(".header__nav-burger").html();
	var prevNavigationListHtml;

	function allNavigationItems() {
		$(".header__burger-poopup a").click(function (e) {
			if (e.target.classList.contains("button-back") || e.target.classList.contains("button-back-svg")) {
				e.preventDefault();
				if (e.target.innerText === "Наши услуги") {
					$(".header__nav-burger").html(defaultNavigationHtml);
				} else {
					$(".header__nav-burger").html(prevNavigationListHtml);
				}
				allNavigationItems();
				return;
			}
			var firstElementList = e.target.parentElement.querySelector(".sub-menu");
			if (!firstElementList) {
				$(".header__burger-poopup").removeClass("active");
				$(".header__separate").removeClass("active");
				return;
			}
			e.preventDefault();
			var firstLevelList = Array.from(firstElementList.querySelectorAll("li")).filter(function (node) {
				return node.parentNode === firstElementList;
			});
			var buttonBackHtml =
				'<li class="menu-item menu-item-type-custom menu-item-object-custom button-back-wrapper">' +
				'<a href="/" class="button-back">' +
				'<svg class="button-back-svg" width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">' +
				'<path d="M9.5 17L1.5 9L9.5 1" stroke="#2E1AB0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
				"</svg>" +
				e.target.innerText +
				"</a>" +
				"</li>";

			var nextNavigationListHtml = buttonBackHtml;
			firstLevelList.forEach(function (li) {
				nextNavigationListHtml += li.outerHTML;
			});

			prevNavigationListHtml = $(".header__nav-burger").html();
			$(".header__nav-burger").html(nextNavigationListHtml);
			allNavigationItems();
		});
	}

	allNavigationItems();

	$(".header__burger-poopup .icon__close").on("click", function () {
		$(".header__burger-poopup").toggleClass("active");
		$(".header__separate").toggleClass("active");
	});

	var headerNode = $("#header");
	var headerNodeHeight = headerNode.height();
	$(window).scroll(function () {
		if ($(window).scrollTop() > headerNodeHeight) {
			headerNode.addClass("active");
		} else {
			headerNode.removeClass("active");
		}
	});

	$(".close-btn").click(function () {
		$(".header__burger-poopup").removeClass("active");
		$(".header__separate").removeClass("active");
	});

	document.addEventListener("DOMContentLoaded", function () {
		var link = document.querySelector(".target-link");
		if (link) {
			link.addEventListener("click", function (e) {
				e.preventDefault();
				var href = link.getAttribute("href").substring(1);
				var scrollTarget = document.getElementById(href);
				var topOffset = 0;
				if (window.innerWidth <= 800) {
					topOffset = 290;
				} else {
					topOffset = 220;
				}
				if (scrollTarget) {
					var elementPosition = scrollTarget.getBoundingClientRect().top;
					var offsetPosition = elementPosition - topOffset;
					window.scrollBy({ top: offsetPosition });
				}
			});
		}
	});

	var listNavigationItems = document.querySelectorAll(".menu-item");
	if (listNavigationItems) {
		listNavigationItems.forEach(function (item) {
			item.addEventListener("click", function (e) {
				if (e.target.href && e.target.href.match("none")) {
					e.preventDefault();
					return;
				}
			});
			item.addEventListener("mouseover", function () {
				if (window.innerWidth <= 1024) return;
				var subList = item.querySelector(".sub-menu");
				var link = item.querySelector("a");
				if (subList) {
					subList.classList.add("active");
					link.classList.add("active");
				}
				if (!subList && link.innerText !== "Наши услуги") {
					var allItems = document.querySelectorAll(".menu-item");
					if (allItems) {
						allItems.forEach(function (elem) {
							var subMenu = elem.querySelector(".sub-menu");
							var linkMenu = elem.querySelector("a");
							if (subMenu) subMenu.classList.remove("active");
							if (linkMenu) linkMenu.classList.remove("active");
						});
					}
				}
			});
		});

		var headerNav = document.querySelector(".header__nav");
		var subList = headerNav.querySelector(".sub-menu");
		var links = headerNav.querySelectorAll("a");
		document.addEventListener("mouseover", function (ev) {
			if (!headerNav.contains(ev.target)) {
				if (subList) subList.classList.remove("active");
				links.forEach(function (item) {
					item.classList.remove("active");
				});
			}
		});
	}

	var forms = document.querySelectorAll(".form-help-book");
	if (forms) {
		forms.forEach(function (form) {
			form.addEventListener("submit", function (e) {
				e.preventDefault();
				var error = 0;
				var checked = false;
				var inputs = form.querySelectorAll(".useful__right-input");
				if (inputs) {
					inputs.forEach(function (input) {
						if (input.value.length === 0) {
							input.classList.add("error");
							error++;
						} else {
							input.classList.remove("error");
						}
					});
				}
				var checkbox = form.querySelector(".useful__checkbox");
				var visibleCheckbox = form.querySelector(".site-checkbox__checkbox");
				if (checkbox) {
					if (!checkbox.checked) {
						visibleCheckbox.classList.add("error");
						checked = false;
					} else {
						visibleCheckbox.classList.remove("error");
						checked = true;
					}
				}
				if (error === 0 && checked) {
					var formData = $(form).serialize();
					if (inputs) {
						inputs.forEach(function (input) {
							input.value = "";
							input.classList.remove("error");
						});
					}
					checkbox.checked = false;
					visibleCheckbox.classList.remove("error");
					var buttonSend = form.querySelector(".useful__right-button");
					if (buttonSend) {
						buttonSend.innerText = "Мы отправим Вам материалы в ближайшее время!";
						buttonSend.setAttribute("disabled", "disabled");
						setTimeout(function () {
							buttonSend.innerText = "Скачать";
							buttonSend.removeAttribute("disabled");
						}, 5000);
					}
					$.ajax({
						type: "POST",
						url: "/wp-admin/admin-post.php",
						data: formData,
						success: function (data) {
							console.log(data);
						}
					});
				}
			});
		});
	}

	$(".materials-form__item .footer__top-line-column-inputs-material").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;

		if ($(this).find(".footer__top-line-column-inputs-textarea").val().length === 0) {
			$(this).find(".footer__top-line-column-inputs-textarea").addClass("error");
		} else {
			$(this).find(".footer__top-line-column-inputs-textarea").removeClass("error");
		}

		$(this).find(".footer__top-line-column-inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(this).find(".footer__top-line-column-inputs-checkbox input").prop("checked") === false) {
			$(this).find(".footer__top-line-column-inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(this).find(".footer__top-line-column-inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(this).find(".footer__top-line-column-inputs-input").each(function () {
				$(this).val("");
			});
			$(this).find(".footer__top-line-column-inputs-textarea").val("");
			$(this).find(".footer__top-line-column-inputs-checkbox input").prop("checked", false);

			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			}).then(() => {
				$(this).find(".footer__popup").removeClass("hidden");
				setTimeout(() => {
					$(this).find(".footer__popup").addClass("hidden");
				}, 5000);
			});
		}
	});

	// psychological-support...


	$(".how-work__button").on("click", function () {
		$(".how-work__poopup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$(".how-work__poopup .poopup__inputs-input").removeClass("error");
		$(".how-work__poopup .site-checkbox").removeClass("error");
		$("body").css({ overflow: "hidden" });
		$(".how-work__poopup").find(".poopup__inputs").show();
		$(".how-work__poopup").find(".poopup__title").html("Записаться");
		$(".how-work__poopup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(document).click(function (e) {
			var div = $(".how-work__poopup");
			var divsvg = $(".how-work__poopup-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	$(".how-work__inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;
		$(".how-work__inputs .poopup__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(".how-work__inputs .poopup__inputs-checkbox input").prop("checked") === false) {
			$(".how-work__inputs .poopup__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".how-work__inputs .poopup__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			var mailResult;
			$(".how-work__inputs .poopup__inputs-input").each(function () {
				$(this).val("");
			});
			$(".how-work__inputs .poopup__inputs-checkbox input").prop("checked", false);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (result) {
					result = JSON.parse(result);
					mailResult = result;
					console.log(mailResult);
				}
			}).done(function () {
				$(".how-work__poopup").find(".poopup__inputs").hide();
				$(".how-work__poopup").find(".poopup__title").html(mailResult ? "Спасибо за обращение!" : "Произошла ошибка при отправке");
				$(".how-work__poopup").find(".poopup__description").html(
					mailResult ? "Наш администратор вскоре с Вами свяжется!" : 'Произошла ошибка на стороне сайта. Обратитесь к нам по адресу <a href="mailto:info@ormas.pro">info@ormas.pro</a>, телефону <a href="tel:+74991137650">+7 (499) 113-76-50</a> или Whatsapp <a href="https://api.whatsapp.com/send/?phone=79266699546">+7 (926) 669-95-46</a>'
				);
			});
		}
	});

	// servise-form

	$(".servise-form__close").click(function () {
		$(".servise-form__send-form").removeClass("show");
		$(".page-service__inputs-checkbox").removeClass("error");
		$(".page-service__inputs .page-service__inputs-input").each(function () {
			$(this).removeClass("error");
		});
	});

	$(".page-service__inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;
		$(".page-service__inputs .page-service__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(".page-service__inputs-checkbox input").prop("checked") === false) {
			$(".page-service__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".page-service__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".page-service__inputs .page-service__inputs-input").each(function () {
				$(this).val("");
			});
			$(".page-service__inputs-checkbox input").prop("checked", false);
			$(".servise-form__send-form").addClass("show");
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
			setTimeout(function () {
				$(".page-service__inputs-checkbox").removeClass("error");
				$(".page-service__inputs .page-service__inputs-input").each(function () {
					$(this).removeClass("error");
				});
				$(".servise-form__send-form").removeClass("show");
			}, 5000);
		}
	});

	// frequent-questions

	$(".frequent-questions__button").on("click", function () {
		$(".frequent-questions__poopup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$(".frequent-questions__poopup .poopup__inputs-input").removeClass("error");
		$(".frequent-questions__poopup .site-checkbox").removeClass("error");
		$("body").css({ overflow: "hidden" });
		$(".frequent-questions__poopup").find(".poopup__inputs").show();
		$(".frequent-questions__poopup").find(".poopup__title").html("Остались вопросы?");
		$(".frequent-questions__poopup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(document).click(function (e) {
			var div = $(".frequent-questions__poopup");
			var divsvg = $(".how-work__poopup-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	// Повторяющиеся .how-work__button -> психологическая поддержка
	$(".how-work__button").on("click", function () {
		$(".psychological-support-popup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$(".psychological-support-popup .poopup__inputs-input").removeClass("error");
		$(".psychological-support-popup .site-checkbox").removeClass("error");
		$("body").css({ overflow: "hidden" });
		$(".psychological-support-popup").find(".poopup__inputs").show();
		$(".psychological-support-popup").find(".poopup__title").html("Записаться");
		$(".psychological-support-popup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(document).click(function (e) {
			var div = $(".psychological-support-popup");
			var divsvg = $(".psychological-support-popup-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	$(".psychological-support__inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;
		$(".psychological-support__inputs .poopup__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(".psychological-support__inputs .poopup__inputs-checkbox input").prop("checked") === false) {
			$(".psychological-support__inputs .poopup__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".psychological-support__inputs .poopup__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".psychological-support__inputs .poopup__inputs-input").each(function () {
				$(this).val("");
			});
			$(".psychological-support__inputs .poopup__inputs-checkbox input").prop("checked", false);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
			$(".psychological-support-popup").find(".poopup__inputs").hide();
			$(".psychological-support-popup").find(".poopup__title").html("Спасибо за обращение!");
			$(".psychological-support-popup").find(".poopup__description").html(
				"Наш администратор вскоре с Вами свяжется!"
			);
		}
	});

	// ps-services-and-prices
	$(".ps-services-and-prices-btn").on("click", function () {
		$(".ps-services-and-prices-popup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$(".ps-services-and-prices-popup .poopup__inputs-input").removeClass("error");
		$(".ps-services-and-prices-popup .site-checkbox").removeClass("error");
		$("body").css({ overflow: "hidden" });
		$(".ps-services-and-prices-popup").find(".poopup__inputs").show();
		$(".ps-services-and-prices-popup").find(".poopup__title").html("Записаться");
		$(".ps-services-and-prices-popup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(document).click(function (e) {
			var div = $(".ps-services-and-prices-popup");
			var divsvg = $(".ps-services-and-prices-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	$(".how-work__button").on("click", function () {
		$(".ps-services-and-prices-popup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$(".ps-services-and-prices-popup .poopup__inputs-input").removeClass("error");
		$(".ps-services-and-prices-popup .site-checkbox").removeClass("error");
		$("body").css({ overflow: "hidden" });
		$(".ps-services-and-prices-popup").find(".poopup__inputs").show();
		$(".ps-services-and-prices-popup").find(".poopup__title").html("Записаться");
		$(".ps-services-and-prices-popup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(document).click(function (e) {
			var div = $(".ps-services-and-prices-popup");
			var divsvg = $(".ps-services-and-prices-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	$(".ps-services-and-prices-inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;
		$(".ps-services-and-prices-inputs .poopup__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		if ($(".ps-services-and-prices-inputs .poopup__inputs-checkbox input").prop("checked") === false) {
			$(".ps-services-and-prices-inputs .poopup__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".ps-services-and-prices-inputs .poopup__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".ps-services-and-prices-inputs .poopup__inputs-input").each(function () {
				$(this).val("");
			});
			$(".ps-services-and-prices-inputs .poopup__inputs-checkbox input").prop("checked", false);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
			$(".ps-services-and-prices-popup").find(".poopup__inputs").hide();
			$(".ps-services-and-prices-popup").find(".poopup__title").html("Спасибо за обращение!");
			$(".ps-services-and-prices-popup").find(".poopup__description").html(
				"Наш администратор вскоре с Вами свяжется!"
			);
		}
	});

	$(".psychological-support-how-work-button").on("click", function () {
		$(".psychological-support-how-work-popup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$(".psychological-support-how-work-popup .poopup__inputs-input").removeClass("error");
		$(".psychological-support-how-work-popup .site-checkbox").removeClass("error");
		$("body").css({ overflow: "hidden" });
		$(".psychological-support-how-work-popup").find(".poopup__inputs").show();
		$(".psychological-support-how-work-popup").find(".poopup__title").html("Записаться");
		$(".psychological-support-how-work-popup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(document).click(function (e) {
			var div = $(".psychological-support-how-work-popup");
			var divsvg = $(".psychological-support-how-work-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	$(".how-work__button").on("click", function () {
		$(".psychological-support-how-work-popup").removeClass("hidden");
		$(".consultation-overlay").removeClass("hidden");
		$(".psychological-support-how-work-popup .poopup__inputs-input").removeClass("error");
		$(".psychological-support-how-work-popup .site-checkbox").removeClass("error");
		$("body").css({ overflow: "hidden" });
		$(".psychological-support-how-work-popup").find(".poopup__inputs").show();
		$(".psychological-support-how-work-popup").find(".poopup__title").html("Записаться");
		$(".psychological-support-how-work-popup").find(".poopup__description").html(
			"Оставьте ваши контактные данные, и наш администратор вскоре с Вами свяжется!"
		);
		$(document).click(function (e) {
			var div = $(".psychological-support-how-work-popup");
			var divsvg = $(".psychological-support-how-work-svg");
			if (divsvg.is(e.target)) {
				div.addClass("hidden");
			}
		});
	});

	$(".psychological-support-how-work-inputs").submit(function (event) {
		event.preventDefault();
		var error = 0;
		var checked = false;
		$(".psychological-support-how-work-inputs .poopup__inputs-input").each(function () {
			if ($(this).val().length === 0) {
				$(this).addClass("error");
				error++;
			} else {
				$(this).removeClass("error");
			}
		});

		// В оригинале здесь, скорее всего, точка пропущена:
		if ($(".psychological-support-how-work-inputs .poopup__inputs-checkbox input").prop("checked") === false) {
			$(".psychological-support-how-work-inputs .poopup__inputs-checkbox").addClass("error");
			checked = false;
		} else {
			$(".psychological-support-how-work-inputs .poopup__inputs-checkbox").removeClass("error");
			checked = true;
		}

		if (error === 0 && checked) {
			var formData = $(this).serialize();
			$(".psychological-support-how-work-inputs .poopup__inputs-input").each(function () {
				$(this).val("");
			});
			$(".psychological-support-how-work-inputs .poopup__inputs-checkbox input").prop("checked", false);
			$.ajax({
				type: "POST",
				url: "/wp-admin/admin-post.php",
				data: formData,
				success: function (data) {
					console.log(data);
				}
			});
			$(".psychological-support-how-work-popup").find(".poopup__inputs").hide();
			$(".psychological-support-how-work-popup").find(".poopup__title").html("Спасибо за обращение!");
			$(".psychological-support-how-work-popup").find(".poopup__description").html(
				"Наш администратор вскоре с Вами свяжется!"
			);
		}
	});

	// Анимации при скролле
	var animItems = document.querySelectorAll("._anim-items");
	if (animItems.length > 0) {
		function animOnScroll() {
			for (var i = 0; i < animItems.length; i++) {
				var animItem = animItems[i];
				var animItemHeight = animItem.offsetHeight;

				function offset(el) {
					var rect = el.getBoundingClientRect(),
						scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
						scrollTop = window.pageYOffset || document.documentElement.scrollTop;
					return { top: rect.top + scrollTop, left: rect.left + scrollLeft };
				}
				var animItemOffset = offset(animItem).top;
				var animStart = 10;
				var animItemPoint = window.innerHeight - animItemHeight / animStart;
				if (animItemHeight > window.innerHeight) {
					animItemPoint = window.innerHeight - window.innerHeight / animStart;
				}
				if (
					pageYOffset > animItemOffset - animItemPoint &&
					pageYOffset < animItemOffset + animItemHeight
				) {
					animItem.classList.add("_active-anim");
				} else {
					if (!animItem.classList.contains("_stop-anim")) {
						animItem.classList.remove("_active-anim");
					}
				}
			}
		}

		window.addEventListener("scroll", animOnScroll);
		setTimeout(function () {
			animOnScroll();
		}, 800);
	}

	window.addEventListener("scroll", function () {
		var contentItems = document.querySelectorAll(".servise-page-table__content-item");
		if (contentItems.length > 0) {
			var count = -370;
			var allItem = document.querySelectorAll(".services-page__item");
			var client = document.documentElement.clientHeight;
			var height = allItem[0].offsetHeight + 177;
			contentItems.forEach(function (item) {
				count += item.offsetHeight;
			});
			var form = document.querySelector(".servise-form");
			if (document.documentElement.scrollTop >= count) {
				form.style.position = "absolute";
				form.style.bottom = "0";
			} else {
				if (count > 0) {
					form.style.position = "fixed";
					form.style.bottom = "auto";
				}
			}
		}
	});

	if ($(".how_work_slider")) {
		$(".how_work_slider").slick({
			infinite: false,
			slidesToShow: 2,
			slidesToScroll: 1,
			arrows: true,
			variableWidth: true,
			dots: false,
			prevArrow: document.querySelector('.how_work2 .slick-prev'),
			nextArrow: document.querySelector('.how_work2 .slick-next'),
			responsive: [{
				breakpoint: 1024,
				settings: {
					variableWidth: false,
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			},
			]
		});
	}

	$('.banner_form .site-inputs').submit(function (event) {
		event.preventDefault()

		let error = 0;
		let checked = false;

		$('.banner_form .site-input').each(function () {
			if ($(this).val().length == 0) {
				$(this).addClass('error')
				error++
			} else {
				$(this).removeClass('error')
			}
		})

		if ($('.banner_form .site-checkbox input').prop('checked') == false) {
			$('.banner_form .site-checkbox').addClass('error')
			checked = false
		} else {
			$('.banner_form .site-checkbox').removeClass('error')
			checked = true
		}

		if (error == 0 && checked) {
			let formData = $(this).serialize()
			$('.banner_form .site-input').each(function () {
				$(this).val('')
			})
			$('.banner_form .site-checkbox input').prop('checked', false)
			$('.banner__popup').removeClass('hidden')
			setTimeout(function () {
				$('.banner__popup').addClass('hidden');
			}, 5000);
			// console.log( formData)
			$.ajax({
				type: 'POST',
				url: `/wp-admin/admin-post.php`,
				data: formData,
				success: function (data) {
					console.log(data);
				}
			})
		}

		$(document).click(function (e) {
			var div = $('.banner__popup')
			var divsvg = $('.banner__popup .banner__popup-svg')

			if (!div.is(e.target) &&
				div.has(e.target).length === 0 || divsvg.is(e.target)) {
				div.addClass('hidden')
			}
		});
	})
});