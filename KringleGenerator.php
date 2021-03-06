<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
$( document ).ready(function() {

	//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
	//PUT THE KRINGLE NAMES HERE. THE ORDER DOESN'T MATTER.
	var kringleNames = ["Harry", "Hermione", "Ron", "Dumbledore", "Snape", "Cho"];
	//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

        <?php
              //I put the encrypting/decrypting password in a single file so both files can access it.
              include 'KringleEncryptDecryptPassword.php';
        ?>	
var result = "";

	//find the longest name
	var maxLength = 0;
	for (var i = 0; i < kringleNames.length; i++) {
		if (kringleNames[i].length > maxLength) {
			maxLength = kringleNames[i].length;
		}
	}
		
	//Pad the names with dashes at the end (this way, all the names are the same length 
	//so it's harder to tell which name is which when we get the codes; otherwise the shorter names have shorter codes).
	for (var i = 0; i < kringleNames.length; i++) {
		kringleNames[i] = padRight(kringleNames[i]);

	}
		
	//keep taking cracks at a random arrangement until nobody has the same person.
	//this uses the Fisher-Yates algorithm repeatedly.
	var randomAssns;
	var dups = true;
	while (dups==true) {
		//make an array of the name length.
		randomAssns = new Array(kringleNames.length);
		//start with the numbers in there (these will be shuffled around).
		for (i = 0; i<kringleNames.length; i++) {
			randomAssns[i] = i;
		}	
		
		//now do random shuffling.
		for (var i = randomAssns.length - 1; i > 0; i--) {
			var randomNum = getRandomInt(0, i);
			var tmp = randomAssns[i];
			randomAssns[i] = randomAssns[randomNum];
			randomAssns[randomNum] = tmp;
		}

		//is every slot different?
		dups = false;
		for (var i = 0; i< kringleNames.length; i++)
		{
			//the person is assigned to themselves, so this shuffle won't work.
			if (randomAssns[i] == i)
			{
				dups = true;
			}
		}	
	}

	//our list is good, so print it out.
	for (var i = 0; i < kringleNames.length; i++) {
		var ptr = randomAssns[i];
                //the var password comes from the included file
                //use this for debugging if I need to see the name list
		//result += i + ": " + kringleNames[i] + " gets " + ptr + " " + kringleNames[ptr] + " " + encrypt(kringleNames[ptr], password);
		result += kringleNames[i] + " gets " + encrypt(kringleNames[ptr], password);

		result += "<br>";
	}
	
	$("#names").html(result);
	
	function encrypt(str, pwd) 
	{
	  var prand = "";
	  for(var i=0; i<pwd.length; i++) 
	 {
		prand += pwd.charCodeAt(i).toString();
	  }
	  var sPos = Math.floor(prand.length / 5);
	  var mult = parseInt(prand.charAt(sPos) + prand.charAt(sPos*2) + prand.charAt(sPos*3) + prand.charAt(sPos*4) + prand.charAt(sPos*5));
	  var incr = Math.ceil(pwd.length / 2);
	  var modu = Math.pow(2, 31) - 1;
	  if(mult < 2)
	  {
		alert("no");
		return null;
	  }
	  var salt = Math.round(Math.random() * 1000000000) % 100000000;
	  prand += salt;
	  while(prand.length > 10) {
		prand = (parseInt(prand.substring(0, 10)) + parseInt(prand.substring(10, prand.length))).toString();
	  }
	  prand = (mult * prand + incr) % modu;
	  var enc_chr = "";
	  var enc_str = "";
	  for(var i=0; i<str.length; i++) {
		enc_chr = parseInt(str.charCodeAt(i) ^ Math.floor((prand / modu) * 255));
		if(enc_chr < 16) {
		  enc_str += "0" + enc_chr.toString(16);
		} else enc_str += enc_chr.toString(16);
		prand = (mult * prand + incr) % modu;
	  }
	  salt = salt.toString(16);
	  while(salt.length < 8)salt = "0" + salt;
	  enc_str += salt;
	  return enc_str;
	}
	
	//define the pad function
	function padRight (inputStr) {
		var paddingChar = "-";
		if (inputStr.length >= maxLength) {
			return inputStr;
		}
		var max = (maxLength - inputStr.length) / paddingChar.length;
		for (var i = 0; i < max; i++) {
			inputStr += paddingChar;
		}
		return inputStr;
	}
	
	//define the randomizer function
	function getRandomInt (min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
		


});
</script>

</head>
<body>

<div id="names" name="names">
</div>
</body>
</html>