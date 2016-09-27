function checkRegisterForm(form, id, password, password2) {
    if (id.value == '' || 
          password.value == '' ) {
        alert('아이디와 비밀번호는 빈칸 안됨');
        return false;
    }

	// 최소한 4자리
    if (id.value.length < 4) {
        alert('아이디는 4자리 이상이여야함');
        id.focus();
        return false;
    }
    // id 검사
    var re = /^\w+$/; 
    if(!re.test(id.value)) { 
        alert('아이디는 숫자와 영문자, _ 만 가능함'); 
        id.focus();
        return false; 
    }

	// 최소한 6자리
    if (password.value.length < 6) {
        alert('암호는 6자리 이상이여야함');
        password.focus();
        return false;
    }
    // 최소한 1개씩의 숫자, 영소문자, 영대문자
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('암호는 숫자, 영소문자, 영대문자를 1개씩 포함해야 함');
		password.focus();
        return false;
    }
 
	// 암호 확인
    if (password.value != password2.value) {
        alert('암호 확인이 맞지 않음');
        password.focus();
        return false;
    }
 
    // 해쉬 값을 포함할 요소 생성
    var hash = document.createElement("input");
    form.appendChild(hash);
    hash.name = "hash";
	hash.type = "hidden";
    hash.value = hex_sha512(password.value);
 
    password.value = '';
    password2.value = '';

    form.submit();
    return true;
}

function htmlspecialchars(string, quote_style, charset, double_encode) {
  //       discuss at: http://phpjs.org/functions/htmlspecialchars/
  //      original by: Mirek Slugen
  //      improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      bugfixed by: Nathan
  //      bugfixed by: Arno
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //       revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //         input by: Ratheous
  //         input by: Mailfaker (http://www.weedem.fr/)
  //         input by: felix
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //             note: charset argument not supported
  //        example 1: htmlspecialchars("<a href='test'>Test</a>", 'ENT_QUOTES');
  //        returns 1: '&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;'
  //        example 2: htmlspecialchars("ab\"c'd", ['ENT_NOQUOTES', 'ENT_QUOTES']);
  //        returns 2: 'ab"c&#039;d'
  //        example 3: htmlspecialchars('my "&entity;" is still here', null, null, false);
  //        returns 3: 'my &quot;&entity;&quot; is still here'

  var optTemp = 0,
    i = 0,
    noquotes = false;
  if (typeof quote_style === 'undefined' || quote_style === null) {
    quote_style = 2;
  }
  string = string.toString();
  if (double_encode !== false) { // Put this first to avoid double-encoding
    string = string.replace(/&/g, '&amp;');
  }
  string = string.replace(/</g, '&lt;')
    .replace(/>/g, '&gt;');

  var OPTS = {
    'ENT_NOQUOTES': 0,
    'ENT_HTML_QUOTE_SINGLE': 1,
    'ENT_HTML_QUOTE_DOUBLE': 2,
    'ENT_COMPAT': 2,
    'ENT_QUOTES': 3,
    'ENT_IGNORE': 4
  };
  if (quote_style === 0) {
    noquotes = true;
  }
  if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
    quote_style = [].concat(quote_style);
    for (i = 0; i < quote_style.length; i++) {
      // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
      if (OPTS[quote_style[i]] === 0) {
        noquotes = true;
      } else if (OPTS[quote_style[i]]) {
        optTemp = optTemp | OPTS[quote_style[i]];
      }
    }
    quote_style = optTemp;
  }
  if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
    string = string.replace(/'/g, '&#039;');
  }
  if (!noquotes) {
    string = string.replace(/"/g, '&quot;');
  }

  return string;
}