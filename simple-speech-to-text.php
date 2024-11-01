<?php 
/*
* Plugin Name: Simple Speech To Text
* Description: Are you lazy to type the text. Here is the solution.Use this plugin you can convert your speech into text easily.
* Version: 1.0.0
* Author: Tech Man Studio
* Author URI: https://www.techmanstudio.com
*/ 
?>
<?php 
function simple_speech(){
?>
<!DOCTYPE html>
<meta charset="utf-8">
<title>Simple Speech to Text</title>

<?php
$browser="";
     if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("MSIE"))){?>
         <p id="info_upgrade"  style="text-align:center;">Simple Speech to Text is not supported by this browser.
     Upgrade to <a href="//www.google.com/chrome">Chrome</a>
     version 25 or later.</p>
     <?php }
     else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("Presto")))
     {
         //$browser="opera";
     }
     else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("CHROME")))
     {?>
        
     <?php 
     }
     else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("SAFARI")))
     { ?>
         <p id="info_upgrade"  style="text-align:center;">Simple Speech to Text is not supported by this browser.
     Upgrade to <a href="//www.google.com/chrome">Chrome</a>
     version 25 or later.</p>
     <?php }
     else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("FIREFOX")))
     { ?>
         <p id="info_upgrade"  style="text-align:center;">Simple Speech to Text is not supported by this browser.
     Upgrade to <a href="//www.google.com/chrome">Chrome</a>
     version 25 or later.</p>
     <?php }
     else 
     {
     //$browser="other";
     }
echo $browser;
?>

  <div style="margin-bottom:50px">
    <div style="width:100%">
    <textarea name="q" id="transcript" rows="15" style="width:100% !important;"></textarea>
    </div> 
  <div style="margin-top: 20px;float:left;">
<a onclick="startDictation()" style="padding: 6px 11px;background-color:green;cursor:pointer;color:#fff;margin-top:10px;border-radius:5px;"> Speak Now</a>
</div>
<div style="margin-top: 20px;margin-left: 10px;float:left;">
<a onclick="speakstop()" style="padding: 6px 11px;background-color:red;cursor:pointer;color:#fff;margin-top:10px;border-radius:5px;"> Stop</a>
</div>
<div style="margin-top: 20px;margin-left: 10px;float:left;">
<a onclick="speakcopy();" style="padding: 6px 11px;background-color:#2111c4;cursor:pointer;color:#fff;margin-top:10px;border-radius:5px;"> Copy</a>
</div>
<div style="margin-top: 20px;margin-left: 10px;float:left;">
<a onclick="speakclear()" style="padding: 6px 11px;background-color:#e5225c;cursor:pointer;color:#fff;margin-top:10px;border-radius:5px;"> Clear</a>
</div>
 </div>
<!-- HTML5 Speech Recognition API -->
<script>
  function startDictation() {

     var recognition = new webkitSpeechRecognition();
    recognition.continuous = true;
    recognition.interimResults = true;
 
    recognition.onresult = function (e) {
        var textarea = document.getElementById('transcript');
        for (var i = e.resultIndex; i < e.results.length; ++i) {
            if (e.results[i].isFinal) {
                textarea.value += e.results[i][0].transcript;
            }
        }
    }
 
    // start listening
    recognition.start();
  }
  function speakstop(){
     var recognition = new webkitSpeechRecognition();
    recognition.stop();
  }
  function speakcopy(){
     var recognition = new webkitSpeechRecognition();
    recognition.stop();
     copyToClipboard(document.getElementById("transcript"));
  }
  function speakclear(){
     var recognition = new webkitSpeechRecognition();
    recognition.stop();
    document.getElementById("transcript").value="";
  }
  
   


function copyToClipboard(elem) {
 
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
</script>
<?php 
}
add_action("plugins_loaded", "simple_speech_to_text"); 
function simple_speech_to_text()
{
    add_action( 'add_meta_boxes', 'simple_custom_metabox' );
}
function simple_custom_metabox()
{
        add_meta_box( 'simple-speech-text', __( 'Simple Speech to Text','simple-speech-to-text'), 'simple_speech', 'post', 'normal', 'high' );
        add_meta_box( 'simple-speech-text', __( 'Simple Speech to Text','simple-speech-to-text'), 'simple_speech', 'page', 'normal', 'high' );
}?>