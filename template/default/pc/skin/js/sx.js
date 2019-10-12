$(document).ready(function(){
							
	$("#select1 dd").click(function () {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectA").remove();
		} else {
			var copyThisA = $(this).clone();
			if ($("#selectA").length > 0) {
				$("#selectA a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisA.attr("id", "selectA"));
			}
		}
	});
	
	$("#select2 dd").click(function () {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectB").remove();
		} else {
			var copyThisB = $(this).clone();
			if ($("#selectB").length > 0) {
				$("#selectB a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisB.attr("id", "selectB"));
			}
		}
	});
	
	$("#select3 dd").click(function () {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectC").remove();
		} else {
			var copyThisC = $(this).clone();
			if ($("#selectC").length > 0) {
				$("#selectC a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisC.attr("id", "selectC"));
			}
		}
	});
		$("#select4 dd").click(function () {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectD").remove();
		} else {
			var copyThisC = $(this).clone();
			if ($("#selectD").length > 0) {
				$("#selectD a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisC.attr("id", "selectD"));
			}
		}
	});
		$("#select5 dd").click(function () {
		$(this).addClass("selected").siblings().removeClass("selected");
		if ($(this).hasClass("select-all")) {
			$("#selectE").remove();
		} else {
			var copyThisC = $(this).clone();
			if ($("#selectE").length > 0) {
				$("#selectE a").html($(this).text());
			} else {
				$(".select-result dl").append(copyThisC.attr("id", "selectE"));
			}
		}
	});	
	
	
	
	
	
	$("#selectA").live("click", function () {
		$(this).remove();
		$("#select1 .select-all").addClass("selected").siblings().removeClass("selected");
	});
	
	$("#selectB").live("click", function () {
		$(this).remove();
		$("#select2 .select-all").addClass("selected").siblings().removeClass("selected");
	});
	
	$("#selectC").live("click", function () {
		$(this).remove();
		$("#select3 .select-all").addClass("selected").siblings().removeClass("selected");
	});
	$("#selectD").live("click", function () {
		$(this).remove();
		$("#select4 .select-all").addClass("selected").siblings().removeClass("selected");
	});
	$("#selectE").live("click", function () {
		$(this).remove();
		$("#select5 .select-all").addClass("selected").siblings().removeClass("selected");
	});
	
	// $(".select dd").live("click", function () {
	// 	if ($(".select-result dd").length > 1) {
	// 		$(".select-no").hide();
	// 	} else {
	// 		$(".select-no").show();
	// 	}
	// });
	$(".js-tabtoggle:eq(1)").click(function() {
		$(".js-tabtoggle:eq(1)").addClass("tab");
		$(".js-tabtoggle:eq(0)").removeClass("tab");
		$(".af-xf-hx").css("display", "block");
	});
	$(".js-tabtoggle:eq(0)").click(function() {
		$(".js-tabtoggle:eq(0)").addClass("tab");
		$(".js-tabtoggle:eq(1)").removeClass("tab");
		$(".af-xf-hx").css("display", "none");
	});


});