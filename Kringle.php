<HEAD>

<SCRIPT LANGUAGE="JavaScript">

<?php
   //I put the encrypting/decrypting password in a single file so both files can access it.
   include 'KringleEncryptDecryptPassword.php';
?>
function decrypt(str) {
  if(str == null || str.length < 8) {
    alert("A salt value could not be extracted from the encrypted message because its length is too short. The message cannot be decrypted.");
    return;
  }
  var prand = "";
  for(var i=0; i<password.length; i++) {
    prand += password.charCodeAt(i).toString();
  }
  var sPos = Math.floor(prand.length / 5);
  var mult = parseInt(prand.charAt(sPos) + prand.charAt(sPos*2) + prand.charAt(sPos*3) + prand.charAt(sPos*4) + prand.charAt(sPos*5));
  var incr = Math.round(password.length / 2);
  var modu = Math.pow(2, 31) - 1;
  var salt = parseInt(str.substring(str.length - 8, str.length), 16);
  str = str.substring(0, str.length - 8);
  prand += salt;
  while(prand.length > 10) {
    prand = (parseInt(prand.substring(0, 10)) + parseInt(prand.substring(10, prand.length))).toString();
  }
  prand = (mult * prand + incr) % modu;
  var enc_chr = "";
  var enc_str = "";
  for(var i=0; i<str.length; i+=2) {
    enc_chr = parseInt(parseInt(str.substring(i, i+2), 16) ^ Math.floor((prand / modu) * 255));
    enc_str += String.fromCharCode(enc_chr);
    prand = (mult * prand + incr) % modu;
  }
  
  //I put dashes in the names so they're all 7 characters, which makes the codes all the same length (I could tell which one was Albus or Cho b/c they were shorter
  //than Severus or Hagrid, but not with the codes the same length).
  //For some reason the replace doesn't remove the hyphen. I even tried the HTML code &#45 but that didn't work either.
  //var dashesRemoved = enc_str.replace("-", ""); 
	document.getElementById('kringleName').innerHTML=enc_str;
}
</script>

</HEAD>
<BODY>

<form name="box">
<br><br>Enter the code that I sent you here: <input type="text" name="codeValue" id="codeValue" size="50">
<br><br>
<input type="button" onclick="decrypt(document.box.codeValue.value);" value="click here to see your kringle!">
<br><br>
<div id='kringleName'"></div>
</form>
</html>