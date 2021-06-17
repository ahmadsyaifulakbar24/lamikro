// THEME COLORS
var style = getComputedStyle(document.body);
var chartColors = ["#696ffb", "#7db8f9", "#05478f", "#00cccc", "#6CA5E0", "#1A76CA"];
var primaryColor = style.getPropertyValue('--primary');
var secondaryColor = style.getPropertyValue('--secondary');
var successColor = style.getPropertyValue('--success');
var warningColor = style.getPropertyValue('--warning');
var dangerColor = style.getPropertyValue('--danger');
var infoColor = style.getPropertyValue('--info');
var darkColor = style.getPropertyValue('--dark');


// BODY ELEMENTS
var Body = $("body");
var TemplateSidebar = $('.sidebar');
var TemplateHeader = $('.t-header');
var PageContentWrapper = $(".page-content-wrapper");
var DesktopToggler = $(".t-header-desk-toggler");
var MobileToggler = $(".t-header-mobile-toggler");

// SIDEBAR TOGGLE FUNCTION FOR MOBILE (SCREEN "MD" AND DOWN)
MobileToggler.on("click", function () {
  $(".page-body").toggleClass("sidebar-collpased");
  $('.overlay').toggleClass('overlayShow');
});
$('.overlay').click(function() {
  $(".page-body").toggleClass("sidebar-collpased");
  $('.overlay').toggleClass('overlayShow');
});


// CHECK FOR CURRENT PAGE AND ADDS AN ACTIVE CLASS FOR TO THE ACTIVE LINK
var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
$('.navigation-menu li a', TemplateSidebar).each(function () {
  var $this = $(this);
  if (current === "") {
    //FOR ROOT URL
    if ($this.attr('href').indexOf("index.html") !== -1) {
      $(this).parents('li').last().addClass('active');
      if ($(this).parents('.navigation-submenu').length) {
        $(this).addClass('active');
      }
    }
  } else {
    //FOR OTHER URL
    if ($this.attr('href').indexOf(current) !== -1) {
      $(this).parents('li').last().addClass('active');
      if ($(this).parents('.navigation-submenu').length) {
        $(this).addClass('active');
      }
      if (current !== "index.html") {
        $(this).parents('li').last().find("a").attr("aria-expanded", "true");
        if ($(this).parents('.navigation-submenu').length) {
          $(this).closest('.collapse').addClass('show');
        }
      }
    }
  }
});

$(".btn.btn-refresh").on("click", function () {
  $(this).addClass("clicked");
  setTimeout(function () {
    $(".btn.btn-refresh").removeClass("clicked");
  }, 3000);
});


$(".btn.btn-like").on("click", function () {
  $(this).toggleClass("clicked");
  $(this).find("i").toggleClass("mdi-heart-outline clicked").toggleClass("mdi-heart");
});


$('#laporan').click(function(){
  if($('#laporan-icon').hasClass('mdi-chevron-down')) {
    $('#laporan-submenu').show()
    $('#laporan-li').addClass('submenu-hover')
    $('#laporan-icon').addClass('mdi-chevron-up')
    $('#laporan-icon').removeClass('mdi-chevron-down')
  } else {
    $('#laporan-submenu').hide()
    $('#laporan-li').removeClass('submenu-hover')
    $('#laporan-icon').addClass('mdi-chevron-down')
    $('#laporan-icon').removeClass('mdi-chevron-up')
  }
})

$('#overlay').click(function(){
  $(".page-body").toggleClass("sidebar-collpased");
})

$(document).ready(function(){
  var path = window.location.pathname.substr(5)
  if(path == 'laporan-laba-rugi' || path == 'laporan-posisi-keuangan') {
    $('#laporan-submenu').show()
    $('#laporan-li').addClass('submenu-hover')
    $('#laporan-icon').addClass('mdi-chevron-up')
    $('#laporan-icon').removeClass('mdi-chevron-down')
  } else {
    $('#laporan-submenu').hide()
    $('#laporan-li').removeClass('submenu-hover')
    $('#laporan-icon').addClass('mdi-chevron-down')
    $('#laporan-icon').removeClass('mdi-chevron-up')
  }
})

$('.password').click(function(){
  if($(this).hasClass('mdi-eye')){
    $(this).removeClass('mdi-eye')
    $(this).addClass('mdi-eye-off')
    if($(this).data('id') == 'password'){
      $('#password').attr('type','password')
    } else if($(this).data('id') == 'npassword'){
      $('#npassword').attr('type','password')
    } else {
      $('#cpassword').attr('type','password')
    }
  } else {
    $(this).addClass('mdi-eye')
    $(this).removeClass('mdi-eye-off')
    if($(this).data('id') == 'password'){
      $('#password').attr('type','text')
    } else if($(this).data('id') == 'npassword'){
      $('#npassword').attr('type','text')
    } else {
      $('#cpassword').attr('type','text')
    }
  }
})

function dateNow() {
	let date = new Date()
	let d = date.getDate()
	let m = (date.getMonth()+1)
	let y = date.getFullYear()
	if (d.toString().length < 2) d = '0' + d;
	if (m.toString().length < 2) m = '0' + m;
	return(y+'-'+m+'-'+d)
}

function delay(callback,ms){
	let timer = 0
	return function(){
		let context = this,
			args = arguments
		clearTimeout(timer)
		timer = setTimeout(function(){
			callback.apply(context,args)
		}, ms || 0)
	}
}

/**

*

*  Base64 encode / decode

*  http://www.webtoolkit.info/

**/

var Base64 = {

    // private property
    _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode : function (input) {
      var output = "";
      var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
      var i = 0;

      input = Base64._utf8_encode(input);

      while (i < input.length) {

        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;

        if (isNaN(chr2)) {
          enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
          enc4 = 64;
        }

        output = output +
        this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
        this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

      }

      return output;
    },

    // public method for decoding
    decode : function (input) {
      var output = "";
      var chr1, chr2, chr3;
      var enc1, enc2, enc3, enc4;
      var i = 0;

      input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

      while (i < input.length) {

        enc1 = this._keyStr.indexOf(input.charAt(i++));
        enc2 = this._keyStr.indexOf(input.charAt(i++));
        enc3 = this._keyStr.indexOf(input.charAt(i++));
        enc4 = this._keyStr.indexOf(input.charAt(i++));

        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;

        output = output + String.fromCharCode(chr1);

        if (enc3 != 64) {
          output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
          output = output + String.fromCharCode(chr3);
        }

      }

      output = Base64._utf8_decode(output);

      return output;

    },

    // private method for UTF-8 encoding
    _utf8_encode : function (string) {
      string = string.replace(/\r\n/g,"\n");
      var utftext = "";

      for (var n = 0; n < string.length; n++) {

        var c = string.charCodeAt(n);

        if (c < 128) {
          utftext += String.fromCharCode(c);
        }
        else if((c > 127) && (c < 2048)) {
          utftext += String.fromCharCode((c >> 6) | 192);
          utftext += String.fromCharCode((c & 63) | 128);
        }
        else {
          utftext += String.fromCharCode((c >> 12) | 224);
          utftext += String.fromCharCode(((c >> 6) & 63) | 128);
          utftext += String.fromCharCode((c & 63) | 128);
        }

      }

      return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode : function (utftext) {
      var string = "";
      var i = 0;
      var c = c1 = c2 = 0;

      while ( i < utftext.length ) {

        c = utftext.charCodeAt(i);

        if (c < 128) {
          string += String.fromCharCode(c);
          i++;
        }
        else if((c > 191) && (c < 224)) {
          c2 = utftext.charCodeAt(i+1);
          string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
          i += 2;
        }
        else {
          c2 = utftext.charCodeAt(i+1);
          c3 = utftext.charCodeAt(i+2);
          string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
          i += 3;
        }

      }

      return string;
    }

  }