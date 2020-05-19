"use strict";
var antomi_magnifier_vars;
var yith_magnifier_options = {
		sliderOptions: {
			responsive: antomi_magnifier_vars.responsive,
			circular: antomi_magnifier_vars.circular,
			infinite: antomi_magnifier_vars.infinite,
			direction: 'up',
			debug: false,
			auto: false,
			align: 'left',
			height: "100%",
			width: 100,
			prev    : {
				button  : "#slider-prev",
				key     : "left"
			},
			next    : {
				button  : "#slider-next",
				key     : "right"
			},
			scroll : {
				items     : 1,
				pauseOnHover: true
			},
			items   : {
				visible: Number(antomi_magnifier_vars.visible),
			},
			swipe : {
				onTouch:    true,
				onMouse:    true
			},
			mousewheel : {
				items: 1
			}
		},
		showTitle: false,
		zoomWidth: antomi_magnifier_vars.zoomWidth,
		zoomHeight: antomi_magnifier_vars.zoomHeight,
		position: antomi_magnifier_vars.position,
		lensOpacity: antomi_magnifier_vars.lensOpacity,
		softFocus: antomi_magnifier_vars.softFocus,
		adjustY: 0,
		disableRightClick: false,
		phoneBehavior: antomi_magnifier_vars.phoneBehavior,
		loadingLabel: antomi_magnifier_vars.loadingLabel,
	};